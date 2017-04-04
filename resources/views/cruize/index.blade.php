@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>cruizes CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('cruize.create') }}"> Create New Cruize</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Ship Name</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($cruizes as $key => $cruize)
    <tr>
        <td>{{ $cruize->id }}</td>
        <td>{{ $cruize->name }}</td>
        <td>{{ $cruize->ship_name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('cruize.show',$cruize->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('cruize.edit',$cruize->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['cruize.destroy', $cruize->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    

@endsection
