<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Cache\RedisTagSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;

class UserModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function export()
    {
        $data = User::get();
        $no = 1;

        (new FastExcel($data))->export('users.xlsx', function ($item) use (&$no){
            return [
                'No' => $no++,
                'Name' => $item->name,
                'Username' => $item->username,
                'Password' => $item->password,
                'Role' => $item->role,
            ];
        });
        return response()->download('users.xlsx')->deleteFileAfterSend(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     try {
         // Validation
         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
        // dd($validatedData);

        User::create($validatedData);

        return redirect('/pengguna')->with('success', 'Pengguna berhasil Ditambahkan!');
     } catch (\Throwable $e) {
        return redirect('/pengguna')->with('error', 'Pengguna gagal Ditambahkan!' .  $e->getMessage());
     }   
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data = User::where('id', '!=', Auth::user()->id)
        ->get();
        return view('pengguna', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255'
            ]);
            if($request->password != null){
                $validatedData['password'] = Hash::make($request->password);
            }
            $find = User::findOrFail($id);
            if($find){
                $find->update($validatedData);
                return redirect('/profil')->with('success', 'Profil Berhasil di Update!');
            }
            return redirect('/profil')->with('error', 'Pengguna gagal di Update!');
        } catch (\Throwable $th) {
            return redirect('/profil')->with('error', 'Pengguna gagal di Update!' .  $th->getMessage());
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                'password' => 'required|string',
            ]);
            $find = User::findOrFail($id);
            if($find){
                $find->update($validatedData);
                return redirect('/pengguna')->with('success', 'Pengguna Berhasil di Update!');
            }
            return redirect('/pengguna')->with('error', 'Pengguna gagal Di Update!');
        } catch (\Throwable $th) {
            return redirect('/pengguna')->with('error', 'Pengguna gagal Di Update!' .  $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $find = User::findOrFail($id);
        if($find){
            $find->delete();
            return redirect('/pengguna')->with('success', 'Pengguna Berhasil!');
        }
        return redirect('/pengguna')->with('error', 'Pengguna gagal Dihapus!');
    }
}
