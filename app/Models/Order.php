<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['created_at'];

    public function paper() {
        return $this->belongsTo(Paper::class);
    }

    // public function merk() {
    //     return $this->belongsTo(Merk::class);
    // }

    // public function supplier() {
    //     return $this->belongsTo(Supplier::class);
    // }

    // public function paperSize() {
    //     return $this->belongsTo(PaperSize::class);
    // }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }
}
