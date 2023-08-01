<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use App\Models\Order;
use App\Models\Paper;
use App\Models\PaperSize;
use App\Models\Stock;
use App\Models\StockType;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::get();
        $papers = Paper::get();
        $merks = Merk::get();
        $suppliers = Supplier::get();
        $paperSizes = PaperSize::get();

        // Mendapatkan merk, supplier dan paper size.

        foreach ($orders as $order) {        
            foreach ($papers as $paper) {
                if ($order->paper_id == $paper->id) {
                    foreach ($merks as $merk) {
                        if ($paper->merk_id == $merk->id) {
                            $order["merk"] = $merk;
                        }
                    }

                    foreach ($suppliers as $supplier) {
                        if ($paper->supplier_id == $supplier->id) {
                            $order["supplier"] = $supplier;
                        }
                    }

                    foreach ($paperSizes as $paperSize) {
                        if ($paper->paper_size_id == $paperSize->id) {
                            $order["paperSize"] = $paperSize;
                        }
                    }
                }
            }
        }

        return view("orders.index", compact("orders"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merks = Merk::get();
        $suppliers = Supplier::get();
        $paperSizes = PaperSize::get();

        return view("orders.create", compact("merks", "suppliers", "paperSizes"));
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
            "supplier_id" => "required|exists:suppliers,id",
            "merk_id" => "required|exists:merks,id",
            "paper_size_id" => "required|exists:paper_sizes,id",
            "amount" => "required|numeric",
            "purchase_price" => "required|numeric",
        ]);

        $paper = Paper::where([
            "supplier_id" => $request->supplier_id,
            "merk_id" => $request->merk_id,
            "paper_size_id" => $request->paper_size_id,
        ])->first();

        // Jika belum ada kertas, maka buat

        if ($paper == null) {
            $paper = Paper::create([
                "merk_id" => $request->merk_id,
                "supplier_id" => $request->supplier_id,
                "paper_size_id" => $request->paper_size_id,
                "paper_rim" => $request->amount,
                "paper_sheet" => $request->amount * 500
            ]);

            $order = Order::create([
                "paper_id" => $paper->id,
                "order_code" => Str::upper(Str::random(16)),
                "amount" => $request->amount,
                "purchase_price" => $request->purchase_price,
                "total" => $request->amount * $request->purchase_price
            ]);

            $stockIn = StockType::where("type", "In")->first();

            Stock::create([
                "stock_type_id" => $stockIn->id,
                "order_id" => $order->id,
                "paper_id" => $paper->id
            ]);
        } else {
            // Jika sudah ada, maka tinggal diupdate

            $paper->update([
                "paper_rim" => $request->amount + $paper->paper_rim,
                "paper_sheet" => ($request->amount + $paper->paper_rim) * 500,
            ]);

            $order = Order::create([
                "paper_id" => $paper->id,
                "order_code" => Str::upper(Str::random(16)),
                "amount" => $request->amount,
                "purchase_price" => $request->purchase_price,
                "total" => $request->amount * $request->purchase_price
            ]);

            $stockIn = StockType::where("type", "In")->first();

            Stock::create([
                "stock_type_id" => $stockIn->id,
                "order_id" => $order->id,
                "paper_id" => $paper->id
            ]);
        }
        
        return redirect(route("orders.index"))->with("success", "Pembelian kertas berhasil!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
