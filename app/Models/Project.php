<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Project extends Model
{
    use HasFactory;

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

    public function storeProject($request){

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
            $project->save();

            return $project;
    }
}
