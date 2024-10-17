@extends('layouts.app')

@section('header')
    <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-200">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-0" style="font-size: 16px; margin-bottom: 0;">Models</h4>
                            <div class="search-point">
                                <input type="text" id="modelSearch" class="form-control" placeholder="Search Models" style="display:inline-block; width:auto; margin-right: 10px; height: 30px;">
                                <button class="btn btn-primary" id="addNewModel" style="height: 30px;"><i class='fas fa-plus' style="margin-right: 5px"></i>Add New Model</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="spareparts-table" class="table table-hover table-bordered">
                            <thead class="table-header">
                                <tr>
                                    <th>No</th>
                                    <th>Model Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modelModal" tabindex="-1" aria-labelledby="modelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelModalLabel">Add New Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modelForm">
                    @csrf
                    <div class="mb-3">
                        <label for="model_name" class="form-label">Model Name</label>
                        <input type="text" class="form-control" id="model_name" name="model_name" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="model_description" class="form-label">Description</label>
                        <input class="form-control" id="model_description" name="model_description" required autocomplete="off"></input>
                    </div>
                    <input type="hidden" name="is_active" value="1">
                    <input type="hidden" id="model_id" name="model_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitModel">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editModelModal" tabindex="-1" aria-labelledby="editModelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModelModalLabel">Edit Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editModelForm">
                    @csrf
                    <div class="mb-3">
                        <p id="last_updated" class="form-text text-muted"></p>
                    </div>
                    <div class="mb-3">
                        <label for="edit_model_name" class="form-label">Model Name</label>
                        <input type="text" class="form-control" id="edit_model_name" name="model_name" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="edit_model_description" class="form-label">Description</label>
                        <input class="form-control" id="edit_model_description" name="model_description" required autocomplete="off"></input>
                    </div>
                    <input type="hidden" id="edit_model_id" name="model_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="updateModel">Update</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('style')
<style>

#spareparts-table td, #spareparts-table th {
    text-align: center;
    vertical-align: middle;
}
.page-title-box {
    padding: 5px 15px; 
}

.page-title-box h4 {
    margin: 0; 
    line-height: 1.2; 
}

.search-point input {
    height: 30px; 
    padding: 5px; 
}

.search-point button {
    height: 30px;
    padding: 5px 10px;
}
.table-header th {
        color: #000; 
        background-color: #d3d3d3;
}
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#spareparts-table')) {
        $('#spareparts-table').DataTable().destroy();
    }

    var table = $('#spareparts-table').DataTable({
        processing: true,
        serverSide: true,
        "dom": 'lrtip',
        ajax: '{!! route('model.part') !!}', 
        columns: [
            { data: null, name: 'id', render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1; 
            }},
            { data: 'model_name', name: 'model_name' },
            { data: 'model_description', name: 'model_description' },
            { data: 'is_active', name: 'is_active', render: function(data, type, row) {
                let status = data === 1 ? 'Active' : 'Inactive';
                let bgColor = data === 1 ? 'background-color: #d4edda;' : 'background-color: #f8f9fa;';
                return `<span style="${bgColor} display: inline-block; width: 100%; text-align: center; padding: 5px;">${status}</span>`;
            }},
            { data: 'action', name: 'action', orderable: false, searchable: false, render: function(data, type, row) {
                let buttons = row.is_active == 1 ? `
                    <button class="btn btn-primary edit-model" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger delete-model" data-id="${row.id}"><i class="fas fa-trash"></i></button>
                ` : `
                    <button class="btn btn-primary" disabled><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" disabled><i class="fas fa-trash"></i></button>
                `;
                return `<div style="text-align: center;">${buttons}</div>`;
            }}
        ],
        paging: true,
        ordering: true,
        searching: true,
        info: false,
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50],
        lengthChange: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/English.json'
        }
    });

    $('#modelSearch').on('keyup', function() {
        table.search(this.value).draw();  // Trigger search with DataTables
    });


    $('#addNewModel').on('click', function() {
        $('#modelModal').modal('show'); 
    });

    // Submit new model
    $('#submitModel').on('click', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route('model.add') }}',
            data: $('#modelForm').serialize(),
            success: function(response) {
                $('#modelModal').modal('hide');
                table.ajax.reload(); 
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.success,
                    confirmButtonText: 'OK'
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Tolong input required data',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Edit model
    $(document).on('click', '.edit-model', function() {
        var modelId = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/model/edit/' + modelId, 
            success: function(data) {
                $('#edit_model_name').val(data.model_name);
                $('#edit_model_description').val(data.model_description);
                $('#edit_model_id').val(modelId);
                $('#last_updated').text(data.updated_at ? 'Last updated: ' + data.updated_at : 'Not updated yet');
                $('#editModelModal').modal('show');
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Tolong input required data',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Update model
    $('#updateModel').on('click', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route('model.update') }}',
            data: $('#editModelForm').serialize(),
            success: function(response) {
                $('#editModelModal').modal('hide');
                table.ajax.reload(); 
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.success,
                    confirmButtonText: 'OK'
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Tolong input required data',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Delete model
    $(document).on('click', '.delete-model', function(e) {
        e.preventDefault();
        var modelId = $(this).data('id');
        var url = '{{ route("model.delete", ":id") }}';
        url = url.replace(':id', modelId);
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data akan dinonaktifkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, nonaktifkan data!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: { _token: '{{ csrf_token() }}', is_active: 0 },
                    success: function(response) {
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.success,
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Tolong input required data',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });
});
</script>
@endsection
