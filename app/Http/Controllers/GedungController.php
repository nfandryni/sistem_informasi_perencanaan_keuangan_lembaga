<?php

namespace App\Http\Controllers;

use App\Models\gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(gedung $gedung)
    {
        $data = [
            'gedung' => $gedung->all()
        ];
        return view('dashboard-bendahara.gedung.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-bendahara.gedung.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, gedung $gedung)
    {
        $data = $request->validate(
            [
                'nama_gedung'    => ['required'],
                'nama_ruangan'    => ['required'],
            ]
        );

        //Proses Insert
        if ($data) {
            // Simpan jika data terisi semua
            $gedung->create($data);
            return redirect('dashboard-bendahara/gedung')->with('success', 'Data gedung surat baru berhasil ditambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data jenis surat gagal ditambahkan');
        }
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
    public function edit(string $id, Request $request, gedung $gedung)
    {
        $data = [
            'gedung' =>  gedung::where('id_gedung', $id)->first()
        ];

        return view('dashboard-bendahara.gedung.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, gedung $gedung)
    {
        $data = $request->validate(
            [
                'nama_gedung'    => ['required'],
                'nama_ruangan'    => ['required'],
            ]
            );

        $id_gedung = $request->input('id_gedung');

        if ($id_gedung !== null) {
            // Process Update
            $dataUpdate = $gedung->where('id_gedung', $id_gedung)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/gedung')->with('success', 'Data jenis surat berhasil di update');
            } else {
                return back()->with('error', 'Data jenis surat gagal di update');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(gedung $gedung, Request $request)
    {
        $id_gedung = $request->input('id_gedung');

        // Hapus 
        $aksi = $gedung->where('id_gedung_surat', $id_gedung)->delete();

        if ($aksi) {
            // Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan'   => 'Data gedung surat berhasil dihapus'
            ];
        } else {
            // Pesan Gagal
            $pesan = [
                'success' => false,
                'pesan'   => 'Data gagal dihapus'
            ];
        }

        return response()->json($pesan);
    }
}