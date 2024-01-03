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


}
