<?php

namespace App\Http\Controllers;

use App\Pengarang;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Pengarangcontroller extends Controller
{
    public function data()
    {
        $model = Pengarang::query();

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
        $info['url_create'] = route('pengarang.create');
        $info['title'] = 'DATA PENGARANG';

        return view('admin.pengarang.index')
            ->withInfo($info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info['url_index'] = route('pengarang.index');
        $info['title'] = 'BUAT DATA PENGARANG BARU';

        return view('admin.pengarang.create')
            ->withInfo($info);
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
            'nama_pengarang' => 'required|min:3',
            'alamat_pengarang' => 'required',
        ]);

        $result = Pengarang::create($datas);

        return redirect()->route('pengarang.show', $result->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengarang  $pengarang
     * @return \Illuminate\Http\Response
     */
    public function show(Pengarang $pengarang)
    {
        $info['url_index'] = route('pengarang.index');
        $info['url_edit'] = $pengarang->url_edit;
        $info['title'] = 'LIHAT DATA PENGARANG: '.$pengarang->nama_pengarang;
        $row = $pengarang->load('buku') ;

        return view('admin.pengarang.show')
            ->withInfo($info)
            ->withRow($row);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengarang  $pengarang
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengarang $pengarang)
    {
        $info['url_index'] = route('pengarang.index');
        $info['title'] = 'EDIT DATA PENGARANG: '. $pengarang->nama_pengarang;
        $row = $pengarang;

        return view('admin.pengarang.edit')
            ->withInfo($info)
            ->withRow($pengarang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengarang  $pengarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengarang $pengarang)
    {
        $datas = $this->validate($request,[
            'nama_pengarang' => 'required|min:3',
            'alamat_pengarang' => 'required',
        ]);

        $pengarang->update($request->all());

        return redirect()->route('pengarang.show', $pengarang->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengarang  $pengarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengarang $pengarang)
    {
        try {

            if ($pengarang->BukuAda()) {
                $message = [
                    'success' => false,
                    'type' => 'error',
                    'title' => 'Delete',
                    'message' => 'Maaf! Data tidak dapat dihapus, karena sedang digunakan.',
                ];
                return response()->json($message);
            }

            $pengarang->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'type' => 'success',
                'message' => 'Selamat! Data ['.$pengarang->nama_pengarang.'] berhasil dihapus.'
            ];
            return response()->json($message);

        }catch (\Exception $exception){
            $message = [
                'success' => false,
                'type' => 'error',
                'title' => 'Update',
                'message' => 'Maaf! Data gagal dihapus.',
                'data' => $exception->getMessage()
            ];
            return response()->json($message);
        }
    }
}
