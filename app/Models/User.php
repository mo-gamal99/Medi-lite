<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserAddress;
use App\Models\UserToken;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'ip_address',
        'device_id',
        'is_active',
        'phone_number',
        'activated_at',
        'fcm_token',
        'verification_document',
        'expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'activated_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['q'])) {
            $q = $filters['q'];
            $query->where(function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%")
                    ->orWhere('phone_number', 'LIKE', "%{$q}%")
                    ->orWhere('ip_address', 'LIKE', "%{$q}%")
                    ->orWhere('device_id', 'LIKE', "%{$q}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('is_active', $filters['status'] == 'active' ? 1 : 0);
        }

        return $query;
    }


    public function getVerificationDocumentUrlAttribute()
    {
        if (!$this->verification_document) {
            return null;
        }

        return asset('storage/' . $this->verification_document);
    }


}
