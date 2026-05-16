<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    // Tambahkan HasFactory di baris ini agar seeder bisa jalan
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Helper untuk cek Role
     */
    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isManager(): bool  { return $this->role === 'manager'; }
    public function isStaf(): bool     { return $this->role === 'staf'; }
    public function isKurir(): bool    { return $this->role === 'kurir'; }

    /**
     * Relasi ke Stock Movements
     */
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    /**
     * Relasi ke Shipments
     */
    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }
}