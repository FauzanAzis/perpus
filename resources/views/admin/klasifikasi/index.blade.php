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
            <a href="{{ $info['url_create'] }}" class="btn btn-info">Buat Data Baru</a>
        </div>
    </div>

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">List Data</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered"  id="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA KLASIFIKASI</th>
                    <th>AKSI</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('klasifikasi.data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nama_klasifikasi', name: 'nama_klasifikasi' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                autoWidth: false
            });
        });

        function refreshTable() {
            $('#table').DataTable().ajax.reload();;
        }
        function del(data, url) {
            var result = confirm("Anda yakin akan menghapus data "+ data +" ?");
            if (result) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function(result) {
                        swal({
                            position: 'top-end',
                            type: result.type,
                            title: result.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        refreshTable();
                    }
                });
            }
        }

        function del2(data, url) {
            swal({
                title: "Yakin akan menghapus ID : "+ data +" ?",
                text: "Setelah dihapus, data tidak dapat dikembalikan lagi!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(result) {
                            swal(result.message, {
                                icon: result.type,
                            });
                            refreshTable();
                        }
                    });
                }

            })
        }
    </script>
@stop