@extends('layouts.app')
@section('title', 'Guests')
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="400px">Action</th>
        </tr>
    @foreach ($guests as $key => $guest)
    <tr>
        <td>{{ $guest->id }}</td>
        <td>{{ $guest->first_name }}</td>
        <td>
            <a class="btn btn-primary btn-sm" href="{{ route('guest.edit',$guest->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['guest.destroy', $guest->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    <!-- pagination -->
    {!! $guests->render() !!} 

@endsection
