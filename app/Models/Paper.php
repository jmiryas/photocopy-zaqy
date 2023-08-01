<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;

    // public function order() {
    //     return $this->belongsTo(Order::class);
    // }

    protected $guarded = [];

    protected $dates = ['created_at'];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    public function merk() {
        return $this->belongsTo(Merk::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function paperSize() {
        return $this->belongsTo(PaperSize::class);
    }

    public function getMoneyFormated($money) {
        return number_format($money, 2);
    }
}
