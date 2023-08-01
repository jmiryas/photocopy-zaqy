@extends("layouts.master")

@section("web_title")
Riwayat Pembelian Kertas
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        @if (session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session()->get("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="card-title">Riwayat Pembelian Kertas</h6>

                    <a href="{{ route('orders.create') }}" class="btn btn-sm btn-primary">Beli Kertas</a>
                </div>

                <table class="table table-responsive datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode Pembelian</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $order->order_code }}</td>
                            <td>{{ $order->merk->name }}</td>
                            <td>{{ $order->paperSize->size }} {{
                                $order->paperSize->gsm }}gsm {{ $order->paperSize->width }}x{{ $order->paperSize->height
                                }}mm</td>
                            <td>{{ $order->supplier->name }}</td>
                            <td>{{ $order->amount }}</td>
                            <td>Rp {{ number_format($order->purchase_price, 2) }}</td>
                            <td>Rp {{ number_format($order->purchase_price * $order->amount, 2) }}</td>
                            <td>{{ $order->created_at->format("d, F Y") }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada pesanan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection