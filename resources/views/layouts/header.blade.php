<!doctype html>
<html lang="en">

<head>
    @include('sweetalert::alert')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employee Listing</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>

    
    
    

</head>
<body>
  <div class="container-fluid b1 mb-3">
    <div class="row">
      <div class="col-sm-6 ">

        <nav class="navbar navbar-expand-lg navbar-light bg-white fs-3">
          <a class="navbar-brand px-3 mx-3 " href="task6.php"><h3 class="logo">EMPLOYEE.COM</h3></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse mb-2" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto px-3 text-center">
              <li class="nav-item active px-2">
                <a class="nav-link text-primary" href="#">Home</a>
              </li>
              <li class="nav-item active px-2">
                <a class="nav-link text-primary" href="#">Contact</a>
              </li>

              <li class="nav-item active px-2">
                <a class="nav-link text-primary" href="#">Aboutus</a>
              </li>
            </ul>
          </div>
        </nav>

      </div>

      <div class="col-sm-6 my-auto text-right">
        <a class="btn btn-light text-primary font-weight-bold " style="border:1px solid rgb(239, 16, 150);border-radius:15px;width:120px;" href="task5.php">LOGIN</a>
        <a class="btn btn-light text-primary font-weight-bold" style="border:1px solid rgb(239, 40, 199);border-radius:15px;width:120px;" href="task4.php">REGISTER</a>
      </div>
      {{-- <div class="col-sm-3 my-auto">
        <a href="task7.php" class="ml-4 mr-2">JOB SEEKERS</a>
        <a>|</a>
        <a href="" class="ml-2">RECRUITERS</a>
      </div> --}}
    </div>
    <hr/>
  </div>


    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12  emp text-center">
                    <h1 class="">Employee Dashboard</h1>
                </div>
            </div>
        </div>
        </div>
    </header>


