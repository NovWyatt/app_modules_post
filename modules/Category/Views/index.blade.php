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
                <a href="{{ route('category.create') }}" class="btn btn-primary m-2">Tạo Danh Mục</a>

                <!-- Edit Button -->
                <a id="editButton" href="#" class="btn btn-primary m-2"
                    data-action="{{ route('category.edit', ['id' => '__ID__']) }}" disabled>Chỉnh Sửa Danh Mục</a>

                <!-- Delete Form -->
                <form id="deleteForm" method="POST" action="#" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button id="deleteButton" type="submit" class="btn btn-primary m-2" disabled>Xóa Danh Mục</button>
                </form>
            </div>

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Danh Sách Danh Mục</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên Danh Mục</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col">Mô Tả</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input category-radio" type="radio"
                                                            name="gridRadios" id="categoryRadio{{ $category->id }}"
                                                            value="{{ $category->id }}" />
                                                        <label class="form-check-label"
                                                            for="categoryRadio{{ $category->id }}"></label>
                                                    </div>
                                                </td>
                                                <th scope="row">{{ $category->id }}</th>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
    document.addEventListener('DOMContentLoaded', function() {
        const editButton = document.getElementById('editButton');
        const deleteForm = document.getElementById('deleteForm');
        const categoryRadios = document.querySelectorAll('.category-radio');

        let selectedCategoryId = null;

        categoryRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    // Nếu radio button được chọn
                    selectedCategoryId = this.value;
                } else {
                    // Nếu radio button bị bỏ chọn
                    if (selectedCategoryId === this.value) {
                        selectedCategoryId = null;
                    }
                }
                updateButtonStates();
            });
        });

        function updateButtonStates() {
            if (selectedCategoryId) {
                // Update URLs with selected ID
                const editUrl = editButton.getAttribute('data-action').replace('__ID__', selectedCategoryId);

                editButton.href = editUrl;
                editButton.disabled = false;

                // Update delete form action with selected ID
                deleteForm.action = `/category/${selectedCategoryId}`;

                deleteForm.querySelector('button').disabled = false;
            } else {
                editButton.disabled = true;
                deleteForm.querySelector('button').disabled = true;
                editButton.href = '#';
                deleteForm.action = '#';
            }
        }
    });
</script>
