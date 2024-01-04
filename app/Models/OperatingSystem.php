<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperatingSystem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'operating_systems';

    protected $fillable = [
        'name',
    ];
}
