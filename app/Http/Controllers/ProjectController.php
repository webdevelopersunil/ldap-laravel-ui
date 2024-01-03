<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Project;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\TemplateController;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects   =   Project::where('user_id',Auth::user()->id)->paginate(20);
        
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $operatingSystems   =   $this->getOperatingSystem();
        $languages          =   $this->getLanguages();
        $frameworks         =   $this->getFrameworks();
        $databases          =   $this->getDatabase();
        $versions           =   $this->getVersions();
        $templates          =   (new TemplateController)->getTemplates();
        $templateOption     =   count($templates) >= 1 ? 1 : 0;
        
        return view('project.create', compact('operatingSystems','languages','frameworks','databases','versions','templateOption','templates'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if( isset($request->template) && !empty($request->template) ){
            
        }else{

            $attributes = request()->validate([
                'name' => ['required', 'max:50'],
                'url' => ['required', 'url', 'unique:projects,url'],
                'ip' => ['required', 'ip'],
                'secondary_ip' => ['nullable', 'ip'],
                'operating_system' => ['required'],
                'operating_system_version' => ['required'],
                'language' => ['required'],
                'language_version' => ['required'],
                'framework' => ['required'],
                'framework_version' => ['required'],
                'database' => ['required'],
                'database_version' => ['required'],
                'is_exposed_to_content' => ['required', 'in:YES,NO'],
                'is_dr' => ['in:YES,NO'],
                'is_vapt_done' => ['in:YES,NO'],
                'is_backup' => ['in:YES,NO'],
            ]);

            (new Project)->storeProject($request);
            (new Template)->storeTemplate($request, Auth::user()->id);
        }

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
    public function edit(string $id)
    {
        //
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
