@extends('layouts.app')
@section('title', 'Create New Cruize')
@section('content')
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

    {!! Form::open(array('route' => 'cruize.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong> {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control'))
            !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ship Name:</strong> {!! Form::text('ship_name', null, array('placeholder' => 'Ship Name','class' => 'form-control'))
            !!}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>From:</strong> {!! Form::text('from', '', array('class' => 'datepicker form-control', 'placeholder' =>
            'From')) !!}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>To:</strong> {!! Form::text('to', '', array('class' => 'datepicker form-control','placeholder' => 'To'))
            !!}
            </div>
        </div>
        {!! Form::hidden('uniq_id', round(microtime(true) * 1000)) !!}
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    {!! Form::close() !!}

    <div class="col-xs-12 col-sm-12 col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif @if ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif

        <h3>Import File Form:</h3>
        <form action="{{ route('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
            <input type="file" name="import_file"/> {{ csrf_field() }}
            <br/>
            <button class="btn btn-primary">Import CSV or Excel File</button>
        </form>
    </div>
@endsection

@section('script') @parent
<script>
    $(function () {
        $(".datepicker").datepicker();
    });
</script>
@stop