<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'url',
        'user_id',
        'file',
        'ip',
        'secondary_ip',
        'operating_system',
        'operating_system_version',
        'language',
        'language_version',
        'framework',
        'framework_version',
        'database',
        'database_version',
        'is_exposed_to_content',
        'is_dr',
        'is_vapt_done',
        'is_backup',
    ];

    public function operatingSystem(){
        return $this->belongsTo(OperatingSystem::class, 'operating_system');
    }

    public function getLanguage(){
        return $this->belongsTo(Language::class, 'language');
    }

    public function getFramework(){
        return $this->belongsTo(Framework::class, 'framework');
    }

    public function getDatabase(){
        return $this->belongsTo(DatabaseLists::class, 'database');
    }

    public function storeProject($request, $fileName){
            
            $project                =   new Project();
            $project->name          =   $request['name'];
            $project->url           =   $request['url'];
            $project->ip            =   $request['ip'];
            $project->user_id       =   Auth::user()->id;
            $project->secondary_ip  =   $request['secondary_ip'];
            $project->operating_system  =   $request['operating_system'];
            $project->operating_system_version  =   $request['operating_system_version'];
            $project->language      =   $request['language'];
            $project->language_version  =   $request['language_version'];
            $project->framework     =   $request['framework'];
            $project->framework_version  =   $request['framework_version'];
            $project->database      =   $request['database'];
            $project->database_version  =   $request['database_version'];
            $project->is_exposed_to_content  =   $request['is_exposed_to_content'];
            $project->is_dr         =   $request['is_dr'];
            $project->is_vapt_done  =   $request['is_vapt_done'];
            $project->is_backup     =   $request['is_backup'];
            
            if( isset($fileName) && !empty($fileName) ){
                $project->file      =   $fileName;
            }
            
            $project->save();
            
            return $project;
    }

    public function storeImportRow($row){

        echo "<pre>"; print_r($row);
        dd('done');
        $project->operating_system          =   $row['operating_system'];
        $project->language                  =   $row['language'];
        $project->framework                 =   $row['framework'];
        $project->database                  =   $row['database'];
        



        $project    =   new Project();

        $project->name                      =   $row['name'];
        $project->user_id                   =   Auth::user()->id;
        $project->url                       =   $row['url'];

        $project->ip                        =   $row['ip'];
        $project->secondary_ip              =   $row['secondary_ip'];

        $project->operating_system_version  =   $row['operating_system_version'];
        $project->language_version          =   $row['language_version'];
        $project->framework_version         =   $row['framework_version'];
        $project->database_version          =   $row['database_version'];

        $project->is_exposed_to_content     =   $row['is_exposed_to_content'];
        $project->is_dr                     =   $row['is_dr'];
        $project->is_vapt_done              =   $row['is_vapt_done'];
        $project->is_backup                 =   $row['is_backup'];

        $project->save();
    }

}
