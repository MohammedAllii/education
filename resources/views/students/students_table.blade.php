<div class="table-responsive">
    <table class="table align-items-center">
        <thead class="tableHeader">
            <tr>
                <th class="text-uppercase text-xxs font-weight-bolder">Full name</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Date of Birth</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Gender</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Adress</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Enrollment Date</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Class</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Actions</th>
            </tr>
        </thead>
        <tbody id="studentsTable">
            @forelse($students as $student)
                <tr>
                    <td class="align-middle text-center">
                        <div class="d-flex px-2 py-1">
                            <div>
                                <img src="{{ asset($student->avatar) }}" class="avatar avatar-sm me-3" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="tableText mb-0 text-sm">{{ $student->full_name }} </h6>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle text-center">
                        <span class="tableText align-middle text-center font-weight-bolder text-sm">{{ $student->date_of_birth }}</span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="tableText badge badge-sm text-white" id="typeRoom">{{ $student->gender }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="tableText badge badge-sm text-white bg-dark" >{{ $student->address }}</span>
                  </td>
                    <td>
                        <span class="tableText align-middle text-center font-weight-bolder text-sm">{{ $student->enrollment_date }}</span>
                    </td>
                    <td>
                        <span class="tableText align-middle text-center font-weight-bolder text-sm">{{ $student->class->grade_level }} {{ $student->class->class_name }}</span>
                    </td>
                    <td class="align-middle">
                        <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $student->id }}" data-toggle="tooltip" data-original-title="Edit student">
                            <img src="{{ asset('edit.png') }}" alt="Edit student" class="iconsTable">
                        </a>
                        <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteModel{{ $student->id }}" data-toggle="tooltip" data-original-title="Delete student">
                            <img src="{{ asset('delete.png') }}" alt="Delete student" class="iconsTable">
                        </a>
                        <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#seeModal{{ $student->id }}" data-toggle="tooltip" data-original-title="View student">
                            <img src="{{ asset('seeicon.png') }}" alt="View student" class="iconsTable">
                        </a>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editUserModal{{ $student->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="headerModal modal-header">
                            <h5 class="tableText modal-title text-white" id="updateModalLabel" > <img src="{{ asset('update.png') }}" alt="user Image" id="ModalImage">  Update Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                          <div class="modal-body">
                            <form id="updateForm{{ $student->id }}" method="POST" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="text-center mb-3">
                                    <div class="d-inline-block">
                                        <img id="preview-image-{{ $student->id }}" src="{{ asset($student->avatar) }}" alt="Selected Image" class="addFormImageUser">
                                    </div>
                                    <div class="tableText d-inline-block align-top" onclick="document.getElementById('image-{{ $student->id }}').click()">
                                        <input type="file" id="image-{{ $student->id }}" class="btnSelect form-control-file image-input" name="avatar" accept="image/*">
                                        <img id="add-image-{{ $student->id }}" src="{{ asset('addimage.png') }}" alt="Add Image" class="iconsTable">Select image
                                    </div>
                                </div>
                            
                                <!-- Full Name and Date of Birth Inline -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input type="text" placeholder="Full Name" id="update_user_name{{ $student->id }}" class="form-control" name="full_name" value="{{ $student->full_name }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" placeholder="Date of Birth" id="update_dob{{ $student->id }}" class="form-control" name="date_of_birth" value="{{ $student->date_of_birth }}" required>
                                    </div>
                                </div>
                            
                                <!-- Address and Gender Inline -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input type="text" placeholder="Address" class="form-control" name="address" value="{{ $student->address }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-check-label">Gender</label><br>
                                        <input type="radio" name="gender" value="male" {{ $student->gender == 'male' ? 'checked' : '' }}> Male
                                        <input type="radio" name="gender" value="female" {{ $student->gender == 'female' ? 'checked' : '' }}> Female
                                    </div>
                                </div>
                            
                                <!-- Parent Name and Parent Phone Inline -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input type="text" placeholder="Parent's Name" class="form-control" name="parent_name" value="{{ $student->parent_name }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="Parent's Phone" class="form-control" name="parent_phone" value="{{ $student->parent_phone }}" required>
                                    </div>
                                </div>
                            
                                <!-- Parent Email and Enrollment Date Inline -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input type="email" placeholder="Parent's Email" class="form-control" name="parent_email" value="{{ $student->parent_email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" placeholder="Enrollment Date" class="form-control" name="enrollment_date" value="{{ $student->enrollment_date }}" required>
                                    </div>
                                </div>
                            
                                <!-- Class and Status Inline -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <select name="class_id" class="form-control">
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>{{ $class->grade_level}} {{ $class->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="status" class="form-control">
                                            <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="transferred" {{ $student->status == 'transferred' ? 'selected' : '' }}>Transferred</option>
                                            <option value="suspended" {{ $student->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="modal-footer">
                                    <button type="button" class="btn" id="cancelBtn" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn" id="updateBtn">Update</button>
                                </div>
                            </form>
                            
                          </div>
                        </div>
                      </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModel{{ $student->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="headerModal modal-header" >
                                <h5 class="tableText modal-title text-white" id="deleteModelLabel{{ $student->id }}"><img src="{{ asset('deleteIcon.png') }}" alt="user Image" id="ModalImage">   Delete Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="tableText modal-body font-weight-bolder">
                                Are you sure to delete <span class="tableText">{{ $student->full_name }}</span> ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal" id="cancelBtn"> Cancel</button>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" id="deleteBtn"> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Modal -->
                <div class="modal fade" id="seeModal{{ $student->id }}" tabindex="-1" aria-labelledby="seeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="headerModal modal-header">
                                <h5 class="tableText modal-title text-white" id="seeModalLabel{{ $student->id }}"><img src="{{ asset('details_student.png') }}" alt="user Image" id="ModalImage">   Student Details</h5>
                            </div>
                            <div class="modal-body">
                                <div class="text-center mb-3">
                                    <div class="d-inline-block">
                                        <img id="preview-image" src="{{ asset($student->avatar) }}" alt="Selected Image" class="addFormImageUser">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="tableText"><strong><img src="{{ asset('last.png') }}" alt="user Image" id="seeDetailsUser"> Name:</strong> {{ $student->full_name }}</p>
                                        <p class="tableText"><strong><img src="{{ asset('birth.png') }}" alt="user Image" id="seeDetailsUser">Date of birth :</strong> {{ $student->date_of_birth }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="tableText"><strong><img src="{{ asset('gender.png') }}" alt="user Image" id="seeDetailsUser"> Gender:</strong> {{ $student->gender }}</p>
                                        <p class="tableText"><strong><img src="{{ asset('status.png') }}" alt="user Image" id="seeDetailsUser"> Status:</strong> {{ $student->status }}</p>

                                    </div>
                                    <div class="col-md-6">
                                        <p class="tableText"><strong><img src="{{ asset('last.png') }}" alt="user Image" id="seeDetailsUser"> Parent Name :</strong> {{ $student->parent_name }}</p>
                                    </div>   
                                    <div class="col-md-6">
                                        <p class="tableText"><strong><img src="{{ asset('phone.png') }}" alt="user Image" id="seeDetailsUser"> Parent phone :</strong> {{ $student->parent_phone }}</p>
                                    </div>    
                                    <div class="row mb-3">
                                        <div class="col-md-6 d-flex align-items-center">
                                            <img src="{{ asset('email_icon.png') }}" alt="Email Icon" class="me-2" id="seeDetailsUser">
                                            <p class="tableText"><strong>Parent Email:</strong></p>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="badge badge-sm text-white bg-dark">{{ $student->parent_email }}</span>
                                        </div>
                                    </div>                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6 d-flex align-items-center">
                                            <img src="{{ asset('date.png') }}" alt="Email Icon" class="me-2" id="seeDetailsUser">
                                            <p class="tableText"><strong>Enrollment date:</strong></p>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="badge badge-sm text-white bg-dark">{{ $student->enrollment_date }}</span>
                                        </div>
                                    </div>      
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn" data-bs-dismiss="modal" id="cancelBtn"><img src="{{ asset('cancel.png') }}" alt="user Image" id="buttonsModal"> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        <img src="{{ asset('noresult.png') }}" alt="No Results" class="img-fluid" style="width: 150px">
                        <p class="mt-2">No students found matching your criteria.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
 // Change image preview when file input changes
$(document).ready(function () {
    $('input[type="file"]').change(function () {
        var userId = $(this).attr('id').split('-')[1]; // Extract user ID from input ID
        previewImage(this, 'preview-image-' + userId);
    });
});

function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + previewId).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

  </script>
  <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('preview-image').setAttribute('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('avatar').addEventListener('change', function() {
        readURL(this);
    });
</script>