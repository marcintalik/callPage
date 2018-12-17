@extends('layouts.app')
@section('content')
<section class='s-body-e'>
    <div class="container">
        <div class='row'>
            <div class='col-12'>
                <h1>Create shift</h1>
            </div>
            <div class='col-12'>
                <form method="post" action="{{ route('shifts.store') }}">
                    <div class="form-group">
                        @csrf
                        <label for="price">Shift owner:</label>
                        <select required class="form-control" name="shift_owner"/>
                        <option value="" disabled selected>Select your option</option>
                        @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Shift date:</label>
                        <div class='input-group date' id='shift_date'>
                            <input required type='text' name="shift_date" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Shift start:</label>
                        <div class='input-group date' id='shift_start'>
                            <input required type='text' name="shift_start" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Shift end:</label>
                        <div class='input-group date' id='shift_end'>
                            <input required type='text' name="shift_end" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>
                <a class="btn btn-secondary btn-sm btn-back" href="{{url('shifts')}}">Go back</a>
            </div>
        </div>
    </div>
</section> 
@endsection