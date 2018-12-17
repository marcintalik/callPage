@extends('layouts.app')
@section('content')
<section class='s-body-e'>
    <div class="container">
        <div class='row'>
            <div class='col-12'>
                <h1>Edit employee</h1>
            </div>
            <div class='col-12'>
                <form method="post" action="{{ route('employees.update', $employee->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="name">Employee Name:</label>
                        <input type="text" class="form-control" name="employee_name" value="{{ $employee->name }}" />
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>
                <a class="btn btn-secondary btn-sm btn-back" href="{{url('employees')}}">Go back</a>
            </div>
        </div>
    </div>
</section> 
@endsection
