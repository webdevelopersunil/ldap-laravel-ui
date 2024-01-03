<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
