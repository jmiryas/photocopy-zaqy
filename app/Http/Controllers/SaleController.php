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

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Total query: 7 (untuk dua baris)

        // $sales = Sale::with(["paper", "saleType"])->get();

        // ===============================================

        // Total query: 5

        $sales = Sale::get();
        $papers = Paper::get();
        $saleTypes = SaleType::get();
        $merks = Merk::get();
        $paperSizes = PaperSize::get();

        foreach ($sales as $sale) {
            foreach ($papers as $paper) {
                if ($sale->paper_id == $paper->id) {
                    foreach ($merks as $merk) {
                        if ($paper->merk_id == $merk->id) {
                            // dump($merk->name);
                            $sale["merk"] = $merk;
                        }
                    }

                    foreach ($paperSizes as $paperSize) {
                        if ($paper->paper_size_id == $paperSize->id) {
                            // dump($paperSize->size);
                            $sale["paperSize"] = $paperSize;
                        }
                    }
                }
            }

            foreach ($saleTypes as $saleType) {
                if ($sale->sale_type_id == $saleType->id) {
                    // dump($saleType->type);
                    $sale["saleType"] = $saleType;
                }
            }
        }

        // dd($sales);

        return view("sales.index", compact("sales"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saleTypes = SaleType::get();
        $papers = Paper::get();
        $merks = Merk::get();
        $paperSizes = PaperSize::get();
        $suppliers = Supplier::get();

        foreach ($papers as $paper) {
            if ($paper->sell_price_rim > 0 && $paper->sell_price_partials > 0) {
                foreach ($merks as $merk) {
                    if ($paper->merk_id == $merk->id) {
                        $paper["merk"] = $merk;
                    }
                }

                foreach ($paperSizes as $paperSize) {
                    if ($paper->paper_size_id == $paperSize->id) {
                        $paper["paperSize"] = $paperSize;
                    }
                } 

                foreach ($suppliers as $supplier) {
                    if ($paper->supplier_id == $supplier->id) {
                        $paper["supplier"] = $supplier;
                    }
                } 
            }
        }

        return view("sales.create", compact("saleTypes", "papers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "sale_type_id" => "required|exists:sale_types,id",
            "paper_id" => "required|exists:papers,id",
            "amount" => "required"
        ]);

        $paper = Paper::where("id", $request->paper_id)->first();
        $saleType = SaleType::where("id", $request->sale_type_id)->first();

        if ($saleType->type == "Rim") {
            $sale = Sale::create([
                "sale_type_id" => $request->sale_type_id,
                "paper_id" => $request->paper_id,
                "amount" => $request->amount,
                "sale_price" => $paper->sell_price_rim,
                "total" => $request->amount * $paper->sell_price_rim
            ]);

            $paper->update([
                "paper_rim" => $paper->paper_rim - $request->amount,
                "paper_sheet" => ($paper->paper_rim - $request->amount) * 500
            ]);

            $stockIn = StockType::where("type", "Out")->first();

            Stock::create([
                "stock_type_id" => $stockIn->id,
                "sale_id" => $sale->id,
                "paper_id" => $paper->id
            ]);

        } else if ($saleType->type == "Eceran") {
            $sale = Sale::create([
                "sale_type_id" => $request->sale_type_id,
                "paper_id" => $request->paper_id,
                "amount" => $request->amount,
                "sale_price" => $paper->sell_price_partials,
                "total" => $request->amount * $paper->sell_price_partials
            ]);

            $paper->update([
                "paper_sheet" => $paper->paper_sheet - $request->amount
            ]);

            $stockIn = StockType::where("type", "Out")->first();

            Stock::create([
                "stock_type_id" => $stockIn->id,
                "sale_id" => $sale->id,
                "paper_id" => $paper->id
            ]);
        }

        return redirect(route("sales.index"))->with("success", "Kertas berhasil dijual");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
