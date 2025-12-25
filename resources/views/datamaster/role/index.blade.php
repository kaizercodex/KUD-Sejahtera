@extends('app')

@section('title', 'Data Master Role')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Master Role</li>
                    </ol>
                </nav>
                <h3>Data Master Role</h3>
                <p class="text-subtitle text-muted">Kelola data role pengguna sistem</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Role</h5>
                    <button type="button" class="btn btn-primary" id="btnTambahRole">
                        <i class="bi bi-plus-circle"></i> Tambah Role
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableRole" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th>Guard</th>
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
@include('datamaster.role.modal-form')
<script>
var allPermissions = [];

function loadPermissions() {
    $.ajax({
        url: "{{ route('role.permissions') }}",
        type: 'GET',
        success: function(response) {
            if (response.success) {
                allPermissions = response.data;
                renderPermissions();
            }
        },
        error: function(xhr) {
            $('#permissionsContainer').html('<div class="col-12 text-danger">Gagal memuat permissions</div>');
        }
    });
}

function renderPermissions(selectedPermissions = []) {
    var html = '';
    var groupedPermissions = {};
    
    allPermissions.forEach(function(permission) {
        var parts = permission.name.split('.');
        var module = parts[0];
        
        if (!groupedPermissions[module]) {
            groupedPermissions[module] = [];
        }
        groupedPermissions[module].push(permission);
    });
    
    Object.keys(groupedPermissions).forEach(function(module) {
        html += '<div class="col-md-6 mb-3">';
        html += '<div class="card bg-light">';
        html += '<div class="card-body">';
        html += '<div class="d-flex justify-content-between align-items-center mb-2">';
        html += '<h6 class="text-capitalize mb-0">' + module + '</h6>';
        html += '<button type="button" class="btn btn-sm btn-outline-primary select-module-btn" data-module="' + module + '">';
        html += '<i class="bi bi-check-all"></i> Ceklis Semua';
        html += '</button>';
        html += '</div>';
        
        groupedPermissions[module].forEach(function(permission) {
            var checked = selectedPermissions.includes(permission.id) ? 'checked' : '';
            html += '<div class="form-check">';
            html += '<input class="form-check-input permission-checkbox module-' + module + '" type="checkbox" name="permissions[]" value="' + permission.id + '" id="perm_' + permission.id + '" data-module="' + module + '" ' + checked + '>';
            html += '<label class="form-check-label" for="perm_' + permission.id + '">';
            html += permission.name;
            html += '</label>';
            html += '</div>';
        });
        
        html += '</div>';
        html += '</div>';
        html += '</div>';
    });
    
    $('#permissionsContainer').html(html);
    updateModuleButtons();
}

function updateModuleButtons() {
    $('.select-module-btn').each(function() {
        var module = $(this).data('module');
        var totalCheckboxes = $('.module-' + module).length;
        var checkedCheckboxes = $('.module-' + module + ':checked').length;
        
        if (checkedCheckboxes === totalCheckboxes && totalCheckboxes > 0) {
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');
            $(this).html('<i class="bi bi-x-circle"></i> Batal Semua');
        } else {
            $(this).removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).html('<i class="bi bi-check-all"></i> Ceklis Semua');
        }
    });
}

$(document).ready(function() {
    loadPermissions();
    
    var table = $('#tableRole').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('role.datatable') }}",
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
                data: 'name',
                name: 'name',
                render: function(data) {
                    return data.split(' ').map(word => 
                        word.charAt(0).toUpperCase() + word.slice(1)
                    ).join(' ');
                }
            },
            {
                data: 'guard_name',
                name: 'guard_name'
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

    $('#btnTambahRole').on('click', function() {
        $('#modalRoleLabel').text('Tambah Role');
        $('#formRole')[0].reset();
        $('#roleId').val('');
        $('#selectAllPermissions').prop('checked', false);
        renderPermissions([]);
        $('#modalRole').modal('show');
    });

    $(document).on('change', '#selectAllPermissions', function() {
        $('.permission-checkbox').prop('checked', $(this).is(':checked'));
        updateModuleButtons();
    });

    $(document).on('change', '.permission-checkbox', function() {
        var allChecked = $('.permission-checkbox').length === $('.permission-checkbox:checked').length;
        $('#selectAllPermissions').prop('checked', allChecked);
        updateModuleButtons();
    });

    $(document).on('click', '.select-module-btn', function() {
        var module = $(this).data('module');
        var totalCheckboxes = $('.module-' + module).length;
        var checkedCheckboxes = $('.module-' + module + ':checked').length;
        
        if (checkedCheckboxes === totalCheckboxes) {
            $('.module-' + module).prop('checked', false);
        } else {
            $('.module-' + module).prop('checked', true);
        }
        
        var allChecked = $('.permission-checkbox').length === $('.permission-checkbox:checked').length;
        $('#selectAllPermissions').prop('checked', allChecked);
        
        updateModuleButtons();
    });

    $('#tableRole').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: "{{ route('role.show', ':id') }}".replace(':id', id),
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#modalRoleLabel').text('Edit Role');
                    $('#roleId').val(response.data.id);
                    $('#name').val(response.data.name);
                    renderPermissions(response.data.permissions);
                    
                    var allChecked = $('.permission-checkbox').length === $('.permission-checkbox:checked').length;
                    $('#selectAllPermissions').prop('checked', allChecked);
                    
                    $('#modalRole').modal('show');
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data role'
                });
            }
        });
    });

    $('#formRole').on('submit', function(e) {
        e.preventDefault();
        
        var roleId = $('#roleId').val();
        var url = roleId ? "{{ route('role.update', ':id') }}".replace(':id', roleId) : "{{ route('role.store') }}";
        var method = roleId ? 'PUT' : 'POST';
        
        var selectedPermissions = [];
        $('.permission-checkbox:checked').each(function() {
            selectedPermissions.push($(this).val());
        });
        
        var formData = {
            name: $('#name').val(),
            permissions: selectedPermissions,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#modalRole').modal('hide');
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

    $('#tableRole').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus role ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('role.destroy', ':id') }}".replace(':id', id),
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
                        var message = xhr.responseJSON?.message || 'Gagal menghapus role';
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
