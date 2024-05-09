<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Notification as NotificationEmail;
use App\Notifications\AccountConfirmation;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_REGISTRAR = 'registrar';
    const ROLE_CASHIER = 'cashier';
    const ROLE_REQUESTER = 'requester';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $registrars = User::whereIn('role', ['registrar', 'admin'])->get();

            foreach ($registrars as $registrar) {
                Notification::create([
                    'title' => "User Account Confirmation",
                    'content' => json_encode(['user', $user->id, 'pending for confirmation.']),
                    'user_id' => $registrar->id,
                ]);
            }
        });

        static::updating(function ($user) {
            if ($user->isDirty('role') && $user->getOriginal('role') === 'confirmation') {
                Notification::create([
                    'title' => "Account Confirmation",
                    'content' => json_encode(['user', $user->id, $user->role]),
                    'user_id' => $user->id,
                ]);

                if ($user->hasVerifiedEmail()) {
                    NotificationEmail::route('mail', $user->email)->notify(new AccountConfirmation());
                }
            }
        });
    }
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
    ];

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isRegistrar()
    {
        return $this->role === self::ROLE_REGISTRAR;
    }

    public function isCashier()
    {
        return $this->role === self::ROLE_CASHIER;
    }

    public function isRequester()
    {
        return $this->role === self::ROLE_REQUESTER;
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function scopeSearch($query, $value){
        $query->where('id', 'like', "%{$value}%")
        ->orWhere('name', 'like', "%{$value}%")
        ->orWhere('email', 'like', "%{$value}%");
    }
}
