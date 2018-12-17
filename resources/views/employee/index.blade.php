@extends('layouts.app')
@section('content')
<section class='s-body-e'>
    <div class="container">
        <div class='row'>
            <div class='col-12'>
                <h1>Show all employees</h1>
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>
                <a  href='{{route('employees.create')}}' role="button" class="btn b-solo btn-info">Create New Employee</a>
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>
                @if($employees)
                <table style="width:100%">
                    <tr>
                        <th>Employee full name</th>
                        <th>Employee created at</th>
                        <th>Edit</th>
                        <th>Remove</th>
                    </tr>
                    @foreach($employees as $employee)  
                    <tr>
                        <td>{{$employee->name}}</td>    
                        <td>{{$employee->created_at}}</td> 
                        <td><a href='{{route('employees.edit',['id'=>$employee->id])}}' role="button" class="btn btn-dark">Edit</a></td>
                        <td>
                            <form action="{{ route('employees.destroy', ['id'=>$employee->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit"  class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>
                <a class="btn btn-secondary btn-sm btn-back" href="{{url('/')}}">Go back</a>
            </div>
        </div>
    </div>
</section>  
@endsection