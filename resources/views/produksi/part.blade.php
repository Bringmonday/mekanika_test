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
                            <h4 class="mb-0" style="font-size: 16px; margin-bottom: 0;">Parts</h4>
                            <div class="search-point">
                                <input type="text" id="modelSearch" class="form-control" placeholder="Search Models" style="display:inline-block; width:auto; margin-right: 10px; height: 30px;">
                                <button class="btn btn-primary" id="addNewModel" style="height: 30px;"><i class='fas fa-plus' style="margin-right: 5px"></i>Add New Part</button>
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
                                    <th>Part Name</th>
                                    <th>Part Number</th>
                                    <th>Part Code</th>
                                    <th>Quantity Cart</th>
                                    <th>Image</th>
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
                <h5 class="modal-title" id="modelModalLabel">Add New Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modelForm"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="part_name" class="form-label">Part Name</label>
                        <input type="text" class="form-control" id="part_name" name="part_name" required autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="edit_model_name" class="form-label">Model Name</label>
                                <select class="form-select" id="edit_model_name" name="model_name" required>
                                    <option value="" disabled selected>Select Model Name</option>
                                    @foreach($modelNames as $modelName)
                                        <option value="{{ $modelName }}">{{ $modelName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="part_number" class="form-label">Part Number</label>
                                <input type="text" class="form-control" id="part_number" name="part_number" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="part_code" class="form-label">Part Code</label>
                                <input type="text" class="form-control" id="part_code" name="part_code" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="qty_in_cart" class="form-label">Qty Cart</label>
                                <input type="number" class="form-control" id="qty_in_cart" name="qty_in_cart" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="image_illus_fix" class="form-label">Illustration Fix</label>
                                <input type="file" class="form-control" id="image_illus_fix" name="image_illus_fix" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="image_illus_move" class="form-label">Illustration Move</label>
                                <input type="file" class="form-control" id="image_illus_move" name="image_illus_move" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="image_illus_core" class="form-label">Illustration Core</label>
                                <input type="file" class="form-control" id="image_illus_core" name="image_illus_core" required>
                            </div>
                        </div>
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
                        <label for="edit_part_name" class="form-label">Part Name</label>
                        <input type="text" class="form-control" id="edit_part_name" name="part_name" required autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="edit_model_name" class="form-label">Model Name</label>
                                <select class="form-select" id="edit_model_name" name="model_name" required>
                                    <option value="" disabled selected>Select Model Name</option>
                                    @foreach($modelNames as $modelName)
                                        <option value="{{ $modelName }}">{{ $modelName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_part_number" class="form-label">Part Number</label>
                                <input type="text" class="form-control" id="edit_part_number" name="part_number" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_part_code" class="form-label">Part Code</label>
                                <input type="text" class="form-control" id="edit_part_code" name="part_code" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="edit_qty_in_cart" class="form-label">Qty Cart</label>
                                <input type="number" class="form-control" id="edit_qty_in_cart" name="qty_in_cart" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="edit_model_id" name="model_id">
                    <p id="last_updated" class="form-text text-muted"></p>
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
        ajax: '{!! route('part.input') !!}', 
        columns: [
            { 
                data: null, 
                name: 'id', 
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; 
                }
            },
            { data: 'model_name', name: 'model_name' },
            { data: 'part_name', name: 'part_name' },  // Updated to match your database
            { data: 'part_number', name: 'part_number' }, // Updated to match your database
            { data: 'part_code', name: 'part_code' }, // Updated to match your database
            { data: 'qty_in_cart', name: 'qty_in_cart' }, 
            { 
                data: 'image_illus_fix', 
                name: 'image_illus_fix',
                render: function(data) {
                    return `<img src="{{ asset('/B/assets/images/companies/img-8.png') }}/${data}" alt="Image" style="width: 50px; height: auto;">`; 
                }
            },
            { 
                data: 'is_active', 
                name: 'is_active', 
                render: function(data) {
                    let status = data === 1 ? 'Active' : 'Inactive';
                    let bgColor = data === 1 ? 'background-color: #d4edda;' : 'background-color: #f8f9fa;';
                    return `<span style="${bgColor} display: inline-block; width: 100%; text-align: center; padding: 5px;">${status}</span>`;
                }
            },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false, 
                render: function(data, type, row) {
                    let buttons = row.is_active == 1 ? `
                        <button class="btn btn-primary edit-model" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger delete-model" data-id="${row.id}"><i class="fas fa-trash"></i></button>
                    ` : `
                        <button class="btn btn-primary" disabled><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" disabled><i class="fas fa-trash"></i></button>
                    `;
                    return `<div style="text-align: center;">${buttons}</div>`;
                }
            }
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
        var formData = new FormData($('#modelForm')[0]); // Create FormData object
        $.ajax({
            type: 'POST',
            url: '{{ route('part.add') }}',
            data: formData,
            processData: false, // Prevent jQuery from automatically transforming the data into a query string
            contentType: false, // Prevent jQuery from overriding the content type
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
                    text: 'Tolong input required data: ',
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
            url: '/part/edit/' + modelId, 
            success: function(data) {
                $('#edit_model_name').val(data.model_name);
                $('#edit_part_name').val(data.part_name);
                $('#edit_part_code').val(data.part_code);
                $('#edit_part_number').val(data.part_number);
                $('#edit_qty_in_cart').val(data.qty_in_cart);
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
        var formData = new FormData($('#editModelForm')[0]); // Create FormData object
        $.ajax({
            type: 'POST',
            url: '{{ route('part.update') }}',
            data: formData,
            processData: false,
            contentType: false,
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
        var url = '{{ route("part.delete", ":id") }}';
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
