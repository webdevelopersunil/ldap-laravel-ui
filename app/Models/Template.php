<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'templates';

    protected $fillable = [
        'user_id',
        'operating_system',
        'operating_system_version',
        'language',
        'language_version',
        'framework',
        'framework_version',
        'database',
        'database_version',
    ];

    public function storeTemplate($template, $user_id){

        $ifFoundTemplate   =   self::where(
                [
                    'operating_system'=>$template['operating_system'],
                    'operating_system_version'=>$template['operating_system_version'],
                    'language'=>$template['language'],
                    'language_version'=>$template['language_version'],
                    'framework'=>$template['framework'],
                    'framework_version'=>$template['framework_version'],
                    'database'=>$template['database'],
                    'database_version'=>$template['database_version'],
                    
                ])->where('user_id',$user_id)->count();
                    
        if($ifFoundTemplate == 0 ){

            $project                            =   new Template();
            $project->user_id                   =   $template['operating_system'];
            $project->operating_system          =   $template['operating_system'];
            $project->operating_system_version  =   $template['operating_system_version'];
            $project->language                  =   $template['language'];
            $project->language_version          =   $template['language_version'];
            $project->framework                 =   $template['framework'];
            $project->framework_version         =   $template['framework_version'];
            $project->database                  =   $template['database'];
            $project->database_version          =   $template['database_version'];
            $project->save();
        }
    }
}
