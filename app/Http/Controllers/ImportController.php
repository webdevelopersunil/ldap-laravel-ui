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
                        echo "<pre>"; print_r($row);
                        // Check if the Website link is already existed. If existed update it with latest detils
                        $isUrlExist =   Project::where('url', $row['url'])->first();

                        if( $isUrlExist ){

                            dd('true');

                        }else{

                            // check for the Database, Framework, Language and Operating System

                            $islanguageExist            =   Language::where('name', $row['language'])->first();
                            $isOperatingSystemExist     =   OperatingSystem::where('name', $row['operating_system'])->first();
                            $isFrameworkExist           =   Framework::where('name', $row['framework'])->first();
                            $isDatabaseExist            =   DatabaseLists::where('name', $row['database'])->first();
                        }

                    });
                    die;

    }

    
    
}
