<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'user_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'user_type' => 'string',
        ];
    }

    // User types constants
    public const USER_TYPE_CUSTOMER = 'customer';
    public const USER_TYPE_TECHNICIAN = 'technician';
    public const USER_TYPE_ADMIN = 'admin';
    public const USER_TYPE_MANAGER = 'manager';
    public const USER_TYPE_RECEPTIONIST = 'receptionist';

    // Relationships
    public function technician()
    {
        return $this->hasOne(Technician::class, 'user_id');
    }

    public function customerVehicles()
    {
        return $this->hasMany(CustomerVehicle::class, 'user_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'user_id');
    }

    public function technicianServiceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'technician_id');
    }

    // Scopes
    public function scopeCustomers($query)
    {
        return $query->where('user_type', self::USER_TYPE_CUSTOMER);
    }

    public function scopeTechnicians($query)
    {
        return $query->where('user_type', self::USER_TYPE_TECHNICIAN);
    }

    // Helper methods
    public function isCustomer(): bool
    {
        return $this->user_type === self::USER_TYPE_CUSTOMER;
    }

    public function isTechnician(): bool
    {
        return $this->user_type === self::USER_TYPE_TECHNICIAN;
    }

    public function isAdmin(): bool
    {
        return $this->user_type === self::USER_TYPE_ADMIN;
    }

    public function isManager(): bool
    {
        return $this->user_type === self::USER_TYPE_MANAGER;
    }

    public function isReceptionist(): bool
    {
        return $this->user_type === self::USER_TYPE_RECEPTIONIST;
    }
}
