<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use App\Models\Paper;
use App\Models\PaperSize;
use App\Models\Sale;
use App\Models\SaleType;
use App\Models\Stock;
use App\Models\StockType;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function orderStocks() {
        // Mendapatkan stocks untuk In (pembelian)

        $stockType = StockType::where("type", "In")->first();

        $stocks = Stock::with(["order"])->where("stock_type_id", $stockType->id)->get();

        $merks = Merk::get();

        $paperSizes = PaperSize::get();

        $suppliers = Supplier::get();

        $papers = Paper::get();

        $totalOrder = 0;
        $totalAmount = 0;

        foreach ($stocks as $stock) {
            foreach ($papers as $paper) {
                if ($stock->paper_id == $paper->id) {
                    foreach ($suppliers as $supplier) {
                        if ($paper->supplier_id == $supplier->id) {
                            $stock["supplier"] = $supplier;
                        }
                    }

                    foreach ($merks as $merk) {
                        if ($paper->merk_id == $merk->id) {
                            $stock["merk"] = $merk;
                        }
                    }

                    foreach ($paperSizes as $paperSize) {
                        if ($paper->paper_size_id == $paperSize->id) {
                            $stock["paperSize"] = $paperSize;
                        }
                    }
                }
            }

            $totalOrder += $stock->order->total;
            $totalAmount += $stock->order->amount;
        } 

        return view("stocks.orders", compact("stocks", "totalOrder", "totalAmount"));
    }

    public function salesStocks() {
        // Mendapatkan stock untuk out (pengeluaran)

        $stockType = StockType::where("type", "Out")->first();

        $stocks = Stock::with(["sale"])->where("stock_type_id", $stockType->id)->get();

        $merks = Merk::get();

        $paperSizes = PaperSize::get();

        $suppliers = Supplier::get();

        $papers = Paper::get();

        $sales = Sale::get();

        $saleTypes = SaleType::get();

        $saleTypeRim = SaleType::where("type", "Rim")->first();
        $saleTypeEceran = SaleType::where("type", "Eceran")->first();

        $totalAmountRim = 0;
        $totalAmountEceran = 0;
        $totalSale = 0;

        foreach ($stocks as $stock) {
            foreach ($papers as $paper) {
                if ($stock->paper_id == $paper->id) {
                    // Mendapatkan supplier

                    foreach ($suppliers as $supplier) {
                        if ($paper->supplier_id == $supplier->id) {
                            $stock["supplier"] = $supplier;
                        }
                    }

                    // Mendapatkan merk

                    foreach ($merks as $merk) {
                        if ($paper->merk_id == $merk->id) {
                            $stock["merk"] = $merk;
                        }
                    }

                    // Mendapatkan paper size

                    foreach ($paperSizes as $paperSize) {
                        if ($paper->paper_size_id == $paperSize->id) {
                            $stock["paperSize"] = $paperSize;
                        }
                    }
                }
            }

            // Mendapatkan sale type

            foreach ($sales as $sale) {
                if ($stock->sale_id == $sale->id) {
                    foreach ($saleTypes as $saleType) {
                        if ($saleType->id == $sale->sale_type_id) {
                            $stock["saleType"] = $saleType;

                            if ($sale->sale_type_id == $saleTypeRim->id) {
                                $totalAmountRim += $stock->sale->amount;
                            }

                            if ($sale->sale_type_id == $saleTypeEceran->id) {
                                $totalAmountEceran += $stock->sale->amount;
                            }
                        }
                    }
                }
            }

            $totalSale += $stock->sale->total;
        }

        return view("stocks.sales", compact("stocks", "totalAmountRim", "totalAmountEceran", "totalSale"));
    }
}
