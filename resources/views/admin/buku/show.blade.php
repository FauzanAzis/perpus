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
                        <td>Judul Buku</td>
                        <td>:</td>
                        <td>{{ $row->judul }}</td>
                    </tr>
                    <tr>
                        <td>Pengarang</td>
                        <td>:</td>
                        <td>{{ $row->pengarang->nama_pengarang }}</td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <td>:</td>
                        <td>{{ $row->penerbit->nama_penerbit }}</td>
                    </tr>
                    <tr>
                        <td>Klasifikasi</td>
                        <td>:</td>
                        <td>{{ $row->klasifikasi->nama_klasifikasi }}</td>
                    </tr>
                    <tr>
                        <td>Bahasa</td>
                        <td>:</td>
                        <td>{{ $row->bahasa }}</td>
                    </tr>
                    <tr>
                        <td>Edisi</td>
                        <td>:</td>
                        <td>{{ $row->edisi }}</td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td>:</td>
                        <td>{{ $row->isbn }}</td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td>:</td>
                        <td>{{ $row->stok }}</td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td>{{ $row->deskripsi }}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop
