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
        'username',
        'email',
        'password',
        'role',
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
        ];
    }
public function dashboardUrl()
{
//ret match(#th-role){role => role.ds}
    return match($this->role) {
        'admin'   => route('admin.dashboard'),
        'petugas' => route('officer.dashboard'),
        default   => route('borrower.dashboard'),
    };
}

public function loans()
{
    return $this->hasMany(loan::class, 'borrower_id');
}

public function borrower()
{
    // has one 
    return $this->hasOne(Borrower::class);
}

}
