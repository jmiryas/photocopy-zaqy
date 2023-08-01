@extends("layouts.master")

@section("web_title")
Stok Pembelian Kertas
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h4 class="alert-heading">Total Pembelian Kertas</h4>
                            <p>Berikut adalah informasi mengenai pengeluaran untuk membeli kertas:</p>

                            <hr>

                            <p class="mb-0">
                                <span class="fw-bold">Jumlah Kertas : </span>
                                {{ $totalAmount }} (rim)
                            </p>

                            <p class="mb-0">
                                <span class="fw-bold">Total Pengeluaran : </span>
                                Rp {{ number_format($totalOrder, 2) }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="card-title">Stok Pembelian Kertas</h6>
                </div>

                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga Beli</th>
                                <th scope="col">Total</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stocks as $stock)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $stock->supplier->name }}</td>
                                <td>{{ $stock->merk->name }}</td>
                                <td>
                                    {{ $stock->paperSize->size }} {{
                                    $stock->paperSize->gsm }}gsm {{ $stock->paperSize->width }}x{{
                                    $stock->paperSize->height
                                    }}mm
                                </td>
                                <td>{{ $stock->order->amount }}</td>
                                <td>Rp {{ number_format($stock->order->purchase_price, 2) }}</td>
                                <td>Rp {{ number_format($stock->order->total, 2) }}</td>
                                <td>{{ $stock->created_at->format("d, M Y") }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada pesanan</td>
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