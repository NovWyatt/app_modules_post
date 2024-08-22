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
                <!-- Create Button -->
                <a href="{{ route('image.upload') }}" class="btn btn-primary m-2">Tải lên hình ảnh mới</a>

                <!-- Delete Form -->
                <form id="deleteForm" method="POST" action="#" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button id="deleteButton" type="submit" class="btn btn-primary m-2" disabled>Xóa hình ảnh</button>
                </form>
            </div>

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Danh sách hình ảnh</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên file</th>
                                            <th scope="col">Đường dẫn</th>
                                            <th scope="col">Loại file</th>
                                            <th scope="col">Kích thước</th>
                                            <th scope="col">Xem trước</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($images as $image)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input image-radio" type="radio"
                                                            name="gridRadios" id="imageRadio{{ $image->id }}"
                                                            value="{{ $image->id }}" />
                                                        <label class="form-check-label"
                                                            for="imageRadio{{ $image->id }}"></label>
                                                    </div>
                                                </td>
                                                <th scope="row">{{ $image->id }}</th>
                                                <td>{{ $image->filename }}</td>
                                                <td>{{ $image->path }}</td>
                                                <td>{{ $image->mime_type }}</td>
                                                <td>{{ $image->size }} bytes</td>
                                                <td><img src="{{ asset('storage/' . $image->path) }}"
                                                        alt="{{ $image->filename }}" width="50"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

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
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForm = document.getElementById('deleteForm');
        const imageRadios = document.querySelectorAll('.image-radio');

        let selectedImageId = null;

        imageRadios.forEach(radio => {
            radio.addEventListener('click', function() {
                if (this.checked && selectedImageId === this.value) {
                    this.checked = false;
                    selectedImageId = null;
                } else {
                    imageRadios.forEach(r => r.checked = false);
                    this.checked = true;
                    selectedImageId = this.value;
                }

                updateButtonStates();
            });
        });

        function updateButtonStates() {
            if (selectedImageId) {
                deleteForm.action = `/images/${selectedImageId}`;
                deleteForm.querySelector('button').disabled = false;
            } else {
                deleteForm.action = '#';
                deleteForm.querySelector('button').disabled = true;
            }
        }
    });
</script>
