<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <title>Education</title>
  <!-- Load Google Charts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  @include('layouts.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbar">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="navbarText font-weight-bolder mb-0">Dashboard </h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
            </div>
          </div>
          @guest
          @else
          <div class="">
            <nav aria-label="breadcrumb">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="nav navbar-right">
                            @guest
                            @else
                            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                  <i class="sidenav-toggler-line"></i>
                                  <i class="sidenav-toggler-line"></i>
                                  <i class="sidenav-toggler-line"></i>
                                </div>
                              </a>
                            </li>
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-black" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span>
                                        <img src="{{ asset('user.png') }}" alt="profile_image" id="navbarImage">
                                        <span class="navbarText font-weight-bolder mb-0">
                                            {{ Auth::user()->name }}</span>
                                    </span>
                                </a>
        
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
        
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        @endguest
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <img src="{{ asset('studentss.png') }}" alt="Your Image" style="width: 80px;" class="img-fluid">
              </div>
              <div class="text-end pt-1">
                <span class="tableText nav-link-text ms-1 text-black text-lg" style="font-family: serif;">Students</span>
                <h4 class="tableText mb-0">5</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3" style="background-color: rgb(109, 196, 218)">
              <span class="nav-link-text ms-1 text-md font-weight-bolder" style="font-family: serif;color:black">All Students</span>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <img src="{{ asset('teacher.png') }}" alt="Your Image" style="width: 80px;" class="img-fluid">
              </div>
              <div class="text-end pt-1">
                <span class="tableText nav-link-text ms-1 text-black text-lg" style="font-family: serif;">Teachers</span>
                <h4 class="tableText mb-0">8</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3" style="background-color: rgb(109, 196, 218)">
              <span class="nav-link-text ms-1 text-md font-weight-bolder" style="font-family: serif;;color:black">All Teachers</span>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <img src="{{ asset('courses.png') }}" alt="Your Image" style="width: 80px;" class="img-fluid">
              </div>
              <div class="text-end pt-1">
                <span class="tableText nav-link-text ms-1 text-black text-lg" style="font-family: serif;">Courses</span>

                <h4 class="tableText mb-0">10</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3" style="background-color: rgb(109, 196, 218)">
              <span class="tableText nav-link-text ms-1 text-md font-weight-bolder" style="font-family: serif;;color:black">All Courses</span>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <img src="{{ asset('exams.png') }}" alt="Your Image" style="width: 80px;" class="img-fluid">
              </div>
              <div class="text-end pt-1">
                <span class="tableText nav-link-text ms-1 text-black text-lg" style="font-family: serif;">Exams</span>
                <h4 class="tableText mb-0">20</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3" style="background-color: rgb(109, 196, 218)">
              <span class="nav-link-text ms-1 text-md font-weight-bolder" style="font-family: serif;;color:black">All Exams</span>
            </div>
          </div>
        </div>
        </div>


        <div class="row mt-4">
          <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
              <div class="card z-index-0 " >                
                <div class="card-body" >
                  <div class="d-flex ">

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="card z-index-2">
              
              <div class="card">
                <div class="card-header pb-0">
                  <div class="row">
                    <div class="col-lg-12 col-7">
                      <h6 class="tableText">
                        <img src="{{ asset('upcomming.png') }}" alt="Your Image" style="width: 30px;" class="img-fluid">
                        Today's Upcoming Reservations
                      </h6>
                    </div>
                  </div>
                </div>
                <div class="card-body px-0 pb-2">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="tableText text-uppercase text-xxs font-weight-bolder">Booking Title</th>
                          <th class="tableText text-uppercase text-xxs font-weight-bolder ps-2">Booking Employee</th>
                          <th class="tableText text-center text-uppercase text-xxs font-weight-bolder">Time</th>
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


                
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/material-dashboard.min.js?v=3.1.0') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>





</html>
