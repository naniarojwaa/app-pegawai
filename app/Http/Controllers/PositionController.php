<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::latest()->paginate(10); 

        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jabatan' => 'required|string|max:255|unique:positions,nama_jabatan',
            'gaji_pokok' => 'required|integer|min:0', 
        ]);

        Position::create($validatedData);

        return redirect('/positions')->with('success', 'Jabatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $validatedData = $request->validate([

            'nama_jabatan' => 'required|string|max:255|unique:positions,nama_jabatan,' . $position->id,
            'gaji_pokok' => 'required|integer|min:0',
        ]);

        $position->update($validatedData);

        return redirect('/positions')->with('success', 'Jabatan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
         // Cek apakah ada pegawai yang terkait dengan jabatan ini
        if ($position->employees()->exists()) {
            return redirect('/positions')->with('error', 'Gagal menghapus! Jabatan "' . $position->nama_jabatan . '" masih digunakan oleh beberapa Pegawai.');
        }

        // Jika tidak ada yang terkait, lanjutkan penghapusan
        $position->delete();

        return redirect('/positions')->with('success', 'Jabatan berhasil dihapus!');
    }
}
