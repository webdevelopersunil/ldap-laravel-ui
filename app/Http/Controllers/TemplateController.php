<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;

class TemplateController extends Controller
{
    public function getTemplates(){
        
        return Template::all();
    }
}
