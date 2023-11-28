<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Checkout')

    @section('style-libraries')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    @stop
</head>

<body>
    @extends('layout')
    @section('content')
    <div class="container mt-3">
        <h1 class="h2 mb-5 text-center">Xác nhận & Thanh toán</h1>
        <div class="row">
            <!-- Left -->
            {{-- <div class="col-lg-9">
              <div class="mb-3"> --}}
            <div class="col-md-7 col-12">
                <div class="card">
                    <h4 class="card-header">Khách hàng</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-2">
                                    <span class="col-4">Họ tên:</span>
                                    <div class="col-8"><b>{{ $order->user->name }}</b></div>
                                </div>

                                <div class="row mb-2">
                                    <span class="col-4">Email:</span>
                                    <div class="col-8"><b>{{ $order->user->email }}</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div>
          </div> --}}
            <!-- Right -->
            {{-- <div class="col-lg-3">
            <div class="card position-sticky top-0">
              <div class="p-3 bg-light bg-opacity-10">
                <h6 class="card-title mb-3">Order Summary</h6>
                <div class="d-flex justify-content-between mb-1 small">
                  <span>Subtotal</span> <span>$214.50</span>
                </div>
                <div class="d-flex justify-content-between mb-1 small">
                  <span>Shipping</span> <span>$20.00</span>
                </div>
                <div class="d-flex justify-content-between mb-1 small">
                  <span>Coupon (Code: NEWYEAR)</span> <span class="text-danger">-$10.00</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4 small">
                  <span>TOTAL</span> <strong class="text-dark">$224.50</strong>
                </div>
                <div class="form-check mb-1 small">
                  <input class="form-check-input" type="checkbox" value="" id="tnc">
                  <label class="form-check-label" for="tnc">
                    I agree to the <a href="#">terms and conditions</a>
                  </label>
                </div>
                <div class="form-check mb-3 small">
                  <input class="form-check-input" type="checkbox" value="" id="subscribe">
                  <label class="form-check-label" for="subscribe">
                    Get emails about product updates and events. If you change your mind, you can unsubscribe at any time. <a href="#">Privacy Policy</a>
                  </label>
                </div>
                <button class="btn btn-primary w-100 mt-2">Place order</button>
              </div>
            </div>
          </div> --}}
            <div class="col-md-5 col-12">
                <div class="card">
                    <h4 class="card-header">Thanh toán</h4>
                    <div class="card-body">
                        <div class="row">
                            <span class="col-3">Vé:</span>
                            <div class="col-9 text-end"><b>{{ $order->sellticket->ticket->name }}</b></div>
                        </div>
                        <hr>

                        <div class="row">
                            <label class="col-6"><span class="inblock float-end">x{{ $order->quantity }}</span></label>
                            <div class="col-6 text-end"><b>{{ number_format($order->total) }}đ</b></div>
                        </div>

                        <hr>

                        <div class="row" style="align-items: center">
                            <span class="col-6"><b>Tổng thanh toán</b></span>
                            <div class="col-6 text-end fs-3 fw-bolder text-danger">{{ number_format($order->total) }}đ</div>
                        </div>
                        <hr>

                        <div class="row wrap-payment-methods">
                            <div class="col-12">
                                <p><b>Phương thức thanh toán</b></p>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" value="VNPAY"
                                        id="input-qrcode">
                                    <label class="form-check-label" for="input-qrcode">Ví điện tử <i>(VNPay)</i></label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 d-grid">
                                <button id="payment" class="btn btn-danger"><b>Thanh toán</b></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script>
        $("#payment").on('click', function() {
            const vnpay = $("#input-qrcode:checked").val();
            var urlParams = window.location.href.split('/');
            if (vnpay) {
                $(document).on('ajaxStart', function() {
                        $("#payment").attr('disabled', true);
                        $("#payment").empty();
                        $("#payment").append(
                            `<div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>`
                        );
                    });

                    $(document).on('ajaxComplete', function() {
                        $("#payment").attr('disabled', false);
                        $("#payment").empty();
                        $("#payment").append(
                            `<b>Thanh toán</b>`
                        );
                    })

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: `/user/checkout/${urlParams[urlParams.length - 1]}`,
                    type: "POST",
                    data: {
                        token: urlParams[urlParams.length - 1]
                    },
                    dataType: "json",
                    success: function(res) {
                        window.location.href = res.url;
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status === 422){
                            toastr.warning('Số lượng vé không đủ!');
                        }
                    }
                })
            } else {
                toastr.info("Vui lòng chọn phương thức thanh toán");
            }
        });
    </script>
@stop
</body>

</html>
