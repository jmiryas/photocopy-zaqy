<?php

namespace App\Http\Controllers;

use App\Models\StockType;
use Illuminate\Http\Request;

class StockTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockTypes = StockType::orderBy("created_at", "DESC")->get();

        return view("stock_types.index", compact("stockTypes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("stock_types.create");
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
            "type" => "required|unique:stock_types,type"
        ]);

        StockType::create([
            "type" => $request->type
        ]);

        return redirect(route("stock-types.index"))->with("success", "Tipe stok berhasil ditambah!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockType  $stockType
     * @return \Illuminate\Http\Response
     */
    public function show(StockType $stockType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockType  $stockType
     * @return \Illuminate\Http\Response
     */
    public function edit(StockType $stockType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockType  $stockType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockType $stockType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockType  $stockType
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockType $stockType)
    {
        $stockType->delete();

        return redirect(route("stock-types.index"))->with("success", "Tipe stok berhasil dihapus!");
    }
}
