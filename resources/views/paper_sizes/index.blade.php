@extends("layouts.master")

@section("web_title")
Ukuran Kertas
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
                    <h6 class="card-title">Ukuran Kertas</h6>

                    <a href="{{ route('paper-sizes.create') }}" class="btn btn-sm btn-primary">Tambah Ukuran Kertas</a>
                </div>

                <table class="table table-responsive datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Lebar (mm)</th>
                            <th scope="col">Tinggi (mm)</th>
                            <th scope="col">Berat (gsm)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($paperSizes as $paperSize)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $paperSize->size }}</td>
                            <td>{{ $paperSize->width }}</td>
                            <td>{{ $paperSize->height }}</td>
                            <td>{{ $paperSize->gsm }}</td>
                            <td>
                                <form action="{{ route('paper-sizes.destroy', $paperSize) }}" method="POST">
                                    @csrf
                                    @method("DELETE")

                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada merk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection