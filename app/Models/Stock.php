<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['created_at'];

    public function stockType() {
        return $this->belongsTo(StockType::class);
    }

    public function paper() {
        return $this->belongsTo(Paper::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function sale() {
        return $this->belongsTo(Sale::class);
    }
}
