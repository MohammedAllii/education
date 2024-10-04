<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <title>Education</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  @include('layouts.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbar">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="navbarText font-weight-bolder mb-0">Dashboard / Teachers Managements</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline"></div>
          </div>
          @guest
          @else
          <div>
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
                      <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
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

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
    <div class="container-fluid py-3">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-4 z-index-2">
                <div class="row align-items-center">
                  <div class="col-md">
                    <div class="border-radius-lg pt-1 pb-1 d-flex justify-content-between align-items-center" id="cardTop">
                      <h6 class="text-capitalize ps-3" id="titreTop">
                        <img src="{{ asset('teachers.png') }}" alt="Your Image" id="imageCardTop" class="img-fluid me-2">
                        Teachers Table
                      </h6>
                      <form action="{{route('teachers.create')}}" method="GET" class="m-1">
                        <button type="submit" class="btn btn-outline" id="btnAddPage">
                          Add Teacher
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="card-body px-3 pb-2" style="text-align: center">
              

              <div class="table-wrapper">
                @include('teachers.teachers_table', ['teachers' => $teachers])
              </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </main>



  
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('js/material-dashboard.min.js?v=3.1.0') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</body>

</html>
