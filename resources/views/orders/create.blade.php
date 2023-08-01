@extends("layouts.master")

@section("web_title")
Beli Kertas
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Beli Kertas</h5>

                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Supplier</label>
                        <div class="col-sm-10">
                            <select name="supplier_id" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @error("supplier_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Merk</label>
                        <div class="col-sm-10">
                            <select name="merk_id" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                @foreach ($merks as $merk)
                                <option value="{{ $merk->id }}">{{ $merk->name }}</option>
                                @endforeach
                            </select>
                            @error("merk_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Ukuran Kertas</label>
                        <div class="col-sm-10">
                            <select name="paper_size_id" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                @foreach ($paperSizes as $paperSize)
                                <option value="{{ $paperSize->id }}">{{ $paperSize->size }} {{ $paperSize->gsm }}gsm
                                </option>
                                @endforeach
                            </select>
                            @error("paper_size_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Jumlah Beli</label>
                        <div class="col-sm-10">
                            <small class="text-secondary">Berapa banyak membeli kertas dalam rim.</small>
                            <input value="{{ old('amount') }}" name="amount" type="number" class="form-control"
                                placeholder="Masukkan jumlah beli kertas">
                            @error("amount")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Harga Beli</label>
                        <div class="col-sm-10">
                            <small class="text-secondary">Berapa harga beli satu rimnya.</small>
                            <input value="{{ old('purchase_price') }}" name="purchase_price" type="number"
                                class="form-control" placeholder="Masukkan harga beli kertas">
                            @error("purchase_price")
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