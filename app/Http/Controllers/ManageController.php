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
        $route  =   'database.store';

        return view('manage.create', compact('mode','title','label','route'));
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

    public function databaseEdit(Request $request){

        $title  =   'Update Database System';
        $label  =   'Database System';
        $route  =   'database.update';
        
        $detail  =   DatabaseLists::find($request->id);

        return view('manage.create', compact('title','label','route','detail'));
    }

    public function databaseUpdate(Request $request){

        $os = DatabaseLists::find($request->id);
    
        if ($os) {
            $os->update(['name' => $request->name]);
        }
    
        return redirect()->route('manage.index')->with('success', 'Database has been updated successfully');
    }









    public function osCreate(Request $request){

        $mode   =   'os';
        $title  =   'Create Operating System';
        $label  =   'Operating System';
        $route  =   'os.store';

        return view('manage.create', compact('mode','title','label','route'));
    }

    public function osStore(Request $request){

        $foundAny   =   OperatingSystem::where('name', $request->name)->first();

        if($foundAny){

            return redirect()->route('os.create')->with('error', 'Dublicate Entry!');
        }else{

            OperatingSystem::create(['name'=>$request->name]);

            return redirect()->route('manage.index')->with('success', 'Operating System has been created successfully');
        }
    }

    public function osDelete(Request $request){

        return view('manage.index');
    }

    public function osEdit(Request $request){

        $title  =   'Update Operating System';
        $label  =   'Operating System';
        $route  =   'os.update';
        
        $detail  =   OperatingSystem::find($request->id);

        return view('manage.create', compact('title','label','route','detail'));
    }

    public function osUpdate(Request $request){

        $os = OperatingSystem::find($request->id);
    
        if ($os) {
            $os->update(['name' => $request->name]);
        }
    
        return redirect()->route('manage.index')->with('success', 'OS has been updated successfully');
    }
    










    public function languageCreate(Request $request){

        $mode   =   'language';
        $title  =   'Create Language';
        $label  =   'Programming Language';
        $route  =   'language.store';

        return view('manage.create', compact('mode','title','label','route'));
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

    public function languageEdit(Request $request){

        $title  =   'Update Language System';
        $label  =   'Language System';
        $route  =   'language.update';
        
        $detail  =   Language::find($request->id);

        return view('manage.create', compact('title','label','route','detail'));
    }

    public function languageUpdate(Request $request){

        $os = Language::find($request->id);
    
        if ($os) {
            $os->update(['name' => $request->name]);
        }
    
        return redirect()->route('manage.index')->with('success', 'Programming Language has been updated successfully');
    }








    public function frameworkCreate(Request $request){

        $mode   =   'framework';
        $title  =   'Create Framework';
        $label  =   'Framework';
        $route  =   'framework.store';

        return view('manage.create', compact('mode','title','label','route'));
    }

    public function frameworkStore(Request $request){

        $foundAny   =   Framework::where('name', $request->name)->first();

        if($foundAny){

            return redirect()->route('language.create')->with('error', 'Dublicate Entry!');
        }else{

            Framework::create(['name'=>$request->name]);

            return redirect()->route('manage.index')->with('success', 'Framework has been created successfully');
        }
    }

    public function frameworkDelete(Request $request){

        // return view('manage.index');
    }

    public function frameworkEdit(Request $request){

        $title  =   'Update Framework System';
        $label  =   'Framework System';
        $route  =   'framework.update';
        
        $detail  =   Framework::find($request->id);

        return view('manage.create', compact('title','label','route','detail'));
    }

    public function frameworkUpdate(Request $request){

        $os = Framework::find($request->id);
    
        if ($os) {
            $os->update(['name' => $request->name]);
        }
    
        return redirect()->route('manage.index')->with('success', 'Framework has been updated successfully');
    }
}
