<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use App\Models\Order;
use App\Models\Paper;
use App\Models\PaperSize;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $papers = Paper::with(["merk", "supplier", "paperSize"])->get();

        $orders = Order::get();

        foreach ($papers as $paper) {
            foreach ($orders as $order) {
                if ($paper->id == $order->paper_id) {
                    $paper["order"] = $order;
                }
            }
        }

        return view("papers.index", compact("papers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function show(Paper $paper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function edit(Paper $paper)
    {
        $orders = Order::get();

        foreach ($orders as $order) {
            if ($paper->id == $order->paper_id) {
                $paper["order"] = $order;
            }
        }

        // dd($paper);

        return view("papers.edit", compact("paper"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paper $paper)
    {
        $this->validate($request, [
            "sell_price_rim" => "required|numeric",
            "sell_price_partials" => "required|numeric",
        ]);

        $paper->update([
            "sell_price_rim" => $request->sell_price_rim,
            "sell_price_partials" => $request->sell_price_partials,
        ]);

        return redirect(route("papers.index"))->with("success", "Harga jual berhasil ditentukan!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paper $paper)
    {
        $paper->delete();

        return redirect(route('papers.index'))->with("success", "Kertas berhasil dihapus!");
    }
}
