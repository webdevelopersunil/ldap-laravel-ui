<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

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
        $portals            =   Project::count();
        $back_up_configured =   Project::count();
        $vapt               =   Project::count();
        $dr                 =   Project::count();

        $websites = Project::orderBy('id', 'desc')->paginate(20);

        return view('user.dashboard', compact('websites','portals','back_up_configured','vapt','dr') );
    }
}
