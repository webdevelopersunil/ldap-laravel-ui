<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatabaseLists extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    =  'database_lists';

    protected $fillable =   [
        'name',
    ];

    // Mutator to set the 'name' attribute in uppercase and replace spaces with hyphens
    public function setNameAttribute($value){
        
        $this->attributes['name'] = str_replace(' ', '-', strtoupper($value));
    }
}
