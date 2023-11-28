@extends('layout')

@section('style-libraries')
    <link rel="stylesheet" href="{{ asset('almasaeed2010/adminlte/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('almasaeed2010/adminlte/dist/css/adminlte.min.css') }}"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
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
                                Yêu cầu rút tiền
                            </h4>

                            <div class="card-body">
                                @if (Auth::user()->amount < 100000)
                                    <div class="text-center">
                                        <h3>Số dư không đủ</h3>
                                        <div>Số dư thực: <b class="red">0đ</b>. Bạn cần tối thiểu <b
                                                class="red">100,000đ</b> để thực hiện rút tiền.</div>
                                        <a class="btn btn-primary mt-3" href="/user/withdraw">Quay lại</a>
                                    </div>
                                @else
                                    <div class="bs-stepper">
                                        <div class="bs-stepper-header" role="tablist">
                                            <!-- your steps here -->
                                            <div class="step" data-target="#logins-part">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="logins-part" id="logins-part-trigger">
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">Information</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#information-part">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="information-part" id="information-part-trigger">
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Various information</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#completes-part">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="completes-part" id="completes-part-trigger">
                                                    <span class="bs-stepper-circle">3</span>
                                                    <span class="bs-stepper-label">Complete</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="bs-stepper-content">
                                                <!-- your steps content here -->
                                                <div id="logins-part" class="content" role="tabpanel"
                                                    aria-labelledby="logins-part-trigger">
                                                    <form id="form_create"> 
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Họ tên</label>
                                                        <input type="text" class="form-control" id="username" name="username"
                                                            placeholder="Username" value="{{ Auth::user()->name }}">
                                                        <div class="form-text">Username must match the bank card.</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="sdt" class="form-label">Số điện thoại</label>
                                                        <input type="number" class="form-control" id="sdt" name="sdt"
                                                            placeholder="0123456789">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="cccd" class="form-label">Số CCCD</label>
                                                        <input type="number" class="form-control" id="cccd" name="cccd"
                                                            placeholder="CCCD">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image_front" class="form-label">Mặt trước cccd</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" id="image_front" name="image_front">
                                                            <label class="input-group-text"
                                                                for="image_front">Upload</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image_behind" class="form-label">Mặt sau cccd</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" id="image_behind" name="image_behind">
                                                            <label class="input-group-text"
                                                                for="image_behind">Upload</label>
                                                        </div>
                                                    </div>
                                                    </form>
                                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                                </div>
                                                <div id="information-part" class="content" role="tabpanel"
                                                    aria-labelledby="information-part-trigger">
                                                    <div class="mb-3">
                                                        <label for="stk" class="form-label">STK</label>
                                                        <input type="number" class="form-control" id="stk"
                                                            placeholder="STK">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="bank" class="form-label">Bank</label>
                                                        <input type="text" class="form-control" id="bank"
                                                            placeholder="Bank">
                                                    </div>
                                                    <button class="btn btn-primary"
                                                        onclick="stepper.previous()">Previous</button>
                                                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                                                </div>
                                                <div id="completes-part" class="content" role="tabpanel"
                                                    aria-labelledby="completes-part-trigger">
                                                    <div class="mb-3">
                                                        <label for="money" class="form-label">Số tiền</label>
                                                        <input type="number" class="form-control" id="money"
                                                            placeholder="100000">
                                                    </div>
                                                    <button class="btn btn-primary"
                                                        onclick="stepper.previous()">Previous</button>
                                                    <button type="button" id="submit_infor"
                                                        class="btn btn-primary">Submit</button>
                                                </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <!-- BS-Stepper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mdi/font@7.3.67/scripts/verify.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        $("#submit_infor").on('click', function() {
            if ($("#username").val().trim().length === 0 || $("#cccd").val().trim().length === 0 || $("#stk").val()
                .trim().length === 0 ||
                $("#bank").val().trim().length === 0 || $("#money").val().trim().length ===
                0 || $("#image_front")[0].files.length === 0 || $("#image_behind")[0].files.length === 0 || $("#sdt").val().trim().length === 0) {
                toastr.warning('Vui lòng nhập các field');
            } else if (Number($("#money").val().trim()) < 100000) {
                toastr.warning('Số tiền không được nhỏ hơn 100.000đ');
            } else {
                $(document).on('ajaxStart', function() {
                    $("#submit_infor").attr('disabled', true);
                    $("#submit_infor").empty();
                    $("#submit_infor").append(
                        `<div class="spinner-border text-info" role="status">
                        </div>`
                    );
                });

                $(document).on('ajaxStop', function() {
                    $("#submit_infor").attr('disabled', false);
                    $("#submit_infor").empty();
                    $("#submit_infor").append(
                        `Submit`
                    );
                })

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = new FormData($('#form_create')[0]);
                formData.append('stk',$("#stk").val());
                formData.append('bank',$("#bank").val());
                formData.append('money',$("#money").val().trim());
                $.ajax({
                    url: "/user/withdraw/create",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        toastr.success('Yêu cầu rút tiền thành công');
                        window.location.href = "/user/withdraw";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        if (jqXHR.status === 400) {
                            toastr.warning("Số dư không đủ!");
                        } else {
                            toastr.error("Error");
                        }
                    }
                });
            }
        });
    </script>
@stop
