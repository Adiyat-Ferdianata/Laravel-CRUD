<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // return view( view:  'produk.index');
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Melakukan Validasi data
        $request->validate([
            'nama' => 'required|max:45',
            'jenis' => 'required|max:45',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,giv,svg|max:2048',
        ],
        [
            'nama.required' => 'Nama Wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
            'jenis.required' => 'jenis wajib diisi',
            'jenis.max' => 'jenis maksimal 45 karakter',
            'foto.max' => 'Foto maksimal 2 mb',
            'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif,svg',
            'foto.image' => 'file harus berbentuk image'
        ]);
        
        //jika file foto ada yang terupload
        if(!empty($request->foto)){
            // maka proses berikut akan dijalankan
            $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
            //setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('image'),$fileName);
        }   else {
            $fileName = 'nophoto.jpg';
        }    

        // tambah data produk
        //   DB::table('produks')->insert([
        //         'nama'=>$request->nama,
        //         'jenis'=>$request->jenis,
        //         'harga_jual'=>$request->harga_jual,
        //         'harga_beli'=>$request->harga_beli,
        //         'deskripsi'=>$request->deskripsi,
        //         'foto'=>$fileName,
        //     ]);

        $produk = Produk::create([
            'nama'=>$request->nama,
            'jenis'=>$request->jenis,
            'harga_jual'=>$request->harga_jual,
            'harga_beli'=>$request->harga_beli,
            'deskripsi'=>$request->deskripsi,
            'foto'=>$fileName,
        ]);

        // return redirect()->route('index.index');
        return redirect()->route('index.show', $produk->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $id)
    {
        return view('produk.show',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $id)
    {
        return view('produk.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        // validasi data
        $request->validate([
            'nama' => 'required|max:45',
            'jenis' => 'required|max:45',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,giv,svg|max:2048',
        ],
        [
            'nama.required' => 'Nama Wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
            'jenis.required' => 'jenis wajib diisi',
            'jenis.max' => 'jenis maksimal 45 karakter',
            'foto.max' => 'Foto maksimal 2 mb',
            'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif,svg',
            'foto.image' => 'file harus berbentuk image'
        ]);

        // foto lama
        $fotoLama = DB::table('produks')->select('foto')->where('id',$id)->get();
        foreach($fotoLama as $f1){
            $fotoLama = $f1->foto;
        }

        // jika foto sudah terupload
        if(!empty($request->foto)){
            //maka proses selanjutnya
            $fileName = 'foto-'.$request->id.'.'.$request->foto->extension();
            // setelah tau fotonya sudah masuk maka tempatkan ke public
            $request->foto->move(public_path('image'),$fileName);
        }else{
            $fileName = $fotoLama;
        }

        // update data produk
        DB::table('produks')->where('id',$id)->update([
            'nama' => $request->nama,
            'jenis' =>$request->jenis,
            'harga_jual'=>$request->harga_jual,
            'harga_beli'=>$request->harga_beli,
            'deskripsi'=>$request->deskripsi,
            'foto'=>$fileName,
        ]);
        return redirect()->route('index.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $id)
    {
        $id->delete();

        return redirect()->route('index.index')
                ->with('success','Data Berhasil di Hapus');

    }
}
