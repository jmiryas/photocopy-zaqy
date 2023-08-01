@extends("layouts.master")

@section("web_title")
Riwayat Penjualan Kertas
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="card-title">Riwayat Penjualan Kertas</h6>

                    <a href="{{ route('sales.create') }}" class="btn btn-sm btn-primary">Jual Kertas</a>
                </div>

                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Tipe Penjualan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- 1 --}}

                            {{-- @forelse ($sales as $sale)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $sale->saleType->type }}</td>
                                <td>{{ $sale->paper->merk->name }}</td>
                                <td>{{ $sale->paper->paperSize->size }} {{
                                    $sale->paper->paperSize->gsm }}gsm</td>
                                <td>{{ $sale->amount }}</td>
                                <td>Rp {{ number_format($sale->sale_price, 2) }}</td>
                                <td>Rp {{ number_format($sale->total, 2) }}</td>
                                <td>{{ $sale->created_at->format("d, M Y") }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada penjualan</td>
                            </tr>
                            @endforelse --}}

                            {{-- 2 --}}

                            @forelse ($sales as $sale)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $sale->merk->name }}</td>
                                <td>{{ $sale->paperSize->size }} {{
                                    $sale->paperSize->gsm }}gsm {{ $sale->paperSize->width }}x{{
                                    $sale->paperSize->height }}mm</td>
                                <td>{{ $sale->amount }}</td>
                                <td>{{ $sale->saleType->type }}</td>
                                <td>Rp {{ number_format($sale->sale_price, 2) }}</td>
                                <td>Rp {{ number_format($sale->total, 2) }}</td>
                                <td>{{ $sale->created_at->format("d, F Y") }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada penjualan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection