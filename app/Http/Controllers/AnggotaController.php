<?php

namespace App\Http\Controllers;

use App\Anggota;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AnggotaController extends Controller
{

    public function data()
    {
        $model = Anggota::query();

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
        $info['url_create'] = route('anggota.create');
        $info['title'] = 'DATA ANGGOTA';

        return view('admin.anggota.index')
            ->withInfo($info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info['url_index'] = route('anggota.index');
        $info['title'] = 'BUAT DATA ANGGOTA BARU';

        return view('admin.anggota.create')
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
            'nama_anggota' => 'required|min:3',
        ]);

        $result = Anggota::create($request->all());

        return redirect()->route('anggota.show', $result->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show(Anggota $anggota)
    {
        $info['url_index'] = route('anggota.index');
        $info['url_edit'] = $anggota->url_edit;
        $info['title'] = 'Lihat Data: '.$anggota->nama_anggota;
        $row = $anggota ;

        return view('admin.anggota.show')
            ->withInfo($info)
            ->withRow($row);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota)
    {
        $info['url_index'] = route('anggota.index');
        $info['title'] = 'EDIT DATA : '. $anggota->nama_anggota;
        $row = $anggota;

        return view('admin.anggota.edit')
            ->withInfo($info)
            ->withRow($anggota);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anggota $anggota)
    {
        $datas = $this->validate($request,[
            'nama_anggota' => 'required|min:3',
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggota.show', $anggota->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $anggota)
    {
        try {

            $anggota->delete();

            $message = [
                'success' => true,
                'title' => 'Update',
                'type' => 'success',
                'message' => 'Selamat! Data ['.$anggota->nama_anggota.'] berhasil dihapus.'
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
