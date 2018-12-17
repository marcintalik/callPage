@extends('layouts.app')
@section('content')
<section class="s-body">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Find shifts</h1>
                <form method="post" action="{{ route('shifts.search') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Number of days:</label>
                        <div class='input-group' id='number_of_days'>
                            <input required type='number' name="number_of_days" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Shift start:</label>
                        <div class='input-group date' id='shift_date'>
                            <input required type='text' name="shift_date" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Find</button>
                </form>
            </div>
            <div class="col-6">
                <h1>Data management</h1>
                <a href="{{ url('employees/create') }}">Create employee</a>
                <a href="{{ url('shifts/create') }}">Create shift</a>
                <a href="{{ url('employees') }}">Show employees</a>
                <a href="{{ url('shifts') }}">Show shifts</a>
            </div>  
            <div class="col-12">
                @if(!empty($data) )
                <h1>My shifts slots for {{$data[2]}} days from date: {{$data[1]}}</h1>
                <p>{{$data[0]}}</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection



