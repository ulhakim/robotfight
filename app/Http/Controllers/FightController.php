<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Robot;
use App\Fight;
use Auth;
use DB;


class FightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myrobots = robot::where('robot_owner', Auth::user()->name)
        ->get();

        $oprobots = robot::where('robot_owner','!=', Auth::user()->name)
        ->get();

        return view('fight.index', compact('myrobots','oprobots'));
    }

    /**
     * AJAX
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {

        $opcolor = robot::where('id', $request->id)
        ->get();

        $colour = $opcolor[0]->robot_colour;
        $id = $opcolor[0]->id;

    return response()->json(['colour' => $colour , 'id' => $id]);
    }

    /**
     * AJAX calculater winner
     *
     * @return \Illuminate\Http\Response
     */
    public function whowin(Request $request)
    {   

        $myrobot = robot::where('id',$request->myid)
        ->get();

        $oprobot = robot::where('id',$request->opid)
        ->get();

        $myrobot = $myrobot[0] ;
        $oprobot = $oprobot[0] ;

        $factor = array("robot_speed", "robot_weight", "robot_power");
        $round = array();
        $player=array($myrobot , $oprobot);

        foreach ($factor as $fkey) {
            if ( $myrobot->$fkey == $oprobot->$fkey) {
                $random_keys=array_rand($player,2);
                $round[] = $player[$random_keys[0]]->id;
            } elseif ($myrobot->$fkey > $oprobot->$fkey) {
                $round[] = $myrobot->id;
            } elseif ($myrobot->$fkey < $oprobot->$fkey) {
                $round[] = $oprobot->id;
            };
        }

        $result = array_count_values($round);

        if(empty($result[$myrobot->id])){
            $result[$myrobot->id] = 0;
        }

        if(empty($result[$oprobot->id])){
            $result[$oprobot->id] = 0;
        }

        if ($result[$myrobot->id] > $result[$oprobot->id]) {
            $winner = $myrobot;
            $loserr = $oprobot;
        } else {
            $winner = $oprobot;
            $loserr = $myrobot;
        }

        DB::beginTransaction();

        try {

            robot::where('id',$request->myid)->increment('countfights');
            robot::where('id',$request->opid )->increment('countfights');
            robot::where('id',$winner->id)->increment('countwins');
            robot::where('id',$loserr->id)->increment('countlosses');

            $fight = new fight([
                'player1' => $myrobot->id,
                'player2' => $oprobot->id,
                'winner' => $winner->id,
                'loser' => $loserr->id
            ]);
            $fight->save();

            DB::commit();

            return response()->json(['winner' => $winner->robot_name]);

            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
                
        }

    }

    /**
     * Store fight log
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatefight($myrobot,$oprobot,$winner,$losser)
    {

        $fight = new fight([
            'player1' => $myrobot->id,
            'player2' => $oprobot->id,
            'winner' => $winner->id,
            'loser' => $loserr->id
        ]);
        $fight->save();
        return ('done');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
