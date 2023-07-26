<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'merchant_id',
        'uuid',
        'name',
        'price',
        'stock',
        'description',
        'is_active',
        'created_at',
        'updated_at',
    ];

    public function merchant()
    {
        return $this->hasMany(Merchants::class, 'id', 'merchant_id');
    }
}
