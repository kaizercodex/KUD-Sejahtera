@extends('app')

@section('title', 'Data Simpanan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Simpanan</li>
                    </ol>
                </nav>
                <h3>Data Simpanan</h3>
                <p class="text-subtitle text-muted">Kelola data simpanan anggota</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Simpanan</h5>
                    <button type="button" class="btn btn-primary" id="btnTambahSimpanan">
                        <i class="bi bi-plus-circle"></i> Tambah Simpanan
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableSimpanan" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peserta</th>
                                <th>Jenis</th>
                                <th>Nominal</th>
                                <th>Tanggal</th>
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
@include('datamaster.simpanan.modal-form')
<script>
$(document).ready(function() {
    $('#peserta_id').select2({
        theme: 'bootstrap-5',
        dropdownParent: $('#modalSimpanan'),
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
            processResults: function(data) {
                return {
                    results: data.data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.nama + ' (' + item.no_reg + ')'
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

    var table = $('#tableSimpanan').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('simpanan.datatable') }}",
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
                data: 'jenis',
                name: 'jenis'
            },
            {
                data: 'nominal_formatted',
                name: 'nominal',
                render: function(data) {
                    return data;
                }
            },
            {
                data: 'tanggal',
                name: 'tanggal',
                render: function(data) {
                    return new Date(data).toLocaleDateString('id-ID');
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
        order: [[4, 'desc']]
    });

    $('#nominal').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#btnTambahSimpanan').on('click', function() {
        $('#modalSimpananLabel').text('Tambah Simpanan');
        $('#formSimpanan')[0].reset();
        $('#simpananId').val('');
        $('#peserta_id').val(null).trigger('change');
        $('#modalSimpanan').modal('show');
    });

    $('#tableSimpanan').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: "{{ route('simpanan.show', ':id') }}".replace(':id', id),
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#modalSimpananLabel').text('Edit Simpanan');
                    $('#simpananId').val(response.data.id);
                    $('#jenis').val(response.data.jenis);
                    $('#nominal').val(response.data.nominal);
                    $('#tanggal').val(response.data.tanggal);
                    
                    if (response.data.peserta_id && response.data.peserta) {
                        var option = new Option(response.data.peserta.nama + ' (' + response.data.peserta.no_reg + ')', response.data.peserta_id, true, true);
                        $('#peserta_id').append(option).trigger('change');
                    } else {
                        $('#peserta_id').val(null).trigger('change');
                    }
                    
                    $('#modalSimpanan').modal('show');
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data simpanan'
                });
            }
        });
    });

    $('#formSimpanan').on('submit', function(e) {
        e.preventDefault();
        
        var simpananId = $('#simpananId').val();
        var url = simpananId ? "{{ route('simpanan.update', ':id') }}".replace(':id', simpananId) : "{{ route('simpanan.store') }}";
        var method = simpananId ? 'PUT' : 'POST';
        
        var formData = {
            peserta_id: $('#peserta_id').val(),
            jenis: $('#jenis').val(),
            nominal: $('#nominal').val(),
            tanggal: $('#tanggal').val(),
            _token: '{{ csrf_token() }}'
        };
        
        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#modalSimpanan').modal('hide');
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

    $('#tableSimpanan').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus simpanan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('simpanan.destroy', ':id') }}".replace(':id', id),
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
                        var message = xhr.responseJSON?.message || 'Gagal menghapus simpanan';
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
