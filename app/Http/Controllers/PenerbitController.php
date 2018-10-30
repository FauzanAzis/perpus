<?php

namespace App\Http\Controllers;

use App\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\DataTables;

class PenerbitController extends Controller
{
    public function data()
    {
        $model = Penerbit::query();

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
        $info['url_create'] = route('penerbit.create');
        $info['title'] = 'DATA PENERBIT BUKU';

        return view('admin.penerbit.index')
            ->withInfo($info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info['url_index'] = route('penerbit.index');
        $info['title'] = 'BUAT DATA PENERBIT BARU';

        return view('admin.penerbit.create')
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
            'nama_penerbit' => 'required|min:3',
            'alamat_penerbit' => 'required',
        ]);

        $result = Penerbit::create($datas);

        return redirect()->route('penerbit.show', $result->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function show(Penerbit $penerbit)
    {
        $info['url_index'] = route('penerbit.index');
        $info['url_edit'] = $penerbit->url_edit;
        $info['title'] = 'Lihat Data: '.$penerbit->nama_penerbit;
        $row = $penerbit->load('buku') ;

        return view('admin.penerbit.show')
            ->withInfo($info)
            ->withRow($row);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function edit(Penerbit $penerbit)
    {
        $info['url_index'] = route('penerbit.index');
        $info['title'] = 'EDIT DATA : '. $penerbit->nama_penerbit;
        $row = $penerbit;

        return view('admin.penerbit.edit')
            ->withInfo($info)
            ->withRow($penerbit);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penerbit $penerbit)
    {
        $datas = $this->validate($request,[
            'nama_penerbit' => 'required|min:3',
            'alamat_penerbit' => 'required',
        ]);

        $penerbit->update($datas);

        return redirect()->route('penerbit.show', $penerbit->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penerbit $penerbit)
    {
        try {

            Schema::disableForeignKeyConstraints();
            $penerbit->delete();
            Schema::enableForeignKeyConstraints();

            $message = [
                'success' => true,
                'title' => 'Update',
                'type' => 'success',
                'message' => 'Selamat! Data ['.$penerbit->nama_penerbit.'] berhasil dihapus.'
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
