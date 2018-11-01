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
                {!! Form::label('nama_anggota', 'Nama Anggota', ['class' => 'control-label']) !!}
                {!! Form::text('nama_anggota', null, ['class' => 'form-control', 'autofocus']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class' => 'control-label']) !!}
                {!! Form::select('jenis_kelamin', ['Pria' =>'Pria', 'Wanita'=>'Wanita'] , null , ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('alamat', 'Alamat', ['class' => 'control-label']) !!}
                {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
            </div>


        </div>

        <div class="box-footer">
            {{ Form::submit('Simpan Data',['class' => 'btn btn-success']) }}
        </div>
    </div>
    {!! Form::close() !!}
@stop
