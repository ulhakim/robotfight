@extends('layouts.app')

@section('content')

@push('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/colorpicker.js') }}" defer></script>
    <script src="{{ asset('js/vuecolor.js') }}"></script>
@endpush

<div class="container">
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">Your Robot</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="post" action="{{ route('robots.update', $robot->id) }}">
                @method('PATCH') 
                @csrf

                <div class="form-group">    
                    <label for="robot_name">Robot Name:</label>
                    <input type="text" class="form-control" name="robot_name" value="{{ $robot->robot_name }}" />
                </div>
  
                <input type="hidden" class="form-control" name="robot_colour" value="{{ $robot->robot_colour }}"/>
  
                <div class="form-group">
                  <label >Font color</label>
                    <colorpicker :color="defaultColor" v-model="defaultColor" /> 
                    <!-- name="robot_colour" is fix in vue template colorpicker.js -->
                </div>
  
                <div class="form-group">
                    <label for="robot_owner">Owner:</label>
                    <input type="text" class="form-control" name="robot_owner" value="{{ Auth::user()->name }}" readonly/>
                </div>

                <div class="form-group">
                    <label for="robot_speed">Robot Speed:</label>
                    <input type="text" class="form-control" name="robot_speed" value="{{ $robot->robot_speed }}"/>
                </div>

                <div class="form-group">
                    <label for="robot_weight">Robot Weight:</label>
                    <input type="text" class="form-control" name="robot_weight" value="{{ $robot->robot_weight }}"/>
                </div>

                <div class="form-group">
                    <label for="robot_power">Robot Power:</label>
                    <input type="text" class="form-control" name="robot_power" value="{{ $robot->robot_power }}"/>
                </div> 

                <button type="submit" class="btn btn-primary">Update</button>

            </form>

        </div>
    </div>
</div>

@endsection

