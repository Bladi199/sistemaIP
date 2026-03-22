<?php

namespace App\Models;
use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'paternal',
        'maternal',
        'email',
        'password',
        'role_id',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // 🔗 Relaciones
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    //public function resolvedAlerts()
    //{
        //return $this->hasMany(Alert::class, 'resolved_by');
   // }
    public function alertActions()
    {
        return $this->hasMany(AlertAction::class);
    }
    public function sendPasswordResetNotification($token)
{
    $this->notify(new CustomResetPassword($token));
}

}

