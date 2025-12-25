@extends('app')

@section('title', 'Data Master Peserta Plasma')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Master Peserta Plasma</li>
                    </ol>
                </nav>
                <h3>Data Master Peserta Plasma</h3>
                <p class="text-subtitle text-muted">Kelola data peserta plasma</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Peserta Plasma</h5>
                    <button type="button" class="btn btn-primary" id="btnTambahPesertaPlasma">
                        <i class="bi bi-plus-circle"></i> Tambah Peserta Plasma
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablePesertaPlasma" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Reg</th>
                                <th>Nama</th>
                                <th>NIK/KTP</th>
                                <th>No KK</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Foto</th>
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
@include('datamaster.peserta_plasma.modal-form')
<script>
$(document).ready(function() {
    var table = $('#tablePesertaPlasma').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('peserta-plasma.datatable') }}",
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
                data: 'no_reg',
                name: 'no_reg'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'nik_ktp',
                name: 'nik_ktp'
            },
            {
                data: 'no_kk',
                name: 'no_kk'
            },
            {
                data: 'alamat',
                name: 'alamat',
                render: function(data) {
                    return data.length > 50 ? data.substring(0, 50) + '...' : data;
                }
            },
            {
                data: 'no_hp',
                name: 'no_hp',
                render: function(data) {
                    return data || '-';
                }
            },
            {
                data: 'photo_url',
                name: 'photo',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    if (data) {
                        return `<img src="${data}" alt="Foto" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; cursor: pointer;" onclick="window.open('${data}', '_blank')">`;
                    }
                    return '<span class="badge bg-secondary">Tidak ada foto</span>';
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
        order: [[1, 'asc']]
    });

    $('#photo').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 1048576) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ukuran file maksimal 1MB'
                });
                $(this).val('');
                $('#photoPreviewContainer').hide();
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                $('#photoPreview').attr('src', e.target.result);
                $('#photoPreviewContainer').show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#photoPreviewContainer').hide();
        }
    });

    $('#btnTambahPesertaPlasma').on('click', function() {
        $('#modalPesertaPlasmaLabel').text('Tambah Peserta Plasma');
        $('#formPesertaPlasma')[0].reset();
        $('#pesertaPlasmaId').val('');
        $('#photoPreviewContainer').hide();
        $('#modalPesertaPlasma').modal('show');
    });

    $('#tablePesertaPlasma').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: "{{ route('peserta-plasma.show', ':id') }}".replace(':id', id),
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#modalPesertaPlasmaLabel').text('Edit Peserta Plasma');
                    $('#pesertaPlasmaId').val(response.data.id);
                    $('#no_reg').val(response.data.no_reg);
                    $('#nama').val(response.data.nama);
                    $('#nik_ktp').val(response.data.nik_ktp);
                    $('#no_kk').val(response.data.no_kk);
                    $('#alamat').val(response.data.alamat);
                    $('#no_hp').val(response.data.no_hp);
                    $('#kelompok_id').val(response.data.kelompok_id);
                    
                    if (response.data.photo_url) {
                        $('#photoPreview').attr('src', response.data.photo_url);
                        $('#photoPreviewContainer').show();
                    } else {
                        $('#photoPreviewContainer').hide();
                    }
                    
                    $('#modalPesertaPlasma').modal('show');
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data peserta plasma'
                });
            }
        });
    });

    $('#formPesertaPlasma').on('submit', function(e) {
        e.preventDefault();
        
        var pesertaPlasmaId = $('#pesertaPlasmaId').val();
        var url = pesertaPlasmaId ? "{{ route('peserta-plasma.update', ':id') }}".replace(':id', pesertaPlasmaId) : "{{ route('peserta-plasma.store') }}";
        
        var formData = new FormData(this);
        formData.append('_token', '{{ csrf_token() }}');
        
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#modalPesertaPlasma').modal('hide');
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

    $('#tablePesertaPlasma').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus peserta plasma ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('peserta-plasma.destroy', ':id') }}".replace(':id', id),
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
                        var message = xhr.responseJSON?.message || 'Gagal menghapus peserta plasma';
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
