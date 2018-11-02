<?php

namespace App\Http\Controllers;

use App\Klasifikasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KlasifikasiController extends Controller
{
    public function data()
    {
        $model = Klasifikasi::query();

        $datatables = DataTables::of($model)
            ->addColumn('action', function ($query) {
                $actions =
                    '<a href="' . $query->url_show . '" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</a> &nbsp;'.
                    '<a href="' . $query->url_edit . '" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;'.
                    '<a href="javascript:;" onclick="del2(\''.$query->id.'\',\''.$query->url_destroy.'\')" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-erase"></i> Hapus</a>';

                return $actions;
            })
            ->make(true);

        return $datatables;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info['url_create'] = route('klasifikasi.create');
        $info['title'] = 'DATA KLASIFIKASI BUKU';

        return view('admin.klasifikasi.index',compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info['url_index'] = route('klasifikasi.index');
        $info['title'] = 'BUAT DATA KLASIFIKASI BARU';

        return view('admin.klasifikasi.create',compact('info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datas = $this->validate($request,[
            'nama_klasifikasi' => 'required|min:3'
        ]);

        $result = Klasifikasi::create($datas);

        return redirect()->route('klasifikasi.show', $result->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Klasifikasi $klasifikasi)
    {
        $info['url_index'] = route('klasifikasi.index');
        $info['url_edit'] = $klasifikasi->url_edit;
        $info['title'] = 'LIHAT DATA KLASIFIKASI: '.$klasifikasi->nama_klasifikasi;
        $row = $klasifikasi ;

        return view('admin.klasifikasi.show')
            ->withInfo($info)
            ->withRow($row);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Klasifikasi $klasifikasi)
    {
        $info['url_index'] = route('klasifikasi.index');
        $info['title'] = 'EDIT DATA KLASIFIKASI : '. $klasifikasi->nama_klasifikasi;
        $row = $klasifikasi;

        return view('admin.klasifikasi.edit',compact('info','row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Klasifikasi $klasifikasi)
    {
        $datas = $this->validate($request,[
            'nama_klasifikasi' => 'required|min:3'
        ]);

        $klasifikasi->update($datas);

        return redirect()->route('klasifikasi.show', $klasifikasi->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Klasifikasi  $klasifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Klasifikasi $klasifikasi)
    {
        try {
            if ($klasifikasi->BukuAda()) {
                $message = [
                    'success' => false,
                    'type' => 'error',
                    'title' => 'Delete',
                    'message' => 'Maaf! Data tidak dapat dihapus, karena sedang digunakan.',
                ];
                return response()->json($message);
            }
            $klasifikasi->delete();

            $message = [
                'success' => true,
                'title' => 'Delete',
                'type' => 'success',
                'message' => 'Selamat! Data ['.$klasifikasi->nama_klasifikasi.'] berhasil dihapus.'
            ];
            return response()->json($message);

        }catch (\Exception $exception){
            $message = [
                'success' => false,
                'type' => 'error',
                'title' => 'Delete',
                'message' => 'Maaf! Data gagal dihapus. ' . $exception->getMessage(),
                'data' => $exception->getMessage()
            ];
            return response()->json($message);
        }
    }
}
