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
                        <td>Nama Penerbit</td>
                        <td>:</td>
                        <td>{{ $row->nama_penerbit }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Penerbit</td>
                        <td>:</td>
                        <td>{{ $row->alamat_penerbit }}</td>
                    </tr>
                </thead>
            </table>

        </div>

    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Data Buku Terkait</h3>
        </div>
        <div class="box-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Bahasa</th>
                    <th>Edisi</th>
                    <th>ISBN</th>
                    <th>Deskripsi</th>
                    <th>Stok</th>
                </tr>
                </thead>
                <tbody>
                @foreach($row->buku as $buku)
                    <tr>
                        <td>{{ $buku->id }}</td>
                        <td>{{ $buku->pengarang->nama_pengarang }}</td>
                        <td>{{ $buku->pengarang->nama_pengarang }}</td>
                        <td>{{ $buku->penerbit->nama_penerbit }}</td>
                        <td>{{ $buku->bahasa }}</td>
                        <td>{{ $buku->edisi }}</td>
                        <td>{{ $buku->isbn }}</td>
                        <td>{{ $buku->deskripsi }}</td>
                        <td>{{ $buku->stok }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>
@stop
