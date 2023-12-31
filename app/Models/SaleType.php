<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sales() {
        return $this->hasMany(SaleType::class);
    }
}
