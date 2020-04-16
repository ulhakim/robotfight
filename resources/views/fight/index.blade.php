@extends('layouts.app')

@section('content')

@push('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/fight.js') }}" defer></script>
@endpush

<div class="container text-center">

    <div class="col-sm-12">
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div>
        @endif
    </div>  

    <form method="get">
        @csrf

        @if($myrobots->isEmpty())
        <!-- First. check if we have robot? Ok! We dont have  -->

        <div class="align-self-center" style="">
            <h3>YOU HAVE NO ROBOT .<br> Let's  Create One !</h3>
            <a style="margin: 19px;" href="{{ url('/robots/create') }}" class="btn btn-primary">New robot</a>
        </div>
        
        @else
        <!-- Yeah!! We have Robot  -->

        <div class="row">

            <div class="col-sm-5" style="">

                <h1>MY ROBOT</h1>
                <div class="form-group">
                    <select class="form-control dynamic" data-dependent="mycolour" data-id="myid" id="myid">
                        @foreach ($myrobots as $myrobot)
                            <option value="{{ $myrobot->id}}"> Robot {{ $myrobot->robot_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row d-flex justify-content-center dot mycolour" style="background: {{$myrobots[0]->robot_colour}}">
                    <div class="align-self-center">
                        R<h1 id="myid-avatar" >{{$myrobots[0]->id}}</h1>
                    </div>
                </div>

            </div>
                      
            <div class="col-sm-2 align-self-center" style="">-vs-</div>

            @if($oprobots->isEmpty())
            <!-- We have robot. Do we have opponent? No! no opponent avaiable, thus cant fight -->

            <div class="col-sm-5" style="">

                <h1>YOUR OPPENENT</h1>
                <div class="form-group">
                    <select class="form-control" disabled="true">
                        <option value="" selected> No robot avaiable</option>
                    </select>
                </div>

                <div class="row d-flex justify-content-center dot">
                    <div class="align-self-center">
                        <h1 id="opid-avatar" >please try next time</h1>
                    </div>
                </div>

            </div>

            @else
            <!-- We have robot. Opponent also avaiable. Let's fight -->

            <div class="col-sm-5" style="">
              <h1>YOUR OPPENENT</h1>
                <div class="form-group">
                    <select class="form-control dynamic" data-dependent="opcolour" data-id="opid" id="opid">
                        @foreach ($oprobots as $oprobot)
                            <option value="{{ $oprobot->id}}"> Robot {{ $oprobot->robot_name }} Owner : {{ $oprobot->robot_owner }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row d-flex justify-content-center dot opcolour" style="background: {{$oprobots[0]->robot_colour}}">
                    <div class="align-self-center" name="dependent" style="">
                        R<h1 id="opid-avatar" >{{$oprobots[0]->id}}</h1>
                    </div>
                </div>

            </div>

            @endif

        </div> <!-- row end -->

        @endif

        @if(!$myrobots->isEmpty() and !$oprobots->isEmpty())
        <!-- As we have robot and opponet avaiable. "fight" button show up -->

        <div id="go" data-myro="myid"  data-opro="opid">
          <button type="button" class="btn btn-primary">FIGHT</button>
        </div>

        <div class="mt-2">
          <h1 id="winner" ></h1>
        </div>

        @endif

    </form>

</div>

@endsection




