<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchants extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'merchants';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'owner_id',
        'uuid',
        'avatar',
        'name',
        'address',
        'phone_number',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function owner()
    {
        return $this->hasMany(User::class, 'id', 'owner_id');
    }
}
