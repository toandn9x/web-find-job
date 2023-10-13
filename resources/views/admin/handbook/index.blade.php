@extends('admin.layouts.master')

@section('main-content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-header-title">Cẩm nang</h1>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('handbook.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tạo mới</a>
            </div>
            <!-- Card -->
            <div class="card mb-3 mb-lg-5">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-md">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header-title">Danh sách bài viết</h4>
                            </div>
                        </div>
                        <!-- End Col -->
                        <div class="col-auto">
                            <!-- Filter -->
                            <div class="row align-items-sm-center">
                                <div class="col-md">
                                    <form>
                                        <!-- Search -->
                                        <div class="input-group input-group-merge input-group-flush">
                                            <div class="input-group-prepend input-group-text">
                                                <i class="bi-search"></i>
                                            </div>
                                            <input id="datatableSearch" type="search" class="form-control"
                                                placeholder="Nhập để tìm kiếm" aria-label="Search users">
                                        </div>
                                        <!-- End Search -->
                                    </form>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Filter -->
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                        "columnDefs": [{
                            "targets": [0, 1, 2, 3, 4],
                            "orderable": false
                            }],
                        "order": [],
                        "info": {
                            "totalQty": "#datatableWithPaginationInfoTotalQty"
                        },
                        "search": "#datatableSearch",
                        "entries": "#datatableEntries",
                        "pageLength": 10,
                        "isResponsive": false,
                        "isShowPaging": false,
                        "pagination": "datatablePagination"
                        }'>
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="table-column-pe-0">
                                   #
                                </th>
                                <th>Ảnh</th>
                                <th>Tiêu đề</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($posts as $index => $post)
                                <tr>
                                    <td class="table-column-pe-0">{{ ++$index }}</td>
                                    <td class="table-column-ps-0 text-center">
                                        <a class="d-flex align-items-center justify-content-center" href="#">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm">
                                                    <img class="avatar-img ratio ratio-1x1" src="{{ $post->image_url }}"
                                                        alt="Image Description">
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-truncate text-wrap">
                                        {{ $post->title }} <br>
                                        @if($post->is_hot == 1)
                                            <span class="text-danger px-1 py-1" style="font-size: 12px; border:1px solid red">Nổi bật</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($post->status == 1) 
                                            <span class="legend-indicator bg-success"></span>Hiển thị
                                        @else
                                            <span class="legend-indicator bg-danger"></span>Ẩn
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="text-primary me-2" data-bs-toggle="tooltip" title="Cập nhật">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="" class="text-danger" data-bs-toggle="tooltip" title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                    <!-- Pagination -->
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                <span class="me-2">Hiển thị:</span>

                                <!-- Select -->
                                <div class="tom-select-custom">
                                    <select id="datatableEntries"
                                        class="js-select form-select form-select-borderless w-auto" autocomplete="off"
                                        data-hs-tom-select-options='{
                                        "searchInDropdown": false,
                                        "hideSearch": true
                                    }'>
                                        <option value="1" selected>1 bản ghi</option>
                                        <option value="6">6 bản ghi</option>
                                        <option value="8" >8 bản ghi</option>
                                        <option value="12">12 bản ghi</option>
                                    </select>
                                </div>
                                <!-- End Select -->

                                <span class="text-secondary me-2">của</span>

                                <!-- Pagination Quantity -->
                                <span id="datatableWithPaginationInfoTotalQty"></span>
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="col-sm-auto">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <!-- Pagination -->
                                <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                            </div>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Pagination -->
                </div>
                <!-- End Footer -->
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->

        <!-- Footer -->

        <div class="footer">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <p class="fs-6 mb-0">&copy; WorkWise <span class="d-none d-sm-inline-block">2023
                            DNDev.</span></p>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>

        <!-- End Footer -->
    </main>
@endsection