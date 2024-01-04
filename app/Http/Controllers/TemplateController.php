<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProjectController;
use App\Models\Template;

class TemplateController extends Controller
{
    public function getTemplates(){
        
        return Template::all();
    }

    public function setTemplate(Request $request){
        
        $template_obj       =   Template::find($request->template);
        
        $operatingSystems   =   (new ProjectController)->getOperatingSystem();
        $languages          =   (new ProjectController)->getLanguages();
        $frameworks         =   (new ProjectController)->getFrameworks();
        $databases          =   (new ProjectController)->getDatabase();
        $versions           =   (new ProjectController)->getVersions();
        $templates          =   (new TemplateController)->getTemplates();
        $templateOption     =   count($templates) >= 1 ? 1 : 0;

        return view('project.create', compact('operatingSystems','languages','frameworks','databases','versions','templateOption','templates','template_obj','template_obj'));
    }
}
