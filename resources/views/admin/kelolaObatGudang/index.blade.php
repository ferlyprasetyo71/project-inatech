@extends('layouts.template')
@section('title', 'Kelola Obat ke Gudang')
@section('content')
    <div class="card">
        <div class="card-header">Data Obat ke Gudang</div>
        <div class="card-body">
            {{-- @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif --}}
            <table class="table mb-3" id="table_kelolaObatGudang">
                <thead>
                    <tr class="text-center">
                        <th style="display: none">ID</th>
                        <th class="text-center">KODE</th>
                        <th class="text-center">NAMA ALAT</th>
                        <th class="text-center">NAMA GUDANG</th>
                        <th class="text-center">STOK ALAT</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade text-left" id="obatGudangDetailModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                <div class="modal-header bg-primary" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h5 class="modal-title white" id="myModalLabel17">Detail Obat ke Gudang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body" style="padding: 20px; max-height: 70vh; overflow-y: hidden;">
                    <div id="obatGudang-detail-content" class="container-fluid">
                        <div class="text-center mb-3">
                            <h4 class="mb-4"></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="image-container text-center" style="position: sticky; top: 20px;">
                                    <img src="" alt="Foto Obat" class="img-fluid"
                                        style="width: auto; height: 30vh;">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div style="max-height: 30vh; overflow-y: auto; padding-right: 15px;">
                                    <p><strong>Kode : </strong></p>
                                    <p><strong>Nama Obat : </strong></p>
                                    <p><strong>Nama Gudang : </strong></p>
                                    <p><strong>Stok Obat : </strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                    <button type="button" class="btn btn-danger" id="btn-delete-obatGudang">Hapus</button>
                    <button type="button" class="btn btn-primary" id="btn-edit-obatGudang">Edit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        var currentObatGudangId;
        $(document).ready(function() {
            var dataKelolaObatGudang = $('#table_kelolaObatGudang').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('kelolaObatGudang/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.id_obat = $('#id_obat').val();
                    },
                    "error": function(xhr, error, thrown) {
                        console.error('Error fetching data: ', thrown);
                    }
                },
                columns: [{
                    data: "id_detail_obat",
                    visible: false
                }, {
                    data: "kd_detail_obat",
                    className: "col-md-2 text-center", // Jika tidak ada class, hapus baris ini
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        var url = '{{ route('admin.kelolaObatGudang.show', ':id') }}';
                        url = url.replace(':id', row.id_detail_obat);
                        return '<a href="javascript:void(0);" data-id="' + row.id_detail_obat +
                            '" class="view-obatGudang-details" data-url="' + url +
                            '" data-toggle="modal" data-target="#obatGudangDetailModal">' +
                            data + '</a>';
                    }
                }, {
                    data: "obat.nama",
                    className: "col-md-4 text-center", // Jika tidak ada class, hapus baris ini
                    orderable: false,
                    searchable: true
                }, {
                    data: "gudang.nama",
                    className: "col-md-4 text-center", // Jika tidak ada class, hapus baris ini
                    orderable: false,
                    searchable: true
                }, {
                    data: "stok_obat",
                    className: "col-md-2 text-center", // Jika tidak ada class, hapus baris ini
                    orderable: true,
                    searchable: false
                }],
                pagingType: "simple_numbers", // Tambahkan ini untuk menampilkan angka pagination
                dom: 'frtip', // Mengatur layout DataTables
                language: {
                    search: "" // Menghilangkan teks "Search"
                }
            });

            // Event listener untuk menampilkan detail tambak
            $(document).on('click', '.view-obatGudang-details', function() {
                var url = $(this).data('url');
                currentObatGudangId = $(this).data('id');

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        if (response.html) {
                            // Load konten detail ke modal
                            $('#obatGudang-detail-content').html(response.html);
                            $('#obatGudangDetailModal').modal('show');
                        } else {
                            alert('Gagal memuat detail obat ke gudang');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Gagal memuat detail obat ke gudang');
                    }
                });
            });

            $(document).on('click', '#btn-edit-obatGudang', function() {
                if (currentObatGudangId) {
                    var editUrl = '{{ route('admin.kelolaObatGudang.edit', ':id') }}'.replace(':id',
                        currentObatGudangId);
                    window.location.href = editUrl;
                } else {
                    alert('ID obat ke gudang tidak ditemukan');
                }
            });

            $(document).on('click', '#btn-delete-obatGudang', function() {
                if (currentObatGudangId) {
                    if (confirm('Apakah Anda yakin ingin menghapus obat ke gudang ini?')) {
                        var deleteUrl = '{{ route('admin.kelolaObatGudang.destroy', ':id') }}'.replace(
                            ':id',
                            currentObatGudangId);

                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                $('#obatGudangDetailModal').modal('hide');
                                // Reload DataTable
                                $('#table_kelolaObatGudang').DataTable().ajax.reload();
                                alert('Obat ke gudang berhasil dihapus');
                            },
                            error: function(xhr) {
                                alert('Gagal menghapus obat ke gudang: ' + xhr
                                    .responseText);
                            }
                        });
                    }
                } else {
                    alert('ID obat ke gudang tidak ditemukan');
                }
            });

            // Tambahkan tombol "Tambah" setelah kolom pencarian
            $("#table_kelolaObatGudang_filter").append(
                '<select class="form-control" name="id_obat" id="id_obat" required style="margin-left: 30px; width: 150px;">' +
                '<option value="">- SEMUA -</option>' +
                '@foreach ($obat as $item)' +
                '<option value="{{ $item->id_obat }}">{{ $item->nama }}</option>' +
                '@endforeach' +
                '</select>' +
                '<button id="btn-tambah" class="btn btn-primary ml-2">Tambah</button>'
            );

            // Tambahkan event listener untuk tombol
            $("#btn-tambah").on('click', function() {
                window.location.href =
                    "{{ url('kelolaObatGudang/create') }}"; // Arahkan ke halaman tambah pengguna
            });

            // Menambahkan placeholder pada kolom search
            $('input[type="search"]').attr('placeholder', 'Cari data Obat ke Gudang...');
            $('#id_obat').on('change', function() {
                dataKelolaObatGudang.ajax.reload();
            })
        });
    </script>
@endpush
