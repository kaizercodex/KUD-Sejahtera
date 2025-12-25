@extends('app')

@section('title', 'Data Master Kelompok')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Master Kelompok</li>
                    </ol>
                </nav>
                <h3>Data Master Kelompok</h3>
                <p class="text-subtitle text-muted">Kelola data kelompok tani</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Kelompok</h5>
                    <button type="button" class="btn btn-primary" id="btnTambahKelompok">
                        <i class="bi bi-plus-circle"></i> Tambah Kelompok
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableKelompok" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelompok</th>
                                <th>Ketua Kelompok</th>
                                <th>Dibuat</th>
                                <th>Diupdate</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
@include('datamaster.kelompok.modal-form')
<script>
$(document).ready(function() {
    var table = $('#tableKelompok').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('kelompok.datatable') }}",
            type: 'GET'
        },
        columns: [
            {
                data: null,
                name: 'no',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'nama_kelompok',
                name: 'nama_kelompok'
            },
            {
                data: 'ketua_kelompok',
                name: 'ketua_kelompok'
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data) {
                    if (data) {
                        var date = new Date(data);
                        return date.toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }
                    return '-';
                }
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                render: function(data) {
                    if (data) {
                        var date = new Date(data);
                        return date.toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }
                    return '-';
                }
            },
            {
                data: 'id',
                name: 'aksi',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-warning btn-edit" data-id="${data}" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="${data}" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        language: {
            processing: "Memuat data...",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Data tidak ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data yang tersedia",
            infoFiltered: "(difilter dari _MAX_ total data)",
            search: "Cari:",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f><rtip',
        pageLength: 10,
        order: [[3, 'desc']]
    });

    $('#btnTambahKelompok').on('click', function() {
        $('#modalKelompokLabel').text('Tambah Kelompok');
        $('#formKelompok')[0].reset();
        $('#kelompokId').val('');
        $('#modalKelompok').modal('show');
    });

    $('#tableKelompok').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: "{{ route('kelompok.show', ':id') }}".replace(':id', id),
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#modalKelompokLabel').text('Edit Kelompok');
                    $('#kelompokId').val(response.data.id);
                    $('#nama_kelompok').val(response.data.nama_kelompok);
                    $('#ketua_kelompok').val(response.data.ketua_kelompok);
                    $('#modalKelompok').modal('show');
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data kelompok'
                });
            }
        });
    });

    $('#formKelompok').on('submit', function(e) {
        e.preventDefault();
        
        var kelompokId = $('#kelompokId').val();
        var url = kelompokId ? "{{ route('kelompok.update', ':id') }}".replace(':id', kelompokId) : "{{ route('kelompok.store') }}";
        var method = kelompokId ? 'PUT' : 'POST';
        
        var formData = {
            nama_kelompok: $('#nama_kelompok').val(),
            ketua_kelompok: $('#ketua_kelompok').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#modalKelompok').modal('hide');
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON?.errors;
                var errorMessage = 'Terjadi kesalahan';
                
                if (errors) {
                    errorMessage = '<ul class="text-start mb-0">';
                    $.each(errors, function(key, value) {
                        errorMessage += '<li>' + value[0] + '</li>';
                    });
                    errorMessage += '</ul>';
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: errorMessage
                });
            }
        });
    });

    $('#tableKelompok').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus data kelompok ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('kelompok.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr) {
                        var message = xhr.responseJSON?.message || 'Gagal menghapus data kelompok';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: message
                        });
                    }
                });
            }
        });
    });
});
</script>
@endpush
