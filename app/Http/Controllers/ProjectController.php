<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Project;
use App\Models\Language;
use App\Models\Template;
use App\Models\Framework;
use Illuminate\Http\Request;
use App\Models\DatabaseLists;
use App\Models\OperatingSystem;
use Illuminate\Validation\Rule;
use Illuminate\Cache\DatabaseLock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\TemplateController;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        
        $user   =   Auth::user();
        $by     =  $request->by == 'asc' ? 'ASC' : 'DESC';
        $query  =   Project::query();

        // Role Specific
        if(!$user->hasRole('Admin')){

            $query->where('user_id', $user->id);
        }

        // Onclick Filteration
        if (isset($request->os) && !empty($request->os)) {

            $query->where('operating_system', 'LIKE', '%' . $request->os . '%');
        }
        if (isset($request->language) && !empty($request->language)) {

            $query->where('language', 'LIKE', '%' . $request->language . '%');
        }
        if (isset($request->framework) && !empty($request->framework)) {

            $query->where('framework', 'LIKE', '%' . $request->framework . '%');
        }
        if (isset($request->database) && !empty($request->database)) {

            $query->where('database', 'LIKE', '%' . $request->database . '%');
        }

        if (isset($request->is_backup) && !empty($request->is_backup)) {

            $query->where('is_backup', 'LIKE', '%' . $request->is_backup . '%');
        }
        if (isset($request->is_vapt_done) && !empty($request->is_vapt_done)) {

            $query->where('is_vapt_done', 'LIKE', '%' . $request->is_vapt_done . '%');
        }
        if (isset($request->is_dr) && !empty($request->is_dr)) {

            $query->where('is_dr', 'LIKE', '%' . $request->is_dr . '%');
        }

        // Filteration section
        if ($request->isMethod('post')){
            
            if (isset($request->text) && !empty($request->text)) {
                
                $query->where(function ($query) use ($request) {
                    $query->where('url', 'LIKE', '%' . $request->text . '%')
                          ->orWhere('name', 'LIKE', '%' . $request->text . '%');
                });
            }
        }

        // sorting portion
        if ($request->sort == 'name') {
            $query->orderBy('name', $by);

        } else if( $request->sort == 'os' ){
            $query->orderBy('operating_system', $by);
            
        }else if( $request->sort == 'lang' ){
            $query->orderBy('language', $by);

        }else if( $request->sort == 'framework' ){
            $query->orderBy('framework', $by);

        }else if( $request->sort == 'db' ){
            $query->orderBy('database', $by);

        }else{
            $query->orderBy('created_at', 'DESC'); // You can adjust the default sorting logic
        }
        
        $projects           =   $query->with('getLanguage','operatingSystem','getFramework','getDatabase')->paginate(20)->withQueryString();
        // dd($projects);
        $operatingSystems   =   OperatingSystem::all();
        $languages          =   Language::all();
        $frameworks         =   Framework::all();
        $databases          =   DatabaseLists::all();

        return view('project.index', compact('projects','operatingSystems','languages','frameworks','databases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        
        $template   =   Template::all();

        if( count($template)  > 0 ){
            
            return redirect()->route('template.index');

        }else{

            $operatingSystems   =   OperatingSystem::all();
            $languages          =   Language::all();
            $frameworks         =   Framework::all();
            $databases          =   DatabaseLists::all();
            
            return view('project.create', compact('operatingSystems','languages','frameworks','databases','template'));
        }
    }


    public function templatesIndex(){

        $templates       =   Template::all();

        return view('project.template', compact('templates'));
    }

    public function setTemplate(Request $request){
        
        $isFound    =   Template::find($request->template);

        return redirect()->route('project.set.template',$request->template);
    }

    public function projectSetTemplate(Request $request){
        
        $operatingSystems   =   OperatingSystem::all();
        $languages          =   Language::all();
        $frameworks         =   Framework::all();
        $databases          =   DatabaseLists::all();
        $template           =   Template::with('getLanguage', 'operatingSystem', 'getFramework', 'getDatabase')->find($request->id);
        // dd($template);
        
        return view('project.create', compact('operatingSystems','languages','frameworks','databases','template'));
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name'                      => ['required', 'max:50'],
            'url'                       => ['required', 'url', 'unique:projects,url'],
            'ip'                        => ['required', 'ip'],
            'secondary_ip'              => ['nullable'],
            // 'secondary_ip'              => ['nullable', 'ip'],
            'operating_system'          => ['required'],
            'operating_system_version'  => ['required', 'between:0,99.99'],
            'language'                  => ['required'],
            'language_version'          => ['required', 'between:0,99.99'],
            'framework'                 => ['required'],
            'framework_version'         => ['required', 'between:0,99.99'],
            'database'                  => ['required'],
            'database_version'          => ['required', 'between:0,99.99'],
            'is_exposed_to_content'     => ['required', 'in:YES,NO'],
            'is_dr'                     => ['required','in:YES,NO'],
            'is_vapt_done'              => ['required','in:YES,NO'],
            'is_backup'                 => ['required','in:YES,NO'],
            'file'                      => ['mimes:jpeg,png,pdf,csv', 'max:2048'],
        ]);

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
            
            $file->storeAs('public/files', $fileName);
            
            (new Project)->storeProject($request, $fileName);
        }else{
            (new Project)->storeProject($request,NULL);
        }

        (new Template)->storeTemplate($request, Auth::user()->id);

        return redirect()->route('project.index')->with('success', 'Project detail has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editWebsite($id){
        
        $website            =   Project::where( [ 'user_id'=>Auth::user()->id, 'id'=>$id ] )->with('getLanguage','operatingSystem','getFramework','getDatabase')->first();
        $operatingSystems   =   OperatingSystem::all();
        $languages          =   Language::all();
        $frameworks         =   Framework::all();
        $databases          =   DatabaseLists::all();

        if($website){
            return view('project.edit', compact('website','operatingSystems','languages','frameworks','databases'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function websiteUpdate(Request $request)
    {
        
        $attributes = request()->validate([
            'name'                      => ['required', 'max:50'],
            'url' => ['required', 'url', Rule::unique('projects', 'url')->ignore($request->id)],
            'ip'                        => ['required', 'ip'],
            'secondary_ip'              => ['nullable'],
            // 'secondary_ip'              => ['nullable', 'ip'],
            'operating_system'          => ['required'],
            'operating_system_version'  => ['required', 'between:0,99.99'],
            'language'                  => ['required'],
            'language_version'          => ['required', 'between:0,99.99'],
            'framework'                 => ['required'],
            'framework_version'         => ['required', 'between:0,99.99'],
            'database'                  => ['required'],
            'database_version'          => ['required', 'between:0,99.99'],
            'is_exposed_to_content'     => ['required', 'in:YES,NO'],
            'is_dr'                     => ['required','in:YES,NO'],
            'is_vapt_done'              => ['required','in:YES,NO'],
            'is_backup'                 => ['required','in:YES,NO'],
            'file'                      => ['mimes:jpeg,png,pdf,csv', 'max:2048'],
        ]);
        
        try {
            $data = $request->except('_token');
        
            // Update the project
            $affectedRows = Project::where(['user_id' => Auth::user()->id, 'id' => $request->id])->update($data);
        
            if ($affectedRows > 0) {
                
                return redirect()->route('project.index')->with('success', 'Website detail has been updated');

            } else {
                
                return redirect()->route('project.index')->with('success', 'No records were updated');
            }
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->route('project.index')->with('error', 'Failed to update website details');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deleteWebsite(string $id)
    {
        // Find the website
        $website = Project::where(['user_id' => Auth::user()->id, 'id' => $id])->first();

        if ($website) {
            // Delete the website
            $website->delete();

            return redirect()->route('project.index')->with('success', 'Website has been deleted successfully');
        } else {
            // Handle the case where the website is not found
            return redirect()->route('project.index')->with('error', 'Website not found');
        }
    }

    public function viewWebsite($id){

        $website    =   Project::with('getLanguage', 'operatingSystem', 'getFramework', 'getDatabase')->find($id);
        $user       =   User::find($website->user_id);

        return view('project.view', compact('website','user'));
    }
    
}
