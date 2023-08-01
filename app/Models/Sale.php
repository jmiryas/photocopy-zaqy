<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['created_at'];

    public function saleType() {
        return $this->belongsTo(SaleType::class);
    }

    public function paper() {
        return $this->belongsTo(Paper::class);
    }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }
}
