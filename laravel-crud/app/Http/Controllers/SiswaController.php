<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data_siswa = \App\Models\Siswa::all();
        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    {
        \App\Models\Siswa::create($request->all());
        return redirect('/siswa')->with('success', 'Data berhasil diinput');
    }

    public function edit($id)
    {
        $siswa = \App\Models\Siswa::find($id);
        return view('siswa.edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, $id)
    {
        $siswa = \App\Models\Siswa::find($id);
        $siswa->update($request->all());
        return redirect('/siswa')->with('success', 'Data berhasil diupdate');
    }

    public function delete(Request $request, $id)
    {
        $siswa = \App\Models\Siswa::find($id);
        $siswa->delete($request->all());
        return redirect('/siswa')->with('success', 'Data berhasil dihapus');
    }
}
