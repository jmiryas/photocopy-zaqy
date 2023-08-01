@extends("layouts.master")

@section("web_title")
Tambah Ukuran Kertas
@endsection

@section("content")
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Ukuran Kertas</h5>

                <form method="POST" action="{{ route('paper-sizes.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Ukuran</label>
                        <div class="col-sm-10">
                            <input value="{{ old('size') }}" name="size" type="text" class="form-control"
                                placeholder="Masukkan ukuran kertas">
                            @error("size")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Lebar (mm)</label>
                        <div class="col-sm-10">
                            <input value="{{ old('width') }}" name="width" type="number" class="form-control"
                                placeholder="Masukkan lebar kertas">
                            @error("width")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tinggi (mm)</label>
                        <div class="col-sm-10">
                            <input value="{{ old('height') }}" name="height" type="number" class="form-control"
                                placeholder="Masukkan tinggi kertas">
                            @error("height")
                            <small class="form-text text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Berat (gsm)</label>
                        <div class="col-sm-10">
                            <input value="{{ old('gsm') }}" name="gsm" type="number" class="form-control"
                                placeholder="Masukkan berat kertas">
                            @error("gsm")
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