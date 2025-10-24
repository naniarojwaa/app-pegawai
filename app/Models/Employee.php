<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    
    protected $fillable = [ 
        'nama_lengkap', 
        'email', 
        'nomor_telepon', 
        'tanggal_lahir', 
        'alamat', 
        'tanggal_masuk', 
        'status', 
        'departemen_id', 
        'jabatan_id', 
    ];

    /**
     * Get the department that owns the Employee.
     */
    public function departemen(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }
    
    /**
     * Get the position that owns the Employee.
     */
    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }
}