<head>
<!-- Material Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<!-- CSS Files -->
<link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<!-- Bootstrap Timepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">

<!-- Bootstrap Datepicker and Timepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
</head>


<!-- sidebar -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sideBar">
    <div class="sidenav-header">
      <a class="navbar-brand m-0" href="#">
        <i class="fa fa-tachometer-alt" style="color: black;font-size:20px"></i>&nbsp;
        <span class="navbarText mb-3" style="color: black;font-size:17px;font-weight:bold;"> Dashboard</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2"><br>
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main" >
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-black" href="#" style="color:black;font-weight:bold;{{ Request::is('students') || Request::is('students/create')  ? 'background-color: #048ab7;color:white;' : '' }}" id="employeeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user-graduate"></i>&nbsp;
              Students
          </a>
          <div class="dropdown-menu" aria-labelledby="employeeDropdown">
              <a class="dropdown-item" href="{{ route('students.index') }}" style="color:black;font-weight:bold;{{ Request::is('students')  ? 'background-color: #048ab7;color:white;' : '' }}">
                <i class="fa fa-list"></i>&nbsp; Students managements              
              </a>
              <a class="dropdown-item" href="{{ route('students.create') }}" style="color:black;font-weight:bold;{{ Request::is('students/create')  ? 'background-color: #048ab7;color:white;' : '' }}">
                <i class="fa fa-plus"></i>&nbsp; Add Student
              </a>
          </div>
        </li>
        <hr class="horizontal dark mt-0 mb-2">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-black" href="#" style="color:black;font-weight:bold;{{ Request::is('classes') || Request::is('classes/create')  ? 'background-color: #048ab7;color:white;' : '' }}" id="employeeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-school"></i>&nbsp;
                Classrooms
            </a>
            <div class="dropdown-menu" aria-labelledby="employeeDropdown">
                <a class="dropdown-item" href="{{route('classes.index')}}" style="color:black;font-weight:bold;{{ Request::is('classes')  ? 'background-color: #6aa3ff;color:black;' : '' }}">
                  <i class="fa fa-list"></i>&nbsp; Classes managements              
                </a>
                <a class="dropdown-item" href="{{route('classes.create')}}" style="color:black;font-weight:bold;{{ Request::is('classes/create')  ? 'background-color: #6aa3ff;color:black;' : '' }}">
                  <i class="fa fa-plus"></i>&nbsp; Add Class
                </a>
            </div>
          </li>
          <hr class="horizontal dark mt-0 mb-2">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-black" href="#" style="color:black;font-weight:bold;{{ Request::is('teachers') || Request::is('teachers/create')  ? 'background-color: #048ab7;color:black;' : '' }}" id="employeeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chalkboard-teacher"></i>&nbsp;
                Teachers
            </a>
            <div class="dropdown-menu" aria-labelledby="employeeDropdown">
                <a class="dropdown-item" href="{{route('teachers.index')}}" style="color:black;font-weight:bold;{{ Request::is('teachers')  ? 'background-color: #6aa3ff;color:black;' : '' }}">
                  <i class="fa fa-list"></i>&nbsp; Teachers managements              
                </a>
                <a class="dropdown-item" href="{{route('teachers.create')}}" style="color:black;font-weight:bold;{{ Request::is('teachers/create')  ? 'background-color: #6aa3ff;color:black;' : '' }}">
                  <i class="fa fa-plus"></i>&nbsp; Add Teacher
                </a>
            </div>
          </li>
          <hr class="horizontal dark mt-0 mb-2">




        @guest
        <hr>        
        @else
        <hr><hr><hr><hr>
        <li class="nav-item">
          <a class="nav-link" href="#" style="color:black;font-weight:bold;{{ Request::is('profile')  ? 'background-color: #6aa3ff;color:black;' : '' }}" >
              <i class="fa fa-user-cog"></i>&nbsp;
              Account Settings
          </a>
          </li>
          <hr class="horizontal dark mt-0 mb-2">

          <li class="nav-item">
            <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:black;font-weight:bold;{{ Request::is('logout')  ? 'background-color: #6aa3ff;color:black;' : '' }}" id="employeeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-sign-out"></i>&nbsp;
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
            </li>
        @endguest
      </ul>
    </div>
  </aside>

  