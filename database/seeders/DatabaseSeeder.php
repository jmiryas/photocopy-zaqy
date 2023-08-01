<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Merk;
use App\Models\Order;
use App\Models\Paper;
use App\Models\PaperSize;
use App\Models\Sale;
use App\Models\SaleType;
use App\Models\Stock;
use App\Models\StockType;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Merk kertas

        $merk1 = Merk::create([
            "name" => "Sinar Dunia"
        ]);

        $merk2 = Merk::create([
            "name" => "Kiky"
        ]);

        $merk3 = Merk::create([
            "name" => "Copy Paper"
        ]);

        $merk4 = Merk::create([
            "name" => "Paper One"
        ]);

        // Ukuran kertas

        $paper_size1 = PaperSize::create([
            "size" => "A4",
            "width" => 210,
            "height" => 297,
            "gsm" => 60
        ]);

        $paper_size2 = PaperSize::create([
            "size" => "A5",
            "width" => 148,
            "height" => 210,
            "gsm" => 70
        ]);

        $paper_size3 = PaperSize::create([
            "size" => "A3",
            "width" => 297,
            "height" => 420,
            "gsm" => 80
        ]);

        // Supplier kertas

        $supplier1 = Supplier::create([
            "name" => "PT. MARIE JAYA",
            "phone_number" => "0812345678",
            "address" => "Jakarta"
        ]);

        $supplier2 = Supplier::create([
            "name" => "PT. SOUL MURNI",
            "phone_number" => "0812345679",
            "address" => "Jakarta"
        ]);

        // Pemesanan kertas

        // Membuat kertas ketika melakukan order
        // Master data

        $paper1 = Paper::create([
            "merk_id" => $merk1->id,
            "supplier_id" => $supplier1->id,
            "paper_size_id" => $paper_size1->id,
            "paper_rim" => 10,
            "paper_sheet" => 5000,
            "sell_price_rim" => 51000,
            "sell_price_partials" => 200
        ]);

        $paper2 = Paper::create([
            "merk_id" => $merk2->id,
            "supplier_id" => $supplier2->id,
            "paper_size_id" => $paper_size2->id,
            "paper_rim" => 2,
            "paper_sheet" => 1000,
            "sell_price_rim" => 61000,
            "sell_price_partials" => 200
        ]);

        $order1 = Order::create([
            "paper_id" => $paper1->id,
            "order_code" => Str::upper(Str::random(16)),
            "purchase_price" => 50000,
            "amount" => 5,
            "total" => 250000,
        ]);

        $order2 = Order::create([
            "paper_id" => $paper2->id,
            "order_code" => Str::upper(Str::random(16)),
            "purchase_price" => 60000,
            "amount" => 2,
            "total" => 120000,
        ]);

        // Ketika melakukan order, tambah juga stoknya

        $stock_type1 = StockType::create([
            "type" => "In"
        ]);

        $stock_type2 = StockType::create([
            "type" => "Out"
        ]);

        $stock_1 = Stock::create([
            "stock_type_id" => $stock_type1->id,
            "paper_id" => $paper1->id,
            "order_id" => $order1->id,
        ]);

        $stock_2 = Stock::create([
            "stock_type_id" => $stock_type1->id,
            "paper_id" => $paper2->id,
            "order_id" => $order2->id
        ]);

        // Tipe penjualan: rim / eceran

        $sale_type1 = SaleType::create([
            "type" => "Rim"
        ]);

        $sale_type2 = SaleType::create([
            "type" => "Eceran"
        ]);

        // Melakukan penjualan

        $sale1 = Sale::create([
            "sale_type_id" => $sale_type1->id,
            "paper_id" => $paper1->id,
            "amount" => 2,
            "sale_price" => $paper1->sell_price_rim,
            "total" => 2 * $paper1->sell_price_rim,
        ]);

        $sale2 = Sale::create([
            "sale_type_id" => $sale_type2->id,
            "paper_id" => $paper2->id,
            "amount" => 10,
            "sale_price" => $paper1->sell_price_partials,
            "total" => 10 * $paper1->sell_price_partials
        ]);

        // Setiap kali melakukan penjualan master data harus dikurangi

        $paper1->update([
            "paper_rim" => 10 - 2,
            "paper_sheet" => 5000 - 1000,
        ]);
        
        $paper2->update([
            "paper_sheet" => 1000 - 10,
        ]);

        // Ketika melakukan penjualan, buat stock

        $stock_3 = Stock::create([
            "stock_type_id" => $stock_type2->id,
            "paper_id" => $paper1->id,
            "sale_id" => $sale1->id,
        ]);

        $stock_4 = Stock::create([
            "stock_type_id" => $stock_type2->id,
            "paper_id" => $paper2->id,
            "sale_id" => $sale2->id,
        ]);
    }
}
