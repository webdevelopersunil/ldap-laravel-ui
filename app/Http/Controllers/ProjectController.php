<?php

namespace App\Http\Controllers;


use App\Models\Project;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\TemplateController;
use App\Models\DatabaseLists;
use App\Models\Framework;
use App\Models\Language;
use App\Models\OperatingSystem;
use Illuminate\Cache\DatabaseLock;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Project::where('user_id', Auth::user()->id);
        $by     =  $request->by == 'asc' ? 'ASC' : 'DESC'; 

        if ($request->isMethod('post')){
            
            // os language framework database
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
        
        
        $projects = $query->paginate(20);
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
        
        if( $isFound ){

            return redirect()->route('set.project.template',$request->template);

        }else{
            
            return redirect()->route('set.project.template',$request->template);
        }
    }

    public function setProjectTemplate(Request $request){

        $operatingSystems   =   OperatingSystem::all();
        $languages          =   Language::all();
        $frameworks         =   Framework::all();
        $databases          =   DatabaseLists::all();
        $template           =   Template::find($request->id);
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
            // $request->file  = $fileName;
            // $requestData = $request->all();
            // $requestData['file'] = $fileName;
            // echo $fileName;
            // $request->merge($requestData);
            (new Project)->storeProject($request, $fileName);
        }else{
            (new Project)->storeProject($request);
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
    public function edit(Request $request)
    {
        dd($request->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function getOperatingSystem(){
        return $operatingSystem    =   ['WINDOWS','LINUX'];
    }

    public function getLanguages(){

        return $languages  =   [ 'PHP', 'PYTHON'];
    }

    public function getFrameworks(){
        return $frameworks =   ['LARAVEL','DJANGO','CORE-PHP','CORE-PHP'];
    }

    public function getDatabase(){
        return $database   =   ['MYSQL','MONGO-DB'];
    }

    public function getVersions(){
        return $versions    =   [
            '1.1', '1.2', '1.3', '1.4', '1.5', '1.6', '1.7', '1.8', '1.9', '1.10',
            '2.1', '2.2', '2.3', '2.4', '2.5', '2.6', '2.7', '2.8', '2.9', '2.10',
            '3.1', '3.2', '3.3', '3.4', '3.5', '3.6', '3.7', '3.8', '3.9', '3.10',
            '4.1', '4.2', '4.3', '4.4', '4.5', '4.6', '4.7', '4.8', '4.9', '4.10',
            '5.1', '5.2', '5.3', '5.4', '5.5', '5.6', '5.7', '5.8', '5.9', '5.10',
            '6.1', '6.2', '6.3', '6.4', '6.5', '6.6', '6.7', '6.8', '6.9', '6.10',
            '7.1', '7.2', '7.3', '7.4', '7.5', '7.6', '7.7', '7.8', '7.9', '7.10',
            '8.1', '8.2', '8.3', '8.4', '8.5', '8.6', '8.7', '8.8', '8.9', '8.10',
            '9.1', '9.2', '9.3', '9.4', '9.5', '9.6', '9.7', '9.8', '9.9', '9.10',
            '10.1', '10.2', '10.3', '10.4', '10.5', '10.6', '10.7', '10.8', '10.9', '10.10'
        ];
    }
}
