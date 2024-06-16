<!doctype html>
<html lang="en">

<head>
    @include('sweetalert::alert')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employee Listing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12  emp text-center">
                    <h1 class="">Employee Data</h1>
                </div>
            </div>
        </div>
        </div>
    </header>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <div class="row">
                       
                    </div>
                    <div class="row">
                        <div class="col-sm-12 p-3 d-flex ">
                            <div class="col-sm-4 text-left">
                                <button class="btn btn-danger" id="bulk-delete-btn">Selected Records Delete</button>
                            </div>
                            <div class="col-sm-4 text-center salary">
                                <h4>Total Salary: <span id="totalSalary">0</span></h4>
                            </div>

                            <div class="col-sm-4  text-right"> <a href="{{ route('emp.store') }}"
                                    class="btn btn-warning text-white" data-toggle="modal"
                                    data-target="#addEmployeeModal">Add New Employee</a>
                            </div>
                        </div>

                    </div>

                    <table id="employeeTable" class="table table-sm table-hover  yajra-datatable">
                        <thead class="thead3">
                            <tr>
                                <th><input type="checkbox" id="selectAll" /></th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Employee Email</th>
                                <th>Employee Age</th>
                                <th>Employee Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog"
                    aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="updateEmployeeForm">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editEmployeeModal">Edit Employee</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="edit_name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_age">Age:</label>
                                        <input type="number" class="form-control" id="age" name="age">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_salary">Salary:</label>
                                        <input type="text" class="form-control" id="salary" name="salary">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Employee</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addEmployeeForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEmployeeModal">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age" name="age">
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary:</label>
                            <input type="text" class="form-control" id="salary" name="salary">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-bold">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger btn-ok">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#employeeTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('emp.listing') }}",
                columns: [
                    {
                        data: null,
                        defaultContent: '<input type="checkbox" class="select-checkbox" />',
                        orderable: false,
                        searchable: false
                    },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'age', name: 'age' },
                    { data: 'salary', name: 'salary' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
    
            // Calculate total salary
            function calculateTotalSalary() {
                var totalSalary = 0;
                $('#employeeTable tbody tr').each(function() {
                    var row = $(this);
                    if (row.find('input[type="checkbox"]').is(':checked')) {
                        var salary = parseFloat(row.find('td:eq(5)').text());
                        totalSalary += salary;
                    }
                });
                $('#totalSalary').text(totalSalary.toFixed(2));
            }
    
            // Handle checkbox clicks
            $('#selectAll').on('click', function() {
                var checkboxes = $('#employeeTable tbody tr td input[type="checkbox"]');
                checkboxes.prop('checked', $(this).prop('checked'));
                calculateTotalSalary();
            });
    
            $('#employeeTable tbody').on('change', 'input[type="checkbox"]', function() {
                calculateTotalSalary();
            });
    
            // Edit
            $('body').on('click', '.edit', function() {
                var id = $(this).data("id");
                $.get("{{ route('emp.edit', '') }}/" + id, function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#age').val(data.age);
                    $('#salary').val(data.salary);
                    $('#editEmployeeModal').modal('show');
                });
            });
    
            // Update
            $('#updateEmployeeForm').submit(function(e) {
                e.preventDefault();
                var id = $('#id').val();
                var formData = new FormData(this);
    
                $.ajax({
                    type: "POST",
                    url: "{{ route('emp.update') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#editEmployeeModal').modal('hide');
                        table.ajax.reload();
                        calculateTotalSalary();
                        toastr.success(data.success, '');
                    },
                    error: function(data) {
                        toastr.error(data.error);
                    }
                });
            });
    
            // Delete
            $('body').on('click', '.delete', function() {
                var id = $(this).data("id");
                $('#confirmDeleteModal').modal('show');
                $('#confirmDeleteModal').on('click', '.btn-ok', function() {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('emp.delete', '') }}/" + id,
                        success: function(data) {
                            table.ajax.reload();
                            calculateTotalSalary();
                            toastr.success(data.success);
                            $('#confirmDeleteModal').modal('hide');
                        },
                        error: function(data) {
                            toastr.error(data.error);
                        }
                    });
                });
            });
    
            // Add
            $('#addEmployeeForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
    
                $.ajax({
                    type: "POST",
                    url: "{{ route('emp.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#addEmployeeModal').modal('hide');
                        table.ajax.reload();
                        calculateTotalSalary();
                        toastr.success(data.success);
                    },
                    error: function(data) {
                        toastr.error(data.error);
                    }
                });
            });
    
            // Bulk Delete
            $('#bulk-delete-btn').on('click', function() {
                var selectedRows = [];
                $('#employeeTable tbody tr td input[type="checkbox"]:checked').each(function() {
                    var row = $(this).closest('tr');
                    var id = row.find('td:eq(1)').text();
                    selectedRows.push(id);
                });
    
                if (selectedRows.length > 0) {
                    $('#confirmDeleteModal').modal('show');
                    $('#confirmDeleteModal').on('click', '.btn-ok', function() {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('emp.bulk-delete') }}",
                            data: { ids: selectedRows },
                            success: function(data) {
                                table.ajax.reload();
                                calculateTotalSalary();
                                toastr.success(data.success);
                                $('#confirmDeleteModal').modal('hide');
                            },
                            error: function(data) {
                                toastr.error(data.error);
                            }
                        });
                    });
                } else {
                    toastr.error('No rows selected');
                }
            });
        });
    </script>
    

</body>

</html>
