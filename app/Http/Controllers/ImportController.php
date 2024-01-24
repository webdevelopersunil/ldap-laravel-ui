<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Language;
use App\Models\Framework;
use Illuminate\Http\Request;
use App\Models\DatabaseLists;
use App\Models\OperatingSystem;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportController extends Controller{

    public function index(Request $request){

        return view('import.index');
    }

    public function store(Request $request){
        
        $attributes = request()->validate([
            
            'file' => ['mimes:csv,xlsx', 'max:2048', 'required']
        ]);

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $fileName = now()->format('YmdHis') . '_' . $file->getClientOriginalName();
        
            // Store the file
            $status = $file->storeAs('public/import/files', $fileName);
        
            if ($status) {
                // Use the $fileName variable to create the full file path
                $pathToFile = storage_path('app/public/import/files/' . $fileName);
                
                // Read the CSV file
                $this->convertSnakeCase($pathToFile);
            }
            
        }else{
            dd('not return');
            // (new Project)->storeProject($request,NULL);
        }
    }

    public function convertSnakeCase($pathToFile){
        
        $rows   =   SimpleExcelReader::create($pathToFile)->headersToSnakeCase()->getRows()
                    
            ->each(function(array $row) {
                // echo "<pre>"; print_r($row);
                // Check if the Website link is already existed. If existed update it with latest detils
                $isUrlExist =   Project::where('url', $row['url'])->first();

                if( $isUrlExist ){

                    dd('true');

                }else{

                    // check for the Database, Framework, Language and Operating System

                    $islanguageExist            =   Language::where('name', 'LIKE', '%' . $row['language'] . '%')->first();
                    if($islanguageExist){
                        $language_id            =   $islanguageExist->id;
                    }else{
                        $language               =   Language::create(['name'=>$row['language']]);
                        $language_id            =   $language->id;
                    }
                    
                    $isOperatingSystemExist     =   OperatingSystem::where('name', 'LIKE', '%' . $row['operating_system'] . '%')->first();
                    if($isOperatingSystemExist){
                        $operating_system_id            =   $isOperatingSystemExist->id;
                    }else{
                        $os            =   OperatingSystem::create(['name'=>$row['operating_system']]);
                        $operating_system_id    =   $os->id;
                    }

                    $isFrameworkExist           =   Framework::where('name', 'LIKE', '%' . $row['framework'] . '%')->first();
                    if($isFrameworkExist){
                        $framework_id         =   $isFrameworkExist->id;
                    }else{
                        $framework            =   Framework::create(['name'=>$row['framework']]);
                        $framework_id           =   $framework->id;
                    }

                    $isDatabaseExist            =   DatabaseLists::where('name', 'LIKE', '%' . $row['database'] . '%')->first();
                    if($isDatabaseExist){
                        $database_id            =   $isDatabaseExist->id;
                    }else{
                        $database            =   DatabaseLists::create(['name'=>$row['database']]);
                        $database_id    =   $language->id;
                    }

                    // echo $language_id.'-'.$operating_system_id.'-'.$framework_id.'-'.$database_id; die;

                    $stattus    =   (new Project)->storeImportRow($row, $language_id, $operating_system_id, $framework_id, $database_id);

                }
                
            });
            
            return redirect()->route('project.index');
    }

    
    
}
