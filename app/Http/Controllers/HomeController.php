<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id            =   Auth::user()->id;

        $portals            =   Project::where( 'user_id', $user_id )->count();
        $back_up_configured =   Project::where( [ 'user_id'=>$user_id, 'is_backup'=>'YES' ] )->count();
        $vapt               =   Project::where( [ 'user_id'=>$user_id, 'is_vapt_done'=>'YES' ] )->count();
        $dr                 =   Project::where( [ 'user_id'=>$user_id, 'is_dr'=>'YES' ] )->count();
        
        $websites = Project::orderBy('id', 'desc')->paginate(20);

        return view('user.dashboard', compact('websites','portals','back_up_configured','vapt','dr') );
    }
}
