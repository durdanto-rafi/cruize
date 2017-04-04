@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Excursion</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('excursion.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'excursion.store','method'=>'POST')) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{$id}}:</strong>
                {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>From:</strong>
                {!! Form::text('from', '', array('placeholder' => 'From','class' => 'form-control')) !!}
            </div>
        </div>

         <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>To:</strong>
                {!! Form::text('to', '', array('id' => 'datepicker','placeholder' => 'To','class' => 'form-control')) !!}
            </div>
        </div>

         <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Time:</strong>
                {!! Form::text('time', null, array('placeholder' => 'Time','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Price:</strong>
                {!! Form::text('price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
            </div>
        </div>

         <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Max no of guest:</strong>
                {!! Form::text('max_number_of_guest', null, array('placeholder' => 'Max no of guest','class' => 'form-control')) !!}
            </div>
        </div>

        {!! Form::hidden('cruize_id', $id, array('class' => 'form-control')) !!}

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

         <script>
            $(function() {
            $( "#datepicker" ).datepicker();
            });
        </script>

    </div>
    {!! Form::close() !!}

@endsection
