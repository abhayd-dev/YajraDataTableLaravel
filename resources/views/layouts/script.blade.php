<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#employeeTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('emp.listing') }}",
            columns: [{
                    data: null,
                    defaultContent: '<input type="checkbox" class="select-checkbox" />',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'age',
                    name: 'age'
                },
                {
                    data: 'salary',
                    name: 'salary'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
            
        });

        //export 
        $('#export-btn').on('click', function() {
        var tableData = [];
        table.rows({ search: 'applied' }).every(function() {
            var row = this.data();
            tableData.push([row.id, row.name, row.email, row.age, row.salary]);
        });

        var ws = XLSX.utils.aoa_to_sheet([
            ['ID', 'Name', 'Email', 'Age', 'Salary'], 
            ...tableData 
        ]);

        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Employees');

        XLSX.writeFile(wb, 'EmployeeData.xlsx');
    });


      
        //Manual Search by name
        $('#myInput').on('keyup', function() {
            table.column(2).search(this.value).draw();
        });
        //manual Search by email
        $('#myInput1').on('keyup', function() {
            table.column(3).search(this.value).draw();
        });
        //manual Search by age
        $('#myInput2').on('keyup', function() {
            table.column(4).search(this.value).draw();
        });
        //manual Search by salary
        $('#myInput3').on('keyup', function() {
            table.column(5).search(this.value).draw();
        });


        //salary
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

        //checkbox handle
        $('#selectAll').on('click', function() {
            var checkboxes = $('#employeeTable tbody tr td input[type="checkbox"]');
            checkboxes.prop('checked', $(this).prop('checked'));
            calculateTotalSalary();
        });

        $('#employeeTable tbody').on('change', 'input[type="checkbox"]', function() {
            calculateTotalSalary();
        });


        //payment details
        $('#pay-now-btn').on('click', function() {

            var selectedEmployees = [];
            var totalSalary = 0;
            $('#employeeTable tbody tr td input[type="checkbox"]:checked').each(function() {
                var row = $(this).closest('tr');
                var id = row.find('td:eq(1)').text();
                var salary = parseFloat(row.find('td:eq(5)').text());
                totalSalary += salary;
                selectedEmployees.push({
                    id: id,
                    name: row.find('td:eq(2)').text(),
                    salary: salary,
                });
            });

            if (selectedEmployees.length === 0) {
                toastr.error('No employees selected');
                return;
            }

            $('#pay-now-tbody').empty();
            $.each(selectedEmployees, function(index, employee) {
                $('#pay-now-tbody').append(`
        <tr>
            <td>${employee.id}</td>
            <td>${employee.name}</td>
            <td>${employee.salary.toLocaleString()}</td>
        </tr>
    `);
            });

            $('#payNowModal').find('h4').text(`Total Salary:  ${totalSalary.toLocaleString()}`);

            $('#payNowModal').modal('show');
        });


        $('#pay-now-confirm-btn').on('click', function() {
            toastr.success('Payment successful!');
            $('#payNowModal').modal('hide');
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
                        data: {
                            ids: selectedRows
                        },
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




