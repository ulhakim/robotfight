@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">My Robots</h1>  

            <div class="col-sm-12">
                @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}  
                </div>
                @endif
            </div>  

            <div align="right">
                <a href="{{ url('/robots/create') }}" class="btn btn-primary">New robot</a>
                <a class="btn btn-primary" disabled>Import</a>
            </div>

            <div class="mt-2">
                <table class="table table-striped ">

                    <thead>
                        <tr>
                            <td colspan="2">Robot Name</td>
                            <td class="text-center">Speed</td>
                            <td class="text-center">Weight</td>
                            <td class="text-center">Power</td>
                            <td colspan = 2></td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($robots as $robot)
                        <tr>
                            <td class="align-middle"><span class="dot-icon" style=" background-color: {{$robot->robot_colour}};"></span></td>
                            <td class="align-middle text-left">{{$robot->robot_name}}</td>
                            <td class="align-middle text-center">{{$robot->robot_speed}}</td>
                            <td class="align-middle text-center">{{$robot->robot_weight}}</td>
                            <td class="align-middle text-center">{{$robot->robot_power}}</td>
                            <td class="align-middle">
                                <a href="{{ route('robots.edit',$robot->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('robots.destroy', $robot->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

@endsection