@extends('app')

@section('title', 'Data Master Lahan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Master Lahan</li>
                    </ol>
                </nav>
                <h3>Data Master Lahan</h3>
                <p class="text-subtitle text-muted">Kelola data lahan jaminan</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Lahan</h5>
                    <button type="button" class="btn btn-primary" id="btnTambahLahan">
                        <i class="bi bi-plus-circle"></i> Tambah Lahan
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableLahan" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peserta</th>
                                <th>Petani</th>
                                <th>No SHM</th>
                                <th>Tanggal SHM</th>
                                <th>Alamat Jaminan</th>
                                <th>Luas (m²)</th>
                                <th>Blok</th>
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
@include('datamaster.lahan.modal-form')
<script>
$(document).ready(function() {
    $('#peserta_id').select2({
        dropdownParent: $('#modalLahan'),
        placeholder: 'Pilih Peserta',
        allowClear: true,
        ajax: {
            url: "{{ route('api.select2.peserta') }}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term,
                    page: params.page || 1
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                
                return {
                    results: data.data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.nama + ' (' + item.no_reg + ')'
                        };
                    }),
                    pagination: {
                        more: params.page < data.last_page
                    }
                };
            },
            cache: true
        }
    });

    $('#petani_id').select2({
        dropdownParent: $('#modalLahan'),
        placeholder: 'Pilih Petani',
        allowClear: true,
        ajax: {
            url: "{{ route('api.select2.petani') }}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term,
                    page: params.page || 1
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                
                return {
                    results: data.data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.nama
                        };
                    }),
                    pagination: {
                        more: params.page < data.last_page
                    }
                };
            },
            cache: true
        }
    });

    $('#blok_id').select2({
        dropdownParent: $('#modalLahan'),
        placeholder: 'Pilih Blok',
        allowClear: true,
        ajax: {
            url: "{{ route('api.select2.blok') }}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term,
                    page: params.page || 1
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                
                return {
                    results: data.data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.kode_blok
                        };
                    }),
                    pagination: {
                        more: params.page < data.last_page
                    }
                };
            },
            cache: true
        }
    });

    var table = $('#tableLahan').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('lahan.datatable') }}",
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
                data: 'peserta_nama',
                name: 'peserta.nama'
            },
            {
                data: 'petani_nama',
                name: 'petani.nama'
            },
            {
                data: 'no_shm',
                name: 'no_shm'
            },
            {
                data: 'tanggal_shm',
                name: 'tanggal_shm'
            },
            {
                data: 'alamat_jaminan',
                name: 'alamat_jaminan',
                render: function(data) {
                    return data.length > 50 ? data.substring(0, 50) + '...' : data;
                }
            },
            {
                data: 'luas_jumlah',
                name: 'luas_jumlah',
                render: function(data) {
                    return new Intl.NumberFormat('id-ID').format(data);
                }
            },
            {
                data: 'blok_kode',
                name: 'blok.kode_blok'
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
        order: [[4, 'desc']]
    });

    $('#btnTambahLahan').on('click', function() {
        $('#modalLahanLabel').text('Tambah Lahan');
        $('#formLahan')[0].reset();
        $('#lahanId').val('');
        
        $('#peserta_id').val(null).trigger('change');
        $('#petani_id').val(null).trigger('change');
        $('#blok_id').val(null).trigger('change');
        
        $('#modalLahan').modal('show');
    });

    $('#tableLahan').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: "{{ route('lahan.show', ':id') }}".replace(':id', id),
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#modalLahanLabel').text('Edit Lahan');
                    $('#lahanId').val(response.data.id);
                    $('#no_shm').val(response.data.no_shm);
                    $('#tanggal_shm').val(response.data.tanggal_shm);
                    $('#alamat_jaminan').val(response.data.alamat_jaminan);
                    $('#luas_jumlah').val(response.data.luas_jumlah);
                    
                    if (response.data.peserta.nama) {
                        var pesertaOption = new Option(response.data.peserta.nama, response.data.peserta.nama, true, true);
                        $('#peserta_id').append(pesertaOption).trigger('change');
                    }
                    
                    if (response.data.petani.nama) {
                        var petaniOption = new Option(response.data.petani.nama, response.data.petani.nama, true, true);
                        $('#petani_id').append(petaniOption).trigger('change');
                    }
                    
                    if (response.data.blok.kode_blok) {
                        var blokOption = new Option(response.data.blok.kode_blok, response.data.blok.kode_blok, true, true);
                        $('#blok_id').append(blokOption).trigger('change');
                    }
                    
                    $('#modalLahan').modal('show');
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data lahan'
                });
            }
        });
    });

    $('#formLahan').on('submit', function(e) {
        e.preventDefault();
        
        var lahanId = $('#lahanId').val();
        var url = lahanId ? "{{ route('lahan.update', ':id') }}".replace(':id', lahanId) : "{{ route('lahan.store') }}";
        var method = lahanId ? 'PUT' : 'POST';
        
        var formData = {
            peserta_id: $('#peserta_id').val(),
            petani_id: $('#petani_id').val(),
            no_shm: $('#no_shm').val(),
            tanggal_shm: $('#tanggal_shm').val(),
            alamat_jaminan: $('#alamat_jaminan').val(),
            luas_jumlah: $('#luas_jumlah').val(),
            blok_id: $('#blok_id').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#modalLahan').modal('hide');
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

    $('#tableLahan').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus data lahan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('lahan.destroy', ':id') }}".replace(':id', id),
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
                        var message = xhr.responseJSON?.message || 'Gagal menghapus data lahan';
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
