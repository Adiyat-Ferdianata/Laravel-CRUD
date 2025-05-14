@extends('layoutes.main')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">SHOW</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Menampilkan Data</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <h2 style=" text-align:center;">
                    Show data
                </h2>
            </div>
            <div class="card-body">
                    <div class="form-group" style="text-align: center;">
                        <label for="nama">Nama:</label>
                        <input style="text-align: center; font-size:24px; font-weight: 600;" type="text" readonly class="form-control" id="nama" name="nama" value="{{ $id->nama }}">
                    </div>

                    <div class="form-group" style="text-align: center;">
                        <label for="jenis">Jenis:</label>
                        <input style="text-align: center; font-size:24px; font-weight: 600;" type="text" readonly class="form-control" id="jenis" name="jenis" value="{{ $id->jenis  }}">
                    </div>

                    <div class="form-group" style="text-align: center;">
                        <label for="harga_jual">Harga Jual:</label>
                        <input style="text-align: center; font-size:24px; font-weight: 600;" type="text" readonly class="form-control" id="harga_jual" name="harga_jual" value="{{  $id->harga_jual }}">
                    </div>

                    <div class="form-group" style="text-align: center;">
                        <label for="harga_beli">Harga Beli:</label>
                        <input style="text-align: center; font-size:24px; font-weight: 600;" type="text" readonly class="form-control" id="harga_beli" name="harga_beli" value="{{ $id->harga_beli }}">
                    </div>

                    <div class="form-group" style="text-align: center;">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea style="text-align: center; font-size:24px; font-weight: 600;" readonly class="form-control" id="deskripsi" name="deskripsi">{{ $id->deskripsi }}</textarea>
                    </div>

                    <div class="form-group" style="text-align: center; margin-top:15px;">
                        <label for="foto">Foto Produk:</label><br>
                        @if(isset($id->foto) && !empty($id->foto))
                            <img src="{{ url('image/' . $id->foto) }}" alt="Foto Produk" class="rounded" style="width: 100%; max-width: 200px; height: auto; border: 1px solid;">
                        @else
                            <img src="{{ url('image/nophoto.jpg') }}" alt="No Foto" class="rounded" style="width: 100%; max-width: 200px; height: auto;">
                        @endif
                    </div>
                <div style="text-align:right;">
                    <a href="{{ route('index.index') }}" class="btn btn-primary mt-3">back</a>
                </div>
            </div>
        </div>
    </div>
@endsection