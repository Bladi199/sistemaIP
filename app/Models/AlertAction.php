<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertAction extends Model
{
    use HasFactory;

    // ✅ dejar timestamps ACTIVOS
    protected $fillable = [
        'alert_id',
        'user_id',
        'action',
    ];

    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}