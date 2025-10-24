<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::withCount('employees')->latest()->paginate(10);
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:255|unique:departments,nama_departemen',
        ], [
            'nama_departemen.required' => 'Nama departemen wajib diisi',
            'nama_departemen.unique' => 'Nama departemen sudah ada',
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::with('employees')->findOrFail($id);
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:255|unique:departments,nama_departemen,' . $id,
        ], [
            'nama_departemen.required' => 'Nama departemen wajib diisi',
            'nama_departemen.unique' => 'Nama departemen sudah ada',
        ]);

        $department = Department::findOrFail($id);
        $department->update($validated);

        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        
        // Cek apakah departemen memiliki pegawai
        if ($department->employees()->count() > 0) {
            return redirect()->route('departments.index')
                             ->with('error', 'Tidak dapat menghapus departemen yang masih memiliki pegawai.');
        }

        $department->delete();

        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil dihapus.');
    }
}