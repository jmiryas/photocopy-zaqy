@extends("layouts.master")

@section("web_title")
Seluruh Kertas
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
                    <h6 class="card-title">
                        Seluruh Kertas <span>| Seluruh kertas yang sudah dibeli</span>
                    </h6>

                    <a href="{{ route('orders.create') }}" class="btn btn-sm btn-primary">Beli Kertas</a>
                </div>

                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Jumlah (Rim)</th>
                                <th scope="col">Jumlah (Lembar)</th>
                                <th scope="col">Harga Beli (Rim)</th>
                                <th scope="col">Harga Jual (Rim)</th>
                                <th scope="col">Harga Jual (Eceran)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Dibuat</th>
                                <th scope="col">Terakhir Diupdate</th>
                                <th scope="col">Tentukan Harga Jual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($papers as $paper)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $paper->supplier->name }}</td>
                                <td>{{ $paper->merk->name }}</td>
                                <td>{{ $paper->paperSize->size }} {{
                                    $paper->paperSize->gsm }}gsm</td>
                                <td>{{ $paper->paper_rim }}</td>
                                <td>{{ $paper->paper_sheet }}</td>
                                <td>Rp {{ number_format($paper->order->purchase_price, 2) }}</td>
                                <td>
                                    @if ($paper->sell_price_rim == 0)
                                    <span class="badge bg-secondary">Belum ditentukan</span>
                                    @else
                                    Rp {{ number_format($paper->sell_price_rim, 2) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($paper->sell_price_partials == 0)
                                    <span class="badge bg-secondary">Belum ditentukan</span>
                                    @else
                                    Rp {{ number_format($paper->sell_price_partials) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($paper->is_available)
                                    <span class="badge bg-success">Tersedia</span>
                                    @else
                                    <span class="badge bg-secondary">Kosong</span>
                                    @endif
                                </td>
                                <td>{{ $paper->created_at->format("d, F Y") }}</td>
                                <td>{{ $paper->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('papers.edit', $paper) }}" class="btn btn-sm btn-warning">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13" class="text-center">Kamu belum memiliki kertas. Silakan melakukan
                                    pemesanan.</td>
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