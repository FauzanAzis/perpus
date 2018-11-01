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
            <a href="{{ $info['url_edit'] }}" class="btn btn-warning">Edit Data</a>
        </div>
    </div>

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Lihat Data</h3>
        </div>
        <div class="box-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td class="col-md-2">ID</td>
                        <td width="20px">:</td>
                        <td>{{ $row->id }}</td>
                    </tr>
                    <tr>
                        <td>Nama Anggota</td>
                        <td>:</td>
                        <td>{{ $row->nama_anggota }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $row->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $row->jenis_kelamin }}</td>
                    </tr>
                </thead>
            </table>

        </div>

    </div>
@stop
