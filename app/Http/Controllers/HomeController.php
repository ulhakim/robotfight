<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Robot;
// use App\Fight;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $robots = robot::all()->sortByDesc("countwins")->take(10);
        // $fights = fight::all()->sortByDesc("created_at")->take(5);

        $fights = DB::table('fights')
               ->join('robots as A', 'A.id', '=', 'fights.player1') 
               ->join('robots as B', 'B.id', '=', 'fights.player2') 
               ->join('robots as W', 'W.id', '=', 'fights.winner') 
               ->select('fights.id',
                        'A.robot_name as A_name',
                        'A.robot_colour as A_colour',
                        'B.robot_name as B_name',
                        'B.robot_colour as B_colour',
                        'W.robot_name as W_name',
                        'fights.winner as W_id')
               ->orderBy('fights.created_at', 'desc')->take(5)
               ->get();

        return view('home', compact('robots','fights'));
    }
}
