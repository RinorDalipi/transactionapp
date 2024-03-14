<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'provider_id',
        'user_id',
        'status',
        'currency',
        'amount',
        'description'
    ];
    protected $dates = [
        'updated_at',
        'created_at'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
