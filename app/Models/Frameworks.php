<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Frameworks extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'frameworks';

    protected $fillable = [
        'name',
    ];

}
