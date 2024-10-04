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

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbar">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="navbarText font-weight-bolder mb-0">Dashboard / Teachers / Add Teacher</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
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
                      <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span>
                          <img src="{{ asset('user.png') }}" alt="profile_image" id="navbarImage">
                          <span class="navbarText font-weight-bolder mb-0">{{ Auth::user()->name }}</span>
                        </span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                        <img src="{{ asset('teacherr.png') }}" alt="Your Image" id="imageCardTop" class="img-fluid me-2">
                        Add Teacher
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <form id="addTeacherForm" method="POST" action="{{ route('teachers.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center mb-3">
                        <div class="d-inline-block">
                            <img id="preview-image" src="{{ asset('teacher.png') }}" alt="Selected Image" class="addFormImage">
                        </div>
                        <div class="d-inline-block align-top" onclick="document.getElementById('avatar').click()">
                            <input type="file" id="avatar" class="btnSelect form-control-file @error('avatar') is-invalid @enderror" name="avatar" accept="image/*" style="display:none">
                            <img id="add-image" src="{{ asset('addimage.png') }}" alt="Add Image" class="iconsTable"> Select image
                        </div>
                    </div>

                    <!-- Full Name and Email -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label" style="text-align: left;">Full Name</label>
                            <input id="name" type="text" placeholder="Full Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus style="border: 1px solid;padding:10px">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label" style="text-align: left;">Email</label>
                            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required style="border: 1px solid;padding:10px">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone and Speciality -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label" style="text-align: left;">Phone</label>
                            <input id="phone" type="text" placeholder="Phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required style="border: 1px solid;padding:10px">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="speciality" class="form-label" style="text-align: left;">Speciality</label>
                            <input id="speciality" type="text" placeholder="Speciality" class="form-control @error('speciality') is-invalid @enderror" name="speciality" value="{{ old('speciality') }}" required style="border: 1px solid;padding:10px">
                            @error('speciality')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label" style="text-align: left;">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required style="border: 1px solid;padding:10px">
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="On Leave" {{ old('status') == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password and Confirm Password -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label" style="text-align: left;">Password</label>
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required style="border: 1px solid;padding:10px">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label" style="text-align: left;">Confirm Password</label>
                            <input id="password_confirmation" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required style="border: 1px solid;padding:10px">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Teacher</button>
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
  <script>
    document.getElementById('avatar').addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('preview-image').src = e.target.result;
        }
        reader.readAsDataURL(file);
      }
    });
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
