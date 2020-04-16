@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

            <!-- @if (Route::has('login')) -->
                    @auth
                        <div class="alert alert-success" role="alert">
                            Welcome : {{ Auth::user()->name }}
                        </div>
                    @else


                    @endauth
            <!-- @endif -->
                @if(!$fights->isEmpty())
                <div name="latest-fights">
                  <h1>LATEST FIGHTS</h1>
                  <table class="table">
                    <thead class="thead-light">
                        <tr>
                          <td colspan = 2></td>
                          <td colspan = 2></td>
                          <td ></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fights as $fight)
                        <tr>
                            <td class="align-middle"><span class="dot-icon" style=" background-color: {{$fight->A_colour}};"></span></td>
                            <td class="align-middle text-left">{{$fight->A_name}}</td>
                            <td class="align-middle text-right">{{$fight->B_name}}</td>
                            <td class="align-middle"><span class="dot-icon" style=" background-color: {{$fight->B_colour}};"></span></td>
                            <td class="align-middle text-left">Winner : {{$fight->W_name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                @endif

                @if(!$robots->isEmpty())
                <div name="top-robots">
                  <h1>TOP @if ($robots->count()<10) {{$robots->count()}} @else 10 @endif ROBOTS</h1>
                  <table class="table">
                    <thead class="thead-light">
                        <tr>
                          <td colspan = 2></td>
                          <td class="text-center">Fights</td>
                          <td class="text-center">Wins</td>
                          <td class="text-center">Lossess</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($robots as $robot)
                        <tr>
                            <td class="align-middle"><span class="dot-icon" style=" background-color: {{$robot->robot_colour}};"></span></td>
                            <td class="align-middle">{{$robot->robot_name}}</td>
                            <td class="align-middle text-center">{{$robot->countfights}}</td>
                            <td class="align-middle text-center">{{$robot->countwins}}</td>
                            <td class="align-middle text-center">{{$robot->countlosses}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                @endif




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
