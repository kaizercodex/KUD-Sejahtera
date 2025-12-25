@extends('app')

@section('title', 'Data Master Blok')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Master Blok</li>
                    </ol>
                </nav>
                <h3>Data Master Blok</h3>
                <p class="text-subtitle text-muted">Kelola data blok per kelompok</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Blok</h5>
                    <button type="button" class="btn btn-primary" id="btnTambahBlok">
                        <i class="bi bi-plus-circle"></i> Tambah Blok
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableBlok" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Blok</th>
                                <th>Nama Kelompok</th>
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
@include('datamaster.blok.modal-form')
<script>
$(document).ready(function() {
    $('#kelompok_id').select2({
        theme: 'bootstrap-5',
        dropdownParent: $('#modalBlok'),
        placeholder: 'Pilih Kelompok',
        allowClear: true,
        ajax: {
            url: "{{ route('kelompok.data') }}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term,
                    page: params.page || 1
                };
            },
            processResults: function(data) {
                return {
                    results: data.data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.nama_kelompok
                        };
                    }),
                    pagination: {
                        more: data.current_page < data.last_page
                    }
                };
            },
            cache: true
        }
    });

    var table = $('#tableBlok').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('blok.datatable') }}",
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
                data: 'kode_blok',
                name: 'kode_blok'
            },
            {
                data: 'nama_kelompok',
                name: 'nama_kelompok',
                orderable: false
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
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
        pageLength: 10,
        order: [[3, 'desc']]
    });

    $('#btnTambahBlok').on('click', function() {
        $('#modalBlokLabel').text('Tambah Blok');
        $('#formBlok')[0].reset();
        $('#blokId').val('');
        $('#kelompok_id').val(null).trigger('change');
        $('#modalBlok').modal('show');
    });

    $('#tableBlok').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: "{{ route('blok.show', ':id') }}".replace(':id', id),
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#modalBlokLabel').text('Edit Blok');
                    $('#blokId').val(response.data.id);
                    $('#kode_blok').val(response.data.kode_blok);
                    
                    if (response.data.kelompok_id && response.data.kelompok) {
                        var option = new Option(response.data.kelompok.nama_kelompok, response.data.kelompok_id, true, true);
                        $('#kelompok_id').append(option).trigger('change');
                    } else {
                        $('#kelompok_id').val(null).trigger('change');
                    }
                    
                    $('#modalBlok').modal('show');
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data blok'
                });
            }
        });
    });

    $('#formBlok').on('submit', function(e) {
        e.preventDefault();
        
        var blokId = $('#blokId').val();
        var url = blokId ? "{{ route('blok.update', ':id') }}".replace(':id', blokId) : "{{ route('blok.store') }}";
        var method = blokId ? 'PUT' : 'POST';
        
        var formData = {
            kode_blok: $('#kode_blok').val(),
            kelompok_id: $('#kelompok_id').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#modalBlok').modal('hide');
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

    $('#tableBlok').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus data blok ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('blok.destroy', ':id') }}".replace(':id', id),
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
                        var message = xhr.responseJSON?.message || 'Gagal menghapus data blok';
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
