<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use App\Http\Controllers\StokController;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if(strlen($katakunci)) {
            $data = Stok::where('id', 'like', "%$katakunci%")
            ->orWhere('nama_barang', 'like', "&$katakunci%")
            ->orWhere('jumlah_barang', 'like', "&$katakunci%")
            ->paginate($jumlahbaris);
        } else{
            $data = Stok::orderBy('id', 'desc')->paginate($jumlahbaris);
        }
        return view('stok.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stok.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('id', $request->id);
        Session::flash('nama_barang', $request->nama_barang);
        Session::flash('jumlah_barang', $request->jumlah_barang);
        Session::flash('stok_awal', $request->stok_awal);
        Session::flash('stok_akhir', $request->stok_akhir);

        $request->validate([
            'id'=>'required|numeric|unique:stok,id',
            'nama_barang'=>'required',
            'jumlah_barang'=>'required',
            'stok_awal'=>'required',
            'stok_akhir'=>'required',
        ], [
            'id.required'=>'Kode barang wajib diisi !',
            'id.numeric'=>'Kode barang wajib diisi dalam angka !',
            'id.unique'=>'Kode barang sudah ada !',
            'nama_barang.required'=>'Nama wajib diisi !',
            'jumlah_barang.required'=>'Jumlah Barang wajib diisi !',
            'stok_awal.required'=>'Stok Awal wajib diisi !',
            'stok_akhir.required'=>'Stok Akhir wajib diisi !',
        ]);
        $data = [
            'id'=>$request->id,
            'nama_barang'=>$request->nama_barang,
            'jumlah_barang'=>$request->jumlah_barang,
            'stok_awal'=>$request->stok_awal,
            'stok_akhir'=>$request->stok_akhir,
        ];
        Stok::create($data);
        return redirect()->to('Stok')->with('succes', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $data = Stok::where('id', $id)->first();
       return view('stok.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang'=>'required',
            'jumlah_barang'=>'required',
            'stok_awal'=>'required',
            'stok_akhir'=>'required',
        ], [
            'nama_barang.required'=>'Nama wajib diisi !',
            'jumlah_barang.required'=>'Jumlah Barang wajib diisi !',
            'stok_awal.required'=>'Stok Awal wajib diisi !',
            'stok_akhir.required'=>'Stok Akhir wajib diisi !',
        ]);
        $data = [
            'nama_barang'=>$request->nama_barang,
            'jumlah_barang'=>$request->jumlah_barang,
            'stok_awal'=>$request->stok_awal,
            'stok_akhir'=>$request->stok_akhir,
        ];
        Stok::where('id', $id)->update($data);
        return redirect()->to('Stok')->with('succes', 'Berhasil mengubah data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Stok::where('id',$id)->delete();
        return redirect()->to('Stok')->with('success', 'Data berhasil dihapus');
    }
}
