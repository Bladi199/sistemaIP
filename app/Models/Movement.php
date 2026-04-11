<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'movement_type_id',
        'movement_reason_id',
        'quantity',
        'notes',
    ];

    // Relaciones
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
{
    return $this->belongsTo(User::class)->withTrashed();
}

    public function movementType()
    {
        return $this->belongsTo(MovementType::class);
    }

    public function movementReason()
    {
        return $this->belongsTo(MovementReason::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

