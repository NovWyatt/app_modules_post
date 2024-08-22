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
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Nút nằm bên trái -->
                    <div>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary m-2">Tạo Bài Viết</a>
                        <a id="editButton" href="#" class="btn btn-primary m-2"
                            data-action="{{ route('post.edit', ['id' => '__ID__']) }}" disabled>Chỉnh Sửa Bài Viết</a>
                        <form id="deleteForm" method="POST" action="#" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button id="deleteButton" type="submit" class="btn btn-primary m-2" disabled>Xóa Bài
                                Viết</button>
                        </form>
                    </div>

                    <!-- Bộ lọc nằm bên phải -->
                    <div class="bg-secondary rounded p-4">
                        <form method="GET" action="{{ route('post') }}" class="d-flex align-items-center">
                            <select name="category_id" class="form-select form-select-lg mb-0 mx-2"
                                aria-label=".form-select-lg example" onchange="this.form.submit()">
                                <option value="" selected>Chọn Danh Mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request()->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Danh Sách Bài Viết</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll" />
                                                    <label class="form-check-label" for="selectAll"></label>
                                                </div>
                                            </th>
                                            <th scope="col">#</th>
                                            <th scope="col">Tiêu Đề</th>
                                            <th scope="col">Danh Mục</th>
                                            <th scope="col">Người Dùng</th>
                                            <th scope="col">Trạng Thái</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input post-checkbox" type="checkbox"
                                                            name="postIds[]" id="postCheckbox{{ $post->id }}"
                                                            value="{{ $post->id }}" />
                                                        <label class="form-check-label"
                                                            for="postCheckbox{{ $post->id }}"></label>
                                                    </div>
                                                </td>
                                                <th scope="row">{{ $post->id }}</th>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->category ? $post->category->name : 'Chưa có danh mục' }}</td>
                                                <td>{{ $post->user->name }}</td>
                                                <td>{{ $post->status }}</td>
                                                <td>
                                                    <a href="{{ route('post.show', ['id' => $post->id]) }}"
                                                        class="btn btn-info btn-sm">Xem Chi Tiết</a>
                                                </td>
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
        const editButton = document.getElementById('editButton');
        const deleteForm = document.getElementById('deleteForm');
        const postCheckboxes = document.querySelectorAll('.post-checkbox'); // Thay đổi lớp thành .post-checkbox
        const selectAllCheckbox = document.getElementById('selectAll');

        let selectedPostIds = [];

        postCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    selectedPostIds.push(this.value);
                } else {
                    selectedPostIds = selectedPostIds.filter(id => id !== this.value);
                }
                updateSelectAllCheckbox();
                updateButtonStates();
            });
        });

        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            postCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
                if (isChecked) {
                    if (!selectedPostIds.includes(checkbox.value)) {
                        selectedPostIds.push(checkbox.value);
                    }
                } else {
                    selectedPostIds = [];
                }
            });
            updateButtonStates();
        });

        function updateSelectAllCheckbox() {
            selectAllCheckbox.checked = selectedPostIds.length === postCheckboxes.length;
        }

        function updateButtonStates() {
            if (selectedPostIds.length > 0) {
                if (selectedPostIds.length === 1) {
                    // Cập nhật URL chỉnh sửa cho bài viết cụ thể
                    const editUrl = editButton.getAttribute('data-action').replace('__ID__', selectedPostIds[
                        0]);
                    editButton.href = editUrl;
                    editButton.disabled = false;

                    // Cập nhật hành động xóa cho bài viết cụ thể
                    deleteForm.action = "{{ route('post.destroy', ['id' => '__ID__']) }}".replace('__ID__',
                        selectedPostIds[0]);
                } else {
                    // Khi chọn nhiều bài viết, không cho phép chỉnh sửa
                    editButton.disabled = true;
                    deleteForm.action = "{{ route('post.destroyMultiple') }}";
                }
                deleteForm.querySelector('button').disabled = false;
            } else {
                editButton.disabled = true;
                deleteForm.querySelector('button').disabled = true;
                editButton.href = '#';
                deleteForm.action = '#';
            }
        }

        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            selectedPostIds.forEach((id) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'postIds[]'; // Thay đổi tên tham số thành postIds[]
                input.value = id;
                this.appendChild(input);
            });
            this.submit();
        });
    });
</script>
