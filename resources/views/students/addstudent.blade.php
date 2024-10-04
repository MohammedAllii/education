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
          <h6 class="navbarText font-weight-bolder mb-0">Dashboard / Students / Add Student</h6>
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
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="row align-items-center">
                  <div class="col-md">
                    <div class="shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" id="cardTop">
                      <h6 class="text-capitalize ps-3" id="titreTop">
                        <img src="{{ asset('newstudent.png') }}" alt="Your Image" id="imageCardTop" class="img-fluid me-2">
                        Add Student
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center mb-3">
                        <div class="d-inline-block">
                            <img id="preview-image" src="{{ asset('studentImage.png') }}" alt="Selected Image" class="addFormImage">
                        </div>
                        <div class="d-inline-block align-top" onclick="document.getElementById('avatar').click()">
                            <input type="file" id="avatar" class="btnSelect form-control-file @error('avatar') is-invalid @enderror" name="avatar" accept="image/*" style="display:none">
                            <img id="add-image" src="{{ asset('addimage.png') }}" alt="Add Image" class="iconsTable"> Select image
                        </div>
                    </div>
                
                    <!-- Full Name and Date of Birth -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="name" class="form-label">Full Name</label>
                            <input id="full_name" type="text" placeholder="Full Name" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required autofocus style="border: 1px solid;padding:10px">
                            @error('full_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                          <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input id="date_of_birth" type="date" placeholder="Date of Birth" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required style="border: 1px solid;padding:10px">
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                
                    <!-- Address and Gender -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="address" class="form-label">Address</label>
                            <input id="address" type="text" placeholder="Address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" style="border: 1px solid;padding:10px">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6" >
                            <label class="form-check-label">Gender</label><br>
                            <input id="gender_male" type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required > Male
                            <input id="gender_female" type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} required> Female
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                
                    <!-- Parent's Name and Parent's Phone -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="parent_name" class="form-label">Parent name</label>
                            <input id="parent_name" type="text" placeholder="Parent's Name" class="form-control @error('parent_name') is-invalid @enderror" name="parent_name" value="{{ old('parent_name') }}" required style="border: 1px solid;padding:10px">
                            @error('parent_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                          <label for="parent_phone" class="form-label">Parent phone</label>
                            <input id="parent_phone" type="text" placeholder="Parent's Phone" class="form-control @error('parent_phone') is-invalid @enderror" name="parent_phone" value="{{ old('parent_phone') }}" required style="border: 1px solid;padding:10px">
                            @error('parent_phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                
                    <!-- Parent's Email and Enrollment Date -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="parent_email" class="form-label">Parent email</label>
                            <input id="parent_email" type="email" placeholder="Parent's Email" class="form-control @error('parent_email') is-invalid @enderror" name="parent_email" value="{{ old('parent_email') }}" style="border: 1px solid;padding:10px">
                            @error('parent_email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                          <label for="enrollment_date" class="form-label">Enrollment Date</label>
                            <input id="enrollment_date" type="date" placeholder="Enrollment Date" class="form-control @error('enrollment_date') is-invalid @enderror" name="enrollment_date" value="{{ old('enrollment_date') }}" required style="border: 1px solid;padding:10px">
                            @error('enrollment_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                
                    <!-- Class and Status -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="class_id" class="form-label">Select Class</label>
                            <select id="class_id" class="form-control @error('class_id') is-invalid @enderror" name="class_id" required style="border: 1px solid;padding:10px">
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                          <label for="status" class="form-label">Select Status</label>
                            <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required style="border: 1px solid;padding:10px">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="transferred" {{ old('status') == 'transferred' ? 'selected' : '' }}>Transferred</option>
                                <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                
                    <!-- Medical Notes -->
                    <div class="mb-3">
                      <label for="medical_notes" class="form-label">Medical Notes</label>
                        <textarea id="medical_notes" placeholder="Medical Notes" class="form-control @error('medical_notes') is-invalid @enderror" name="medical_notes" rows="3" style="border: 1px solid;padding:10px">{{ old('medical_notes') }}</textarea>
                        @error('medical_notes')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                
                    <!-- Submit Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Student</button>
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
