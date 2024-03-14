<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'config',
        'deleted_at'
    ];
    protected $dates = [
        'updated_at',
        'created_at'
    ];


    public function transaction()
    {
        return $this->belongsToMany(Transaction::class)->withTrashed();
    }

}
