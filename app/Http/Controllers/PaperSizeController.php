<?php

namespace App\Http\Controllers;

use App\Models\PaperSize;
use Illuminate\Http\Request;

class PaperSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paperSizes = PaperSize::orderBy("created_at", "DESC")->get();

        return view("paper_sizes.index", compact("paperSizes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("paper_sizes.create");
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
            "size" => "required",
            "width" => "required|numeric",
            "height" => "required|numeric",
            "gsm" => "required|numeric",
        ]);

        PaperSize::create([
            "size" => $request->size,
            "width" => $request->width,
            "height" => $request->height,
            "gsm" => $request->gsm
        ]);

        return redirect(route("paper-sizes.index"))->with("success", "Ukuran kertas berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaperSize  $paperSize
     * @return \Illuminate\Http\Response
     */
    public function show(PaperSize $paperSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaperSize  $paperSize
     * @return \Illuminate\Http\Response
     */
    public function edit(PaperSize $paperSize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaperSize  $paperSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaperSize $paperSize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaperSize  $paperSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaperSize $paperSize)
    {
        $paperSize->delete();

        return redirect(route("paper-sizes.index"))->with("success", "Ukuran kertas berhasil dihapus!");
    }
}
