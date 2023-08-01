@extends("layouts.master")

@section("web_title")
Jual Kertas
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Jual Kertas</h5>

                <form method="POST" action="{{ route('sales.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tipe Penjualan</label>
                        <div class="col-sm-10">
                            <select name="sale_type_id" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                @foreach ($saleTypes as $saleType)
                                <option value="{{ $saleType->id }}">{{ $saleType->type }}</option>
                                @endforeach
                            </select>
                            @error("sale_type_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Pilih Kertas</label>
                        <div class="col-sm-10">
                            <select name="paper_id" class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                @foreach ($papers as $paper)
                                @if ($paper->sell_price_rim > 0 && $paper->sell_price_partials > 0)
                                <option value="{{ $paper->id }}">{{ $paper->merk->name }} {{ $paper->paperSize->size
                                    }} {{ $paper->paperSize->gsm }}gsm | {{ $paper->supplier->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            @error("paper_id")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Jumlah Jual</label>
                        <div class="col-sm-10">
                            <small class="text-secondary">Berapa banyak yang dijual.</small>
                            <input value="{{ old('amount') }}" name="amount" type="number" class="form-control"
                                placeholder="Masukkan banyaknya yang dijual">
                            @error("amount")
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