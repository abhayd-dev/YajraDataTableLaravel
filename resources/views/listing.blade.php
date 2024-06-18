@include('layouts.header')
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-sm-3 mb-2">
                <input type="text" name="" id="myInput" class="form-control"
                    placeholder="Search Here By Name...." />
            </div>
            <div class="col-sm-3 mb-2">
                <input type="text" name="" id="myInput1" class="form-control"
                    placeholder="Search Here By Email...." />
            </div>
            <div class="col-sm-3 mb-2">
                <input type="text" name="" id="myInput2" class="form-control"
                    placeholder="Search Here By Age...." />
            </div>
            <div class="col-sm-3 mb-2">
                <input type="text" name="" id="myInput3" class="form-control"
                    placeholder="Search Here By Salary...." />
            </div>
        </div>
    </div>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-sm-12 p-3">
                            <div class="row">
                            <div class="col-sm-3 mt-2">
                                <button class="btn btn-danger" id="bulk-delete-btn">Selected Records Delete</button>
                            </div>
                            <div class="col-sm-2 mt-2 center">
                                <button id="export-btn" class="btn btn-success">Export to Excel</button>
                            </div>
                            <div class="col-sm-2 mt-2 text-right"> <a href="{{ route('emp.store') }}"
                                class="btn btn-primary text-white" data-toggle="modal"
                                data-target="#addEmployeeModal">Add New Employee</a>
                        </div>
                  
                        
                            <div class="col-sm-5 salary">
                                <div class="row">

                              
                               <div class="col-sm-6 text-center">
                                <h4>Total Salary: <span id="totalSalary"></span></h4>
                               </div>
                               <div class="col-sm-6 text-right">
                                <button id="pay-now-btn" class="btn btn-dark  text-center">See Payment Details And Pay</button>
                               </div>
                            </div>
                          
                            </div>
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
    @include('layouts.modal')
    <script src="{{ asset('js/scripts.js') }}"></script>

    @include('layouts.script')
    @include('layouts.footer')

 