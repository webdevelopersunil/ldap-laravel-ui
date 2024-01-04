<?php

namespace App\Http\Controllers;

use App\Models\DatabaseLists;
use App\Models\Framework;
use App\Models\Language;
use App\Models\OperatingSystem;
use Illuminate\Http\Request;

class ManageController extends Controller
{

    public function manageIndex(Request $request){

        $databases      =   DatabaseLists::all();
        $oss            =   OperatingSystem::all();
        $languages      =   Language::all();
        $frameworks     =   Framework::all();
        
        return view('manage.index', compact('databases', 'oss', 'languages', 'frameworks'));
    }




    public function databaseCreate(Request $request){

        $mode   =   'database';
        $title  =   'Create Database';
        $label  =   'Database';

        return view('manage.create', compact('mode','title','label'));
    }

    public function databaseStore(Request $request){

        $foundAny   =   DatabaseLists::where('name', $request->name)->first();
        if($foundAny){

            return redirect()->route('database.create')->with('error', 'Dublicate Entry!');
        }else{

            DatabaseLists::create(['name'=>$request->name]);

            return redirect()->route('manage.index')->with('success', 'Database has been created successfully');
        }

        return view('manage.index');
    }

    public function databaseDelete(Request $request){

        return view('manage.index');
    }





    public function osCreate(Request $request){

        $mode   =   'Operating System';
        $title  =   'Create Operating System';
        $label  =   'Operating System';

        return view('manage.create', compact('mode','title','label'));
    }

    public function osStore(Request $request){

        $foundAny   =   OperatingSystem::where('name', $request->name)->first();

        if($foundAny){

            return redirect()->route('os.create')->with('error', 'Dublicate Entry!');
        }else{

            DatabaseLists::create(['name'=>$request->name]);

            return redirect()->route('manage.index')->with('success', 'Operating System has been created successfully');
        }
    }

    public function osDelete(Request $request){

        return view('manage.index');
    }






    public function languageCreate(Request $request){

        $mode   =   'language';
        $title  =   'Create Language';
        $label  =   'Programming Language';

        return view('manage.create', compact('mode','title','label'));
    }

    public function languageStore(Request $request){

        $foundAny   =   Language::where('name', $request->name)->first();

        if($foundAny){

            return redirect()->route('language.create')->with('error', 'Dublicate Entry!');
        }else{

            Language::create(['name'=>$request->name]);

            return redirect()->route('manage.index')->with('success', 'Programming language has been created successfully');
        }
    }

    public function languageDelete(Request $request){

        // return view('manage.index');
    }



    public function frameworkCreate(Request $request){

        $mode   =   'framework';
        $title  =   'Create Framework';
        $label  =   'Framework';

        return view('manage.create', compact('mode','title','label'));
    }

    public function frameworkStore(Request $request){

        $foundAny   =   Framework::where('name', $request->name)->first();

        if($foundAny){

            return redirect()->route('language.create')->with('error', 'Dublicate Entry!');
        }else{

            Framework::create(['name'=>$request->name]);

            return redirect()->route('manage.index')->with('success', 'Programming language has been created successfully');
        }
    }

    public function frameworkDelete(Request $request){

        // return view('manage.index');
    }
}
