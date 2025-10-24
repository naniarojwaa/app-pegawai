<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department; 
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['departemen', 'jabatan'])->latest()->paginate(5);
        
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all(); 
        $positions = Position::all();     

        return view('employees.create', compact('departments', 'positions')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|string|max:50',
            'departemen_id' => 'required|exists:departments,id', 
            'jabatan_id' => 'required|exists:positions,id',
        ]);
        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee data successfully saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $departments = Department::all(); 
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id', 
        ]);

        $employee = Employee::findOrFail($id);
        
        // Update manual per field
        $employee->nama_lengkap = $validated['nama_lengkap'];
        $employee->email = $validated['email'];
        $employee->nomor_telepon = $validated['nomor_telepon'];
        $employee->tanggal_lahir = $validated['tanggal_lahir'];
        $employee->alamat = $validated['alamat'];
        $employee->tanggal_masuk = $validated['tanggal_masuk'];
        $employee->status = $validated['status'];
        $employee->departemen_id = $validated['departemen_id'];
        $employee->jabatan_id = $validated['jabatan_id'];
        
        $employee->save();
        
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
