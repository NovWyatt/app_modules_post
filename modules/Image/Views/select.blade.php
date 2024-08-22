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
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Chọn hình ảnh</h6>
                            <div class="row">
                                @foreach ($images as $image)
                                    <div class="col-md-3 mb-4">
                                        <div class="card bg-dark">
                                            <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top"
                                                alt="{{ $image->filename }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $image->filename }}</h5>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="selectImage({{ $image->id }}, '{{ asset('storage/' . $image->path) }}')">Chọn</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
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
    function selectImage(id, url) {
        window.opener.document.getElementById('selected_image_id').value = id;
        window.opener.document.getElementById('selected_image_preview').innerHTML = `<img src="${url}" width="100">`;
        window.close();
    }
</script>
