@extends('layouts.app')
@section('title', 'Excursions')
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th width="400px">Action</th>
        </tr>
    @foreach ($excursions as $key => $excursion)
    <tr>
        <td>{{ $excursion->id }}</td>
        <td>{{ $excursion->title }}</td>
        <td>
            <a class="btn btn-primary btn-sm" href="{{ route('excursion.edit',$excursion->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['excursion.destroy', $excursion->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    <!-- pagination -->
    {!! $excursions->render() !!} 

@endsection
