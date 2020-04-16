<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Robot;
use Auth;
use Maatwebsite\Exce\Facades\Excel;

class RobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $robots = robot::where('robot_owner', Auth::user()->name)
               ->get();
        return view('robots.index', compact('robots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('robots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'robot_name'=>'required',
            'robot_colour'=>'required',
            'robot_speed'=>'required|numeric',
            'robot_weight'=>'required|numeric',
            'robot_power'=>'required|numeric'
        ]);

        $robot = new robot([
            'robot_name' => $request->get('robot_name'),
            'robot_colour' => $request->get('robot_colour'),
            'robot_owner' => $request->get('robot_owner'),
            'robot_speed' => $request->get('robot_speed'),
            'robot_weight' => $request->get('robot_weight'),
            'robot_power' => $request->get('robot_power')
        ]);
        $robot->save();
        return redirect('/robots')->with('success', 'robot created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
   {
        $robot = robot::find($id);
        return view('robots.edit', compact('robot'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'robot_name'=>'required',
            'robot_colour'=>'required',
            'robot_speed'=>'required',
            'robot_weight'=>'required',
            'robot_power'=>'required'
        ]);

        $robot = robot::find($id);
        $robot->robot_name =  $request->get('robot_name');
        $robot->robot_colour = $request->get('robot_colour');
        $robot->robot_owner = $request->get('robot_owner');
        $robot->robot_speed = $request->get('robot_speed');
        $robot->robot_weight = $request->get('robot_weight');
        $robot->robot_power = $request->get('robot_power');
        $robot->save();

        return redirect('/robots')->with('success', 'robot updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $robot = robot::find($id);
        $robot->delete();

        return redirect('/robots')->with('success', 'robot deleted!');
    }
}

