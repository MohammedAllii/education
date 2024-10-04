@extends('layouts.app')

@section('content')
    <style>
        body {
            background-image: url('{{ asset('./assets/img/bgg.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: contain;
        }

        .page-background {
            background-color: rgba(255, 255, 255, 0.3);
            padding: 20px;
            border-radius: 10px;
        }

        .filter-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .filter-btn {
            display: flex;
            align-items: center;
            margin: 0 10px;
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            background-color: #fff;
            color: #333;
            transition: background-color 0.3s, color 0.3s;
        }

        .filter-btn:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .filter-btn i {
            margin-right: 8px;
        }

        .card-img-top {
            width: 100px;
            margin: 0 auto;
        }

        .show-more-btn {
            display: none;
            margin: 20px 0;
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #6f9bc9;
            color: #fff;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s;
        }

        .show-more-btn:hover {
            background-color: #0056b3;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            outline: 0;
        }

        .modal-dialog {
    margin: auto; 
}

.modal-content {
    width: 100%;
    max-width: 600px; 
}

        .modal-header {
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }

        .modal-title {
            margin: 0;
            line-height: 1.5;
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem;
        }

        .modal-footer {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            padding: .75rem;
            border-top: 1px solid #ddd;
        }

        .modal-footer > * {
            margin: 0 .25rem;
        }
    </style>

    <div class="container mt-5 page-background">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <img src="{{ asset('./assets/img/classroomlogo.png') }}" alt="Class Image" style="width: 50px; height: auto; margin-right: 10px;">
                <h2 class="m-0" style="color: black;font-weight:bold;font-style: italic;">Manage <span style="color: rgb(22, 73, 151)">Classes</span></h2>
            </div>
            
            <a href="{{ route('classes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Class
            </a>
        </div>
        
        <!-- Filter Bar -->
        <div class="filter-bar">
            <div class="filter-btn" data-level="all">
                <i class="fas fa-filter"></i> All
            </div>
            <div class="filter-btn" data-level="Beginner">
                <i class="fas fa-star"></i> Beginner
            </div>
            <div class="filter-btn" data-level="Intermediate">
                <i class="fas fa-star-half-alt"></i> Intermediate
            </div>
            <div class="filter-btn" data-level="Advanced">
                <i class="fas fa-star-full"></i> Advanced
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row" id="class-list">
            @foreach ($classes as $class)
                <div class="col-md-4 mb-3 class-item" data-level="{{ $class->level }}">
                    <div class="card shadow-sm text-center position-relative" style="background-color:rgb(131, 183, 219,0.3)">
                        <div class="dropdown position-absolute top-0 end-0 m-2" style="background-color: white;color:white;border:1px solid white">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white;color:black">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $class->id }}" style="background-color: white;">
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewModal{{ $class->id }}" style="cursor:pointer;"><i class="fas fa-eye"></i> View</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $class->id }}" style="cursor:pointer;"><i class="fas fa-edit"></i> Edit</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $class->id }}" style="cursor:pointer;"><i class="fas fa-trash"></i> Delete</a></li>
                            </ul>
                        </div>
                        <img src="{{ asset('./assets/img/classroom.png') }}" class="card-img-top" alt="Class Image">

                        <!-- Inner card for class details -->
                        <div class="card-body">
                            <div class="card" style="border-radius: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $class->name }}</h5>
                                    <p class="card-text" style="color: black">
                                        <i class="fas fa-graduation-cap"></i> <strong>Level:</strong> {{ $class->level }}<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Modal -->
                <div class="modal fade" id="viewModal{{ $class->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $class->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel{{ $class->id }}">View Class</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Name:</strong> {{ $class->name }}</p>
                                <p><strong>Level:</strong> {{ $class->level }}</p>
                                <!-- Add more class details here if needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $class->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $class->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $class->id }}">Edit Class</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('classes.update', $class) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Class Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $class->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Level</label>
                                        <select class="form-control" id="level" name="level" required>
                                            <option value="Beginner" {{ $class->level == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                            <option value="Intermediate" {{ $class->level == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                            <option value="Advanced" {{ $class->level == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $class->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $class->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $class->id }}">Delete Class</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('classes.destroy', $class) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <p>Are you sure you want to delete the class <strong>{{ $class->name }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="show-more-btn" class="show-more-btn">
            Show More
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const classItems = document.querySelectorAll('.class-item');
            const showMoreBtn = document.getElementById('show-more-btn');
            const itemsToShow = 6;
            
            function updateClassVisibility(level) {
                let visibleCount = 0;
                
                classItems.forEach(item => {
                    if (level === 'all' || item.getAttribute('data-level') === level) {
                        visibleCount++;
                        item.style.display = visibleCount <= itemsToShow ? 'block' : 'none';
                    } else {
                        item.style.display = 'none';
                    }
                });

                showMoreBtn.style.display = visibleCount > itemsToShow ? 'block' : 'none';
            }

            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const level = this.getAttribute('data-level');
                    updateClassVisibility(level);
                });
            });

            showMoreBtn.addEventListener('click', function () {
                classItems.forEach(item => {
                    if (item.style.display === 'none') {
                        item.style.display = 'block';
                    }
                });
                this.style.display = 'none';
            });

            updateClassVisibility('all');
        });
    </script>
@endsection
