{{-- <div class="container">
    <div class="text-center mb-3">
        <h4 class="mb-3">Detail Tambak</h4>
        <img src="{{ asset('storage/' . $tambak->foto) }}" alt="Foto Tambak" class="img-fluid"
            style="max-height: 200px; width: auto;">
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <p><strong>Nama Tambak: </strong> {{ $tambak->nama_tambak }}</p>
            </div>
            <div class="col">
                <p><strong>Nama Gudang : </strong> {{ $tambak->gudang->nama ?? 'Gudang tidak ditemukan' }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p><strong>Luas Lahan : </strong> {{ $tambak->luas_lahan}} m²</p>
            </div>
            <div class="col">
                <p><strong>Luas Tambak : </strong> {{ $tambak->luas_tambak }} m²</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p><strong>Lokasi Tambak: </strong> {{ $tambak->lokasi_tambak }}</p>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="text-center mb-3">
        <h4 class="mb-4">{{ $tambak->nama_tambak }}</h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div style="position: sticky; top: 20px;">
                <img src="{{ $tambak->foto ? Storage::url($tambak->foto) : asset('default-image.jpg') }}" alt="Foto Tambak" class="img-fluid rounded mb-3">
            </div>
        </div>
        <div class="col-md-6">
            <div style="max-height: 30vh; overflow-y: auto; padding-right: 15px;">
                <p><strong>Nama Tambak : </strong> {{ $tambak->nama_tambak }} </p>
                <p><strong>Nama Gudang : </strong> {{$tambak->gudang->nama ?? 'Gudang tidak ditemukan' }} </p>
                <p><strong>Luas Lahan: </strong> {{ $tambak->luas_lahan }} m²</p>
                <p><strong>Luas Tambak : </strong> {{ $tambak->luas_tambak }} m²</p>
                <p><strong>Lokasi Tambak : </strong> {{ $tambak->lokasi_tambak }} </p>
            </div>
        </div>
    </div>
</div>



{{-- <div class="text-center mb-3">
    <h4 class="mb-3">Detail Tambak</h4>
    <img src="{{ asset('storage/' . $tambak->foto) }}" alt="Foto Tambak" class="img-fluid" style="max-height: 200px; width: auto;">
</div>
<div class="text-left">
<p><strong>Nama Tambak:</strong> {{ $tambak->nama_tambak }}</p>
<p><strong>Nama Gudang:</strong> {{ $tambak->gudang->nama ?? 'Gudang tidak ditemukan' }}</p>
<p><strong>Luas Lahan:</strong> {{ $tambak->luas_lahan }} m²</p>
<p><strong>Luas Tambak:</strong> {{ $tambak->luas_tambak }} m²</p>
<p><strong>Lokasi Tambak:</strong> {{ $tambak->lokasi_tambak }}</p>
</div> --}}
