<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Rap2hpoutre\FastExcel\FastExcel;

class barangController extends Controller
{
    public function store(Request $request){
        try {
            $validatedData = $request->validate([
                'nama_barang' => 'required|string|max:255',
                'Harga_ambil' => 'required|integer',
                'Harga_jual' => 'required|integer',
                'stok' => 'required|integer',
                'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            $image = $request->file('foto_produk');
            $originalFilename = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $hashName = hash('sha256', $originalFilename . time()) . '.' . $extension;
            
            $image->move(public_path('fotoproduk'), $hashName);
            
            $validatedData['foto_produk'] = $hashName;
       
            $userId = Auth::user()->id;
            $validatedData['user_id'] = $userId;

            barangModel::create($validatedData);

            return redirect('/stock-barang')->with('success', 'Data Berhasil Ditambahkan!');
        } catch (\Throwable $e) {
            return redirect('/stock-barang')->with('error', 'Data Gagal Ditambahkan '.$e->getMessage());
        }   
    }
    public function show(){
        $data = barangModel::all();
        return view('stock-barang', compact('data'));
    }
    public function destroy(Request $request){
        $id = $request->input('id');
        $find = barangModel::findOrFail($id);
        if($find){
            $filepath = public_path('fotoproduk/'.$find->foto_produk);
            if (File::exists($filepath)) {
                File::delete($filepath);
            }
            $find->delete();
            return redirect('/stock-barang')->with('success', 'Data Berhasil Dihapus!');
        }
        return redirect('/stock-barang')->with('error', 'Data gagal Dihapus!');
    }

    public function update(Request $request, $id){
        $inputData = $request->all();

        foreach ($inputData as $key => $value) {
            if($value === null){
                $inputData[$key] = '';
            }
        }

        $find = barangModel::findOrFail($id);

        if($request->foto_produk){
            $filePath = public_path('fotoproduk/'.$find->foto_produk);
            $image = $request->file('foto_produk');
            $originalFilename = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $hashName = hash('sha256', $originalFilename . time()) . '.' . $extension;
            $image->move(public_path('fotoproduk'), $hashName);
            $inputData['foto_produk'] = $hashName;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $inputData['foto_produk'] = $hashName;
        }

        $find->update($inputData);
        return redirect('/stock-barang')->with('success', 'Data Berhasil Diupdate!');
    }
    
    public function export (){
        $data = barangModel::all();
        $no = 1;

        (new FastExcel($data))->export('stock-barang.xlsx', function ($item) use ($no) {
            return [
                'No' => $no++,
                'Nama' => $item->nama_barang,
                'Harga Ambil' => $item->Harga_ambil,
                'Harga Jual' => $item->Harga_jual,
                'Stok' => $item->stok,
                'Foto Produk' => $item->fotoproduk,
            ];
        });

        return response()->download('stock-barang.xlsx')->deleteFileAfterSend(true);
    }
}
