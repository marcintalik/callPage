@extends('layouts.app')
@section('content')
<section class='s-body-e'>
    <div class="container">
        <div class='row'>
            <div class='col-12'>
                <h1>Show all shifts</h1>
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>
                <a  href='{{route('shifts.create')}}' role="button" class="btn b-solo btn-info">Create New Shift</a>
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>
                @if($shifts)
                <table style="width:100%">
                    <tr>
                        <th>Shift owner</th>
                        <th>Shift start</th>
                        <th>Shift end</th>
                        <th>Edit</th>
                        <th>Remove</th>
                    </tr>
                    @foreach($shifts as $shift)  
                    <tr>
                        <td>{{$shift->employee->name}}</td>    
                        <td>{{$shift->shift_start}}</td> 
                        <td>{{$shift->shift_end}}</td> 
                        <td><a href='{{route('shifts.edit',['id'=>$shift->id])}}' role="button" class="btn btn-dark">Edit</a></td>
                        <td>
                            <form action="{{ route('shifts.destroy', ['id'=>$shift->id])}}" method="POST">
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