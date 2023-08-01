@extends("layouts.master")

@section("web_title")
Tentukan Harga Jual
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tentukan Harga Jual</h5>

                <form method="POST" action="{{ route('papers.update', $paper) }}">
                    @csrf
                    @method("PUT")

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <h4 class="alert-heading">Modal Pembelian Kertas {{ $paper->merk->name }} {{
                                    $paper->paperSize->size }} {{ $paper->paperSize->width }}x{{
                                    $paper->paperSize->height }}mm di {{ $paper->supplier->name }}</h4>
                                <p>Berikut adalah informasi mengenai modal pembelian kertas di atas:</p>

                                <hr>

                                <p>
                                    <span class="fw-bold">
                                        Harga Beli :
                                    </span>
                                </p>

                                <ol>
                                    <li>
                                        Rp {{ number_format($paper->order->purchase_price, 2) }} (rim)
                                    </li>

                                    <li>
                                        Rp {{ number_format($paper->order->purchase_price, 2) }} / 500 = Rp {{
                                        number_format($paper->order->purchase_price / 500, 2) }} (lembar)
                                    </li>
                                </ol>

                                <p class="mb-0">Pastikan harga jual yang ditentukan lebih dari modal agar terdapat laba.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Harga Jual (Rim)</label>
                        <div class="col-sm-10">
                            <small class="text-secondary">Berapa harga jual kertas satu rimnya.</small>
                            <input value="{{ $paper->sell_price_rim }}" name="sell_price_rim" type="number"
                                class="form-control" placeholder="Masukkan harga jual satu rim kertas">
                            @error("sell_price_rim")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Harga Jual (Eceran)</label>
                        <div class="col-sm-10">
                            <small class="text-secondary">Berapa harga jual kertas setiap lembarnya.</small>
                            <input value="{{ $paper->sell_price_partials }}" name="sell_price_partials" type="number"
                                class="form-control" placeholder="Masukkan harga jual satu lembar kertas">
                            @error("sell_price_partials")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection