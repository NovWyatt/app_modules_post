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
                    <h1>{{ $post->title }}</h1>
                    <p><strong>Danh Mục:</strong> {{ $post->category ? $post->category->name : 'Chưa có danh mục' }}</p>
                    <p><strong>Người Dùng:</strong> {{ $post->user->name }}</p>
                    <p><strong>Trạng Thái:</strong> {{ $post->status }}</p>
                    <div>
                        <h3>Nội Dung</h3>
                        <p>{{ $post->content }}</p>
                    </div>
                    <p><strong>Hình Ảnh:</strong>
                        @if ($post->image_path)
                            <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->image_path }}" width="100">
                        @else
                            Không có hình ảnh
                        @endif
                    </p>
                    <p><strong>Ngày tạo:</strong> {{ $post->created_at->format('d/m/Y') }}</p>
                    <a href="{{ route('post') }}" class="btn btn-primary m-2">Quay Lại</a>
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
