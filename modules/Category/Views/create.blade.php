@extends('layouts.auth')

@section('content')
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        @include('componer.sidebar')
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('componer.navbar')
            <!-- Navbar End -->

            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded h-100 p-4">
                    <h1>Tạo Danh Mục</h1>

                    <!-- Form to create a new category -->
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf

                        <!-- Input for Category Name -->
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Nhập tên danh mục" value="{{ old('name') }}" required>
                            <label for="name">Tên Danh Mục</label>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input for Category Description -->
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control" placeholder="Nhập mô tả danh mục" id="description"
                                style="height: 150px;">{{ old('description') }}</textarea>
                            <label for="description">Mô Tả</label>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Tạo Danh Mục</button>
                    </form>
                </div>
            </div>

            <!-- Footer Start -->
            @include('componer.footerauth')
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
@endsection
