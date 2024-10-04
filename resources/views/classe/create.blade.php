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

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 5px;
            padding: 0.65rem 1.25rem;
            font-size: 1rem;
            line-height: 1.5;
        }

        .form-control:focus {
            border-color: #6f9bc9;
            box-shadow: 0 0 0 0.2rem rgba(111, 202, 254, 0.25);
        }

        .form-control-placeholder {
            color: #6c757d;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control-wrapper {
            position: relative;
        }

        .form-control-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .btn-primary {
            background-color: #6f9bc9;
            border: none;
            border-radius: 5px;
            padding: 1rem;
            font-size: 1.25rem;
            color: #fff;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .btn-primary i {
            margin-right: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container mt-5 page-background">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <img src="{{ asset('./assets/img/add.png') }}" alt="Class Image" style="width: 50px; height: auto; margin-right: 10px;">
                <h2 class="m-0" style="color: black;font-weight:bold;font-style: italic;">Add New <span style="color: rgb(22, 73, 151)">Class</span></h2>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('classes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <div class="form-control-wrapper">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter class name" value="{{ old('name') }}" required>
                    <i class="fas fa-user form-control-icon"></i>
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <div class="form-control-wrapper">
                    <select name="level" id="level" class="form-control" required>
                        <option value="" disabled selected>Select level</option>
                        <option value="Beginner" {{ old('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="Intermediate" {{ old('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="Advanced" {{ old('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                    <i class="fas fa-chevron-down form-control-icon"></i>
                </div>
                @error('level')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <div class="form-control-wrapper">
                    <textarea name="description" id="description" class="form-control" placeholder="Enter class description">{{ old('description') }}</textarea>
                    <i class="fas fa-pencil-alt form-control-icon"></i>
                </div>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create Class
            </button>
        </form>
    </div>
@endsection
