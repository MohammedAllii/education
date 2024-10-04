<div class="table-responsive">
    <table class="table align-items-center">
        <thead class="tableHeader">
            <tr>
                <th class="text-uppercase text-xxs font-weight-bolder">Full name</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Email</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Phone</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Speciality</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Status</th>
                <th class="text-center text-uppercase text-xxs font-weight-bolder">Actions</th>
            </tr>
        </thead>
        <tbody id="teachersTable">
            @forelse($teachers as $teacher)
                <tr>
                    <td class="align-middle text-center">
                        <div class="d-flex px-2 py-1">
                            <div>
                                <img src="{{ asset($teacher->avatar) }}" class="avatar avatar-sm me-3" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="tableText mb-0 text-sm">{{ $teacher->name }}</h6>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle text-center">
                        <span class="tableText align-middle text-center font-weight-bolder text-sm">{{ $teacher->email }}</span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="tableText badge badge-sm text-white" id="typeRoom">{{ $teacher->phone }}</span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="tableText badge badge-sm text-white bg-dark">{{ $teacher->speciality }}</span>
                    </td>
                    <td class="align-middle text-center">
                        <span class="tableText badge badge-sm {{ $teacher->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $teacher->status }}
                        </span>
                    </td>
                    <td class="align-middle">
                        <a href="#" class="text-secondary font-weight-bold text-xl" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $teacher->id }}" data-toggle="tooltip" data-original-title="Edit teacher">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="text-secondary font-weight-bold text-xl" data-bs-toggle="modal" data-bs-target="#deleteModel{{ $teacher->id }}" data-toggle="tooltip" data-original-title="Delete teacher">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <a href="#" class="text-secondary font-weight-bold text-xl" data-bs-toggle="modal" data-bs-target="#seeModal{{ $teacher->id }}" data-toggle="tooltip" data-original-title="View teacher">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('teacher.schedule', $teacher->id) }}" class="text-secondary font-weight-bold text-xl" data-toggle="tooltip" data-original-title="View Schedule">
                            <i class="fas fa-calendar-alt"></i>
                        </a>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editUserModal{{ $teacher->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-white text-white">
                                <h5 class="modal-title" id="editUserModalLabel"><i class="fas fa-edit"></i> Update Teacher</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label" style="text-align: left;">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $teacher->name }}" required style="border: 1px solid;padding :10px">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label" style="text-align: left;">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $teacher->email }}" required style="border: 1px solid;padding :10px">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label" style="text-align: left;">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $teacher->phone }}" required style="border: 1px solid;padding :10px">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="speciality" class="form-label" style="text-align: left;">Speciality</label>
                                            <select class="form-control" id="speciality" name="speciality" required style="border: 1px solid;padding :10px">
                                                <option value="Mathematics" {{ $teacher->speciality == 'Mathematics' ? 'selected' : '' }}>Mathematics</option>
                                                <option value="Science" {{ $teacher->speciality == 'Science' ? 'selected' : '' }}>Science</option>
                                                <option value="English" {{ $teacher->speciality == 'English' ? 'selected' : '' }}>English</option>
                                                <option value="History" {{ $teacher->speciality == 'History' ? 'selected' : '' }}>History</option>
                                                <option value="Geography" {{ $teacher->speciality == 'Geography' ? 'selected' : '' }}>Geography</option>
                                                <option value="Physical Education" {{ $teacher->speciality == 'Physical Education' ? 'selected' : '' }}>Physical Education</option>
                                                <option value="Art" {{ $teacher->speciality == 'Art' ? 'selected' : '' }}>Art</option>
                                                <option value="Music" {{ $teacher->speciality == 'Music' ? 'selected' : '' }}>Music</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label" style="text-align: left;">Status</label>
                                            <select class="form-control" id="status" name="status" required style="border: 1px solid;padding :10px">
                                                <option value="active" {{ $teacher->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="on_leave" {{ $teacher->status == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="avatar" class="form-label" style="text-align: left;">Avatar</label>
                                            <input type="file" class="form-control" id="avatar" name="avatar" style="border: 1px solid;padding :10px">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100"><i class="fas fa-save"></i> Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModel{{ $teacher->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-white text-white">
                                <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-trash-alt"></i> Delete Teacher</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong>{{ $teacher->name }}</strong>?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Modal -->
                <div class="modal fade" id="seeModal{{ $teacher->id }}" tabindex="-1" aria-labelledby="seeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-white text-white">
                                <h5 class="modal-title" id="seeModalLabel"><i class="fas fa-eye"></i> Teacher Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center mb-3">
                                    <img id="preview-image-{{ $teacher->id }}" src="{{ asset($teacher->avatar) }}" alt="Selected Image" class="img-fluid rounded-circle" style="width: 100px;">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <p><strong><i class="fas fa-user"></i>Name :</strong> {{ $teacher->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <p><strong><i class="fas fa-envelope"></i>Email :</strong> {{ $teacher->email }}</p>
                                                <p><strong><i class="fas fa-briefcase"></i> Speciality:</strong> {{ $teacher->speciality }}</p>
                                                <p><strong><i class="fas fa-info-circle"></i> Status:</strong> {{ $teacher->status }} <span><strong><i class="fas fa-phone"></i> Phone:</strong> {{ $teacher->phone }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        <img src="{{ asset('noresult.png') }}" alt="No Results" class="img-fluid" style="width: 150px">
                        <p class="mt-2">No teachers found matching your criteria.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
$(document).ready(function () {
    $('input[type="file"]').change(function () {
        var userId = $(this).attr('id').split('-')[1];
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