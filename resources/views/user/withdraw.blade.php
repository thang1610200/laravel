@extends('layout')

@section('style-libraries')
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.3.67/css/materialdesignicons.min.css" rel="stylesheet">
@stop

@section('content')
    <div>
        <div>
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mb-5">
                            <div class="">
                                <div class="position-relative">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzbmT5f6Uqu-p0tDftdiTuI8u187X2fyvoUXkcKcWz&s"
                                        class="card-img-top" style="height: 120px; width: 100%; object-fit: cover;"
                                        alt="">
                                </div>
                                <!-- end user-profile-img -->

                                <div class="position-relative" style="margin-top: -3rem!important;">
                                    <div class="text-center">
                                        <img src="{{ Auth::user()->image }}" alt=""
                                            class="rounded-circle img-thumbnail"
                                            style="object-fit: cover; width: 6rem; height: 6rem;">

                                        <div class="my-3">
                                            <h5 class="mb-2">{{ Auth::user()->name }}</h5>
                                        </div>
                                        <div class="mt-3 pb-3">
                                            <span class="fw-bold">Số dư: {{ number_format(Auth::user()->amount) }}đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Danh mục</h5>
                                <div>
                                    <ul class="list-unstyled mb-0 text-muted">
                                        <li>
                                            <div class="d-flex align-items-center py-2">
                                                <a class="text-dark" href="/user/management-ticket"
                                                    style="text-decoration: none">
                                                    <i class="mdi mdi-cart font-size-16 me-1"></i> Đơn hàng
                                                </a>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="d-flex align-items-center py-2">
                                                <a class="text-dark" href="/user/withdraw" style="text-decoration: none">
                                                    <i class="mdi mdi-wallet font-size-16 text-dark me-1"></i> Rút tiền
                                                </a>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="card">

                            <h4 class="card-header text-uppercase">
                                Rút tiền
                                <div class="float-end">
                                    <a href="/user/withdraw/create" class="withdraw btn btn-primary"><i
                                            class="fa-solid fa-money-bill"></i> Yêu cầu rút
                                        tiền</a>
                                </div>
                            </h4>

                            <div class="card-body">
                                <div class="table-responsive mt-4">
                                    <table class="table table-nowrap table-hover mb-1">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Thời gian</th>
                                                <th scope="col">Số tiền (VNĐ)</th>
                                                <th scope="col">Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < $withdraw->count(); $i++)
                                            <tr>
                                                <th scope="row">{{ $i + 1 }}</th>
                                                <th>{{ $withdraw[$i]->created_at }}</th>
                                                <th>{{ number_format($withdraw[$i]->total) }}</th>
                                                <th>
                                                    @if ($withdraw[$i]->status === "Success")
                                                        <span class="badge rounded-pill bg-success">Success</span>
                                                    @elseif ($withdraw[$i]->status === "Cancel")
                                                        <span class="badge rounded-pill bg-danger">Cancel</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-primary">Processing</span>
                                                    @endif
                                                </th>
                                            </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@mdi/font@7.3.67/scripts/verify.min.js"></script>
@stop
