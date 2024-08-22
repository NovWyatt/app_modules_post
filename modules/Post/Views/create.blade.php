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
                    <h1>Tạo Bài Viết</h1>
                    <form action="{{ route('post.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu Đề</label>
                            <input type="text" name="title" class="form-control" id="title"
                                placeholder="Nhập tiêu đề" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội Dung</label>
                            <textarea name="content" class="form-control" id="content" placeholder="Nhập nội dung" rows="5" required></textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select name="category_id" class="form-select" id="category_id" required>
                                <option value="" disabled selected>Chọn Danh Mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select name="status" class="form-select" id="status" required>
                                <option value="draft" selected>Nháp</option>
                                <option value="published">Xuất Bản</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" onclick="openImageSelector()">Chọn
                                Ảnh</button>
                            <input type="hidden" id="selected_image_id" name="image_path" value="{{ old('image_path') }}">
                            <div id="selected_image_preview">
                                @if (old('image_path'))
                                    <img src="{{ asset('storage/images/' . old('image_path')) }}" width="100">
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tạo Bài Viết</button>
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
<script>
    function openImageSelector() {
        window.open('{{ route('image.select') }}', 'Chọn hình ảnh', 'width=800,height=600');
    }

    function selectImage(id, url) {
        document.getElementById('selected_image_id').value = id;
        document.getElementById('selected_image_preview').innerHTML = `<img src="${url}" width="100">`;
    }
</script>
