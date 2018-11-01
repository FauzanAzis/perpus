<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Klasifikasi;
use App\Penerbit;
use App\Pengarang;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BukuController extends Controller
{

    public function data()
    {
        $model = Buku::with('pengarang','penerbit', 'klasifikasi');

        $datatables = DataTables::of($model)
            ->editColumn('judul', function ($query){
                $string_limit = str_limit($query->judul,20);
                $taq = '<a href="javascript:;" data-toggle="tooltip" title="%s">%s</a>';
                $result = sprintf($taq, $query->judul, $string_limit) ;

                return $result;
            })

            ->addColumn('action', function ($query) {
                $actions =
                    '<a href="' . $query->url_show . '" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-eye-open"></i> Lihat</a> &nbsp;'.
                    '<a href="' . $query->url_edit . '" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;'.
                    '<a href="javascript:;" onclick="del2(\''.$query->id.'\',\''.$query->url_destroy.'\')" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-erase"></i> Hapus</a>';

                return $actions;
            })
            ->escapeColumns(['1'])
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
        $info['url_create'] = route('buku.create');
        $info['title'] = 'DATA BUKU';

        return view('admin.buku.index')
            ->withInfo($info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info['url_index'] = route('buku.index');
        $info['title'] = 'BUAT DATA BUKU BARU';
        $pengarang = Pengarang::orderBy('nama_pengarang')->pluck('nama_pengarang','id');
        $penerbit = Penerbit::orderBy('nama_penerbit')->pluck('nama_penerbit','id');
        $klasifikasi = Klasifikasi::orderBy('nama_klasifikasi')->pluck('nama_klasifikasi','id');

        return view('admin.buku.create')
            ->withPengarang($pengarang)
            ->withPenerbit($penerbit)
            ->withKlasifikasi($klasifikasi)
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
        $this->validate($request,[
            'judul' => 'required|min:3',
            'pengarang_id' => 'required',
            'penerbit_id' => 'required',
            'klasifikasi_id' => 'required',
        ]);

        $result = Buku::create($request->all());

        return redirect()->route('buku.show', $result->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        $info['url_index'] = route('buku.index');
        $info['url_edit'] = $buku->url_edit;
        $info['title'] = 'LIHAT DATA BUKU: '.$buku->nama_pengarang;
        $row = $buku->load('penerbit','pengarang','klasifikasi') ;

        return view('admin.buku.show')
            ->withInfo($info)
            ->withRow($row);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        $info['url_index'] = route('buku.index');
        $info['title'] = 'EDIT DATA BUKU: '. $buku->id;
        $pengarang = Pengarang::orderBy('nama_pengarang')->pluck('nama_pengarang','id');
        $penerbit = Penerbit::orderBy('nama_penerbit')->pluck('nama_penerbit','id');
        $klasifikasi = Klasifikasi::orderBy('nama_klasifikasi')->pluck('nama_klasifikasi','id');

        $row = $buku;

        return view('admin.buku.edit')
            ->withInfo($info)
            ->withPengarang($pengarang)
            ->withPenerbit($penerbit)
            ->withKlasifikasi($klasifikasi)
            ->withRow($buku);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        $this->validate($request,[
            'judul' => 'required|min:3',
            'pengarang_id' => 'required',
            'penerbit_id' => 'required',
            'klasifikasi_id' => 'required',
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.show', $buku->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        try {

//            Schema::disableForeignKeyConstraints();
            $buku->delete();
//            Schema::enableForeignKeyConstraints();

            $message = [
                'success' => true,
                'title' => 'Update',
                'type' => 'success',
                'message' => 'Selamat! Data ['.$buku->judul.'] berhasil dihapus.'
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
