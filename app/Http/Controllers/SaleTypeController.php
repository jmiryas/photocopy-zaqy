<?php

namespace App\Http\Controllers;

use App\Models\SaleType;
use Illuminate\Http\Request;

class SaleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleTypes = SaleType::orderBy("created_at", "DESC")->get();

        return view("sale_types.index", compact("saleTypes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("sale_types.create");
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
            "type" => "required|unique:sale_types,type"
        ]);

        SaleType::create([
            "type" => $request->type
        ]);

        return redirect(route("sale-types.index"))->with("success", "Tipe penjualan berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function show(SaleType $saleType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleType $saleType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleType $saleType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleType  $saleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleType $saleType)
    {
        $saleType->delete();

        return redirect(route("sale-types.index"))->with("success", "Tipe penjualan berhasil dihapus!");
    }
}
