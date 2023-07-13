@extends('admin.layouts.master')

@section('main-content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-header-title">Dashboard</h1>
                    </div>
                    <!-- End Col -->

                    <div class="col-auto">
                        <a class="btn btn-primary" href="javascript:;" data-bs-toggle="modal"
                            data-bs-target="#inviteUserModal">
                            <i class="bi-person-plus-fill me-1"></i> Invite users
                        </a>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->

            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Total Users</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">72,540</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options='{
                          "type": "line",
                          "data": {
                             "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                             "datasets": [{
                              "data": [21,20,24,20,18,17,15,17,18,30,31,30,30,35,25,35,35,40,60,90,90,90,85,70,75,70,30,30,30,50,72],
                              "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                              "borderColor": "#377dff",
                              "borderWidth": 2,
                              "pointRadius": 0,
                              "pointHoverRadius": 0
                            }]
                          },
                          "options": {
                             "scales": {
                               "y": {
                                 "display": false
                               },
                               "x": {
                                 "display": false
                               }
                             },
                            "hover": {
                              "mode": "nearest",
                              "intersect": false
                            },
                            "plugins": {
                              "tooltip": {
                                "postfix": "k",
                                "hasIndicator": true,
                                "intersect": false
                              }
                            }
                          }
                        }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <span class="badge bg-soft-success text-success">
                                <i class="bi-graph-up"></i> 12.5%
                            </span>
                            <span class="text-body fs-6 ms-1">from 70,104</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Sessions</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">29.4%</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options='{
                          "type": "line",
                          "data": {
                             "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                             "datasets": [{
                              "data": [21,20,24,20,18,17,15,17,30,30,35,25,18,30,31,35,35,90,90,90,85,100,120,120,120,100,90,75,75,75,90],
                              "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                              "borderColor": "#377dff",
                              "borderWidth": 2,
                              "pointRadius": 0,
                              "pointHoverRadius": 0
                            }]
                          },
                          "options": {
                             "scales": {
                               "y": {
                                 "display": false
                               },
                               "x": {
                                 "display": false
                               }
                             },
                            "hover": {
                              "mode": "nearest",
                              "intersect": false
                            },
                            "plugins": {
                              "tooltip": {
                                "postfix": "k",
                                "hasIndicator": true,
                                "intersect": false
                              }
                            }
                          }
                        }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <span class="badge bg-soft-success text-success">
                                <i class="bi-graph-up"></i> 1.7%
                            </span>
                            <span class="text-body fs-6 ms-1">from 29.1%</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Avg. Click Rate</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">56.8%</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options='{
                          "type": "line",
                          "data": {
                             "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                             "datasets": [{
                              "data": [25,18,30,31,35,35,60,60,60,75,21,20,24,20,18,17,15,17,30,120,120,120,100,90,75,90,90,90,75,70,60],
                              "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                              "borderColor": "#377dff",
                              "borderWidth": 2,
                              "pointRadius": 0,
                              "pointHoverRadius": 0
                            }]
                          },
                          "options": {
                             "scales": {
                               "y": {
                                 "display": false
                               },
                               "x": {
                                 "display": false
                               }
                             },
                            "hover": {
                              "mode": "nearest",
                              "intersect": false
                            },
                            "plugins": {
                              "tooltip": {
                                "postfix": "k",
                                "hasIndicator": true,
                                "intersect": false
                              }
                            }
                          }
                        }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <span class="badge bg-soft-danger text-danger">
                                <i class="bi-graph-down"></i> 4.4%
                            </span>
                            <span class="text-body fs-6 ms-1">from 61.2%</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Pageviews</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">92,913</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart"
                                            data-hs-chartjs-options='{
                          "type": "line",
                          "data": {
                             "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                             "datasets": [{
                              "data": [21,20,24,15,17,30,30,35,35,35,40,60,12,90,90,85,70,75,43,75,90,22,120,120,90,85,100,92,92,92,92],
                              "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                              "borderColor": "#377dff",
                              "borderWidth": 2,
                              "pointRadius": 0,
                              "pointHoverRadius": 0
                            }]
                          },
                          "options": {
                             "scales": {
                               "y": {
                                 "display": false
                               },
                               "x": {
                                 "display": false
                               }
                             },
                            "hover": {
                              "mode": "nearest",
                              "intersect": false
                            },
                            "plugins": {
                              "tooltip": {
                                "postfix": "k",
                                "hasIndicator": true,
                                "intersect": false
                              }
                            }
                          }
                        }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <span class="badge bg-soft-secondary text-body">0.0%</span>
                            <span class="text-body fs-6 ms-1">from 2,913</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>
            </div>
            <!-- End Stats -->

            <!-- Card -->
            <div class="card mb-3 mb-lg-5">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-md">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header-title">Users</h4>

                                <!-- Datatable Info -->
                                <div id="datatableCounterInfo" style="display: none;">
                                    <div class="d-flex align-items-center">
                                        <span class="fs-6 me-3">
                                            <span id="datatableCounter">0</span>
                                            Selected
                                        </span>
                                        <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                                            <i class="tio-delete-outlined"></i> Delete
                                        </a>
                                    </div>
                                </div>
                                <!-- End Datatable Info -->
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="col-auto">
                            <!-- Filter -->
                            <div class="row align-items-sm-center">
                                <div class="col-sm-auto">
                                    <div class="row align-items-center gx-0">
                                        <div class="col">
                                            <span class="text-secondary me-2">Trạng thái:</span>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-end">
                                                <select
                                                    class="js-select js-datatable-filter form-select form-select-sm form-select-borderless"
                                                    data-target-column-index="2" data-target-table="datatable"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                                    "searchInDropdown": false,
                                                    "hideSearch": true,
                                                    "dropdownWidth": "10rem"
                                                }'>
                                                    <option value="null" selected>All</option>
                                                    <option value="successful">Successful</option>
                                                    <option value="overdue">Overdue</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <!-- End Col -->

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
                            "targets": [0, 1, 4],
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
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="datatableCheckAll">
                                        <label class="form-check-label" for="datatableCheckAll"></label>
                                    </div>
                                </th>
                                <th class="table-column-ps-0">@lang('full_name')</th>
                                <th>@lang('type_login')</th>
                                <th>@lang('email')</th>
                                <th>@lang('status')</th>
                                <th>@lang('created_at')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="table-column-pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="usersDataCheck{{$user->id}}">
                                            <label class="form-check-label" for="usersDataCheck2"></label>
                                        </div>
                                    </td>
                                    <td class="table-column-ps-0">
                                        <a class="d-flex align-items-center" href="user-profile.html">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm avatar-circle">
                                                    <img class="avatar-img" src="/admins/assets/img/160x160/img10.jpg"
                                                        alt="Image Description">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="text-inherit mb-0">{{ $user->name }} <i
                                                        class="bi-patch-check-fill text-primary" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Top endorsed"></i></h5>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($user->type_login == "google")
                                            <i class="bi bi-google"></i>
                                        @elseif ($user->type_login == "facebook")
                                            <i class="bi bi-facebook"></i>
                                        @else
                                            <i class="bi bi-eyeglasses"></i>
                                        @endif
                                        
                                        {{ $user->type_login }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="legend-indicator bg-success"></span>Successful
                                    </td>
                                    <td>{{ date('h:s', strtotime($user->created_at)) }} | {{ date('d-m-Y', strtotime($user->created_at)) }}</td>
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
                    <p class="fs-6 mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2022
                            Htmlstream.</span></p>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        <!-- List Separator -->
                        <ul class="list-inline list-separator">
                            <li class="list-inline-item">
                                <a class="list-separator-link" href="#">FAQ</a>
                            </li>

                            <li class="list-inline-item">
                                <a class="list-separator-link" href="#">License</a>
                            </li>

                            <li class="list-inline-item">
                                <!-- Keyboard Shortcuts Toggle -->
                                <button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle"
                                    type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasKeyboardShortcuts"
                                    aria-controls="offcanvasKeyboardShortcuts">
                                    <i class="bi-command"></i>
                                </button>
                                <!-- End Keyboard Shortcuts Toggle -->
                            </li>
                        </ul>
                        <!-- End List Separator -->
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>

        <!-- End Footer -->
    </main>
@endsection