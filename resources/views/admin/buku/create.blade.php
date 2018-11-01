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

    {!! Form::open(['route' => 'buku.store']) !!}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Entri Data</h3>
        </div>
        <div class="box-body">

            @include('errors.validation')

            <div class="form-group">
                {!! Form::label('judul', 'Judul Buku', ['class' => 'control-label']) !!}
                {!! Form::text('judul', null, ['class' => 'form-control', 'autofocus']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('pengarang_id', 'Pengarang', ['class' => 'control-label']) !!}
                {!! Form::select('pengarang_id', $pengarang , null , ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('penerbit_id', 'Penerbit', ['class' => 'control-label']) !!}
                {!! Form::select('penerbit_id', $penerbit , null , ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('klasifikasi_id', 'Klasifikasi', ['class' => 'control-label']) !!}
                {!! Form::select('klasifikasi_id', $klasifikasi , null , ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('bahasa', 'Bahasa', ['class' => 'control-label']) !!}
                {!! Form::text('bahasa', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('edisi', 'Edisi', ['class' => 'control-label']) !!}
                {!! Form::text('edisi', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('isbn', 'ISBN', ['class' => 'control-label']) !!}
                {!! Form::text('isbn', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('dekripsi', 'Deskripsi Singkat', ['class' => 'control-label']) !!}
                {!! Form::textarea('deskripsi', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('stok', 'Stok', ['class' => 'control-label']) !!}
                {!! Form::text('stok', null, ['class' => 'form-control']) !!}
            </div>

        </div>

        <div class="box-footer">
           {{ Form::submit('Simpan Data',['class' => 'btn btn-success']) }}
        </div>
    </div>
    {!! Form::close() !!}
@stop
