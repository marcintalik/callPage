@extends('layouts.app')
@section('content')     
<section class='s-body-e'>
    <div class="container">
        <div class='row'>
            <div class='col-12'>
                <h1>Edit shift</h1>
            </div>
            <div class='col-12'>
                <form method="post" action="{{ route('shifts.update', $shift->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="price">Shift Owner:</label>
                        <select required class="form-control" name="shift_owner"/>
                        @if($shift->employee)
                        <option value="{{$shift->employee->id}}">{{$shift->employee->name}}</option>
                        @else
                        <option value="" disabled selected>Select your option</option>
                        @endif
                        @foreach($employees as $employee)
                        @if($shift->id != $shift->employee->id)
                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                        @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Shift date:</label>
                        <div class='input-group date' id='shift_date'>
                            <input required type='text' name="shift_date" class="form-control" value="{{str_replace('-','',substr($shift->shift_start,8,2)).'/'.str_replace('-','',substr($shift->shift_start,5,2)).'/'.str_replace('-','',substr($shift->shift_start,0,4))}}" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Shift start:</label>
                        <div class='input-group date' id='shift_start'>
                            <input required type='text' name="shift_start" class="form-control" value="{{ substr($shift->shift_start,11  ) }}"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Shift end:</label>
                        <div class='input-group date' id='shift_end'>
                            <input required type='text' name="shift_end" class="form-control" value="{{ substr($shift->shift_end,11  ) }}"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
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
