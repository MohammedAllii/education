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

<body class="g-sidenav-show bg-gray-200">
    @include('layouts.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbar">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="navbarText font-weight-bolder mb-0">Dashboard / Classes / Add Class</h6>
                </nav>
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
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            <span>
                                                <img src="{{ asset('user.png') }}" alt="profile_image"
                                                    id="navbarImage">
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
        </nav>

        <div class="container-fluid py-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="row align-items-center">
                                    <div class="col-md">
                                        <div class="shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center"
                                            id="cardTop">
                                            <h6 class="text-capitalize ps-3" id="titreTop">
                                                <img src="{{ asset('addclasse.png') }}" alt="Your Image"
                                                    id="imageCardTop" class="img-fluid me-2">
                                                Add Class
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('classes.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="class_name">Class Name</label>
                                            <select id="class_name" class="form-control @error('class_name') is-invalid @enderror" name="class_name" required style="border: 1px solid;padding:10px">
                                                <option value="">Select Class Name</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                                <option value="G">G</option>
                                                <option value="H">H</option>
                                                <option value="I">I</option>
                                                <option value="J">J</option>
                                                <option value="K">K</option>
                                                <option value="L">L</option>
                                                <option value="M">M</option>
                                                <option value="N">N</option>
                                                <option value="O">O</option>
                                                <option value="P">P</option>
                                                <option value="Q">Q</option>
                                                <option value="R">R</option>
                                                <option value="S">S</option>
                                                <option value="T">T</option>
                                                <option value="U">U</option>
                                                <option value="V">V</option>
                                                <option value="W">W</option>
                                                <option value="X">X</option>
                                                <option value="Y">Y</option>
                                                <option value="Z">Z</option>
                    
                                            </select>
                                            @error('class_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="grade_level">Grade Level</label>
                                            <select id="grade_level" class="form-control @error('grade_level') is-invalid @enderror" name="grade_level" required style="border: 1px solid;padding:10px">
                                                <option value="">Select Grade Level</option>
                                                <option value="1er année">1er année</option>
                                                <option value="2éme année">2éme année</option>
                                                <option value="3éme année">3éme année</option>
                                                <option value="4éme année">4éme année</option>
                                                <option value="5éme année">5éme année</option>
                                                <option value="6éme année">6éme année</option>
                                            </select>
                                            @error('grade_level')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="school_year">School Year</label>
                                            <select id="school_year" class="form-control @error('school_year') is-invalid @enderror" name="school_year" required style="border: 1px solid;padding:10px">
                                                <option value="">Select School Year</option>
                                                <option value="2024/2025">2024/2025</option>
                                                <option value="2025/2026">2025/2026</option>
                                                <option value="2026/2027">2026/2027</option>
                                                <option value="2027/2028">2027/2028</option>
                                                <option value="2028/2029">2028/2029</option>
                                                <option value="2029/2030">2029/2030</option>
                                            </select>
                                            @error('school_year')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="classroom">Classroom</label>
                                            <input type="text" class="form-control" id="classroom" name="classroom"
                                                value="{{ old('classroom') }}" placeholder="classroom " required style="border: 1px solid;padding:10px">
                                            @error('classroom')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
<br>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Add Class</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        // Function to display success message as a toast
        function displaySuccessToast(message) {
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "green",
                stopOnFocus: true,
            }).showToast();
        }

        // Function to display error message as a toast
        function displayErrorToast(message) {
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "red",
                stopOnFocus: true,
            }).showToast();
        }

        // Check if there's a success message in the session and display it as a toast
        @if (session()->has('success'))
        displaySuccessToast("{{ Session::get('success') }}");
        @endif

        @if (Session()->has('error'))
        displayErrorToast("{{ Session::get('error') }}");
        @endif
    </script>

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
