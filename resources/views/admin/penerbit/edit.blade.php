@extends('adminlte::page')

@section('title', $info['title'])

@section('content_header')
    <h1>{{ $info['title'] }}</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Aksi</h3>
        </div>
        <div class="box-body">
            <a href="{{ $info['url_index'] }}" class="btn btn-info">Lihat Data</a>
        </div>
    </div>

    {!! Form::model($row, ['url' => $row->url_update, 'method' => 'put']) !!}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Data</h3>
        </div>
        <div class="box-body">

            @include('errors.validation')

            <div class="form-group">
                {!! Form::label('nama_penerbit', 'Nama Penerbit', ['class' => 'control-label']) !!}
                {!! Form::text('nama_penerbit', null, ['class' => 'form-control', 'autofocus']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('alamat_penerbit', 'Alamat', ['class' => 'control-label']) !!}
                {!! Form::textarea('alamat_penerbit', null, ['class' => 'form-control']) !!}
            </div>


        </div>

        <div class="box-footer">
            {{ Form::submit('Simpan Data',['class' => 'btn btn-success']) }}
        </div>
    </div>
    {!! Form::close() !!}
@stop
