<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Managemet Ticket')

    @section('style-libraries')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.3.67/css/materialdesignicons.min.css" rel="stylesheet">
    @stop
</head>

<body>
    @extends('layout')

    {{-- @section('content')
        <div class="container mt-5">
            <h4 class="mb-3">Management Purchased Ticket</h4>
            <div class="row">
                <div class="col-12" style="overflow-x: scroll;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ticket</th>
                                <th scope="col">Price (VNĐ)</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Sell Quantity</th>
                                <th scope="col">Total (VNĐ)</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width: 150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $ticket->count(); $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $ticket[$i]->sellticket->ticket->name }}</td>
                                    <td>{{ number_format($ticket[$i]->sellticket->price) }}</td>
                                    <td>{{ $ticket[$i]->quantity }}</td>
                                    <td>{{ $ticket[$i]->quantity_sell }}</td>
                                    <td>{{ number_format($ticket[$i]->total) }}</td>
                                    <td>@if ($ticket[$i]->deleted_at)
                                        <span class="badge rounded-pill bg-success">Paid</span>

                                        @else

                                        <span class="badge rounded-pill bg-primary">Unpaid</span>
                                    @endif</td>
                                    <td>
                                        <button ticket_id="{{ $ticket[$i]->ticket_id }}"
                                            @if ($ticket[$i]->quantity === $ticket[$i]->quantity_sell || !$ticket[$i]->deleted_at) disabled @endif type="button"
                                            class="btn btn-success sell-ticket" data-bs-toggle="modal"
                                            data-bs-target="#ModalForm"><i class="fa-solid fa-ticket"></i></button>
                                        <button order_id="{{ $ticket[$i]->token }}" type="button"
                                            class="btn btn-primary order-detail"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal Form -->
        <div class="modal fade" id="ModalForm" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="">
                        <div class="modal-header">
                            <h5 class="modal-title">Đăng bán vé</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="hidden" id="ticket_id">
                                        <input disabled type="text" class="form-control" id="name" name="name"
                                            placeholder="Name">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-8">
                                        <label class="form-label" for="price">Price</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            placeholder="Price">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label" for="quantity">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                            placeholder="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer pt-4">
                            <button type="button" id="update-com" class="btn btn-success mx-auto w-100">Bán</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @stop --}}
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
                                                    <a class="text-dark" href="/user/withdraw"
                                                        style="text-decoration: none">
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

                                <h4 class="card-header text-uppercase">Đơn hàng</h4>

                                <div class="card-body">

                                    <ul class="nav nav-tabs nav-justified bg-light nav-tabs-custom">
                                        <li class="nav-item">
                                            <a href="/user/management-ticket" class="nav-link @if(!Request::query('type')) active @endif">
                                                <span>Đã <br class="d-block d-sm-none"> thanh toán</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/user/management-ticket?type=unpaid" class="nav-link @if(Request::query('type') === "unpaid") active @endif">
                                                <span>Chưa <br class="d-block d-sm-none"> thanh toán</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="table-responsive mt-4">
                                        <table class="table table-nowrap table-hover mb-1">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">Ticket</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Total (VNĐ)</th>
                                                    <th scope="col">Status</th>
                                                    @if(!Request::query('type'))
                                                    <th scope="col" style="width: 150px">Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < $ticket->count(); $i++)
                                                    <tr>
                                                        <th scope="row">{{ $i + 1 }}</th>
                                                        <td><a href="/user/order-detail/?orderId={{ $ticket[$i]->token }}" style="text-decoration: none">{{ $ticket[$i]->sellticket->ticket->name }}</a></td>
                                                        <td>{{ $ticket[$i]->quantity }}</td>
                                                        <td>{{ number_format($ticket[$i]->total) }}</td>
                                                        <td>
                                                            @if ($ticket[$i]->deleted_at)
                                                                <span class="badge rounded-pill bg-success">Paid</span>
                                                            @else
                                                                <span class="badge rounded-pill bg-primary">Unpaid</span>
                                                            @endif
                                                        </td>
                                                        @if(!Request::query('type'))
                                                        <td>
                                                            <button ticket_id="{{ $ticket[$i]->ticket_id }}"
                                                                @if ($ticket[$i]->quantity === $ticket[$i]->quantity_sell || !$ticket[$i]->deleted_at) disabled @endif
                                                                type="button" class="btn btn-success sell-ticket"
                                                                data-bs-toggle="modal" data-bs-target="#ModalForm"><i
                                                                    class="fa-solid fa-ticket"></i></button>
                                                        </td>
                                                        @endif
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@mdi/font@7.3.67/scripts/verify.min.js"></script>
        <script>
            $(".sell-ticket").on('click', function() {
                $.ajax({
                    url: "/user/show-ticket",
                    type: "GET",
                    dataType: 'json',
                    data: {
                        ticket_id: $(this).attr('ticket_id')
                    },
                    success: function(res) {
                        $("#name").val(res.ticket.name);
                        $("#ticket_id").val(res.sellticket.id);
                    }
                });
            });

            $("#update-com").on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "/user/management-ticket",
                    type: "POST",
                    dataType: "json",
                    data: {
                        ticket_id: $("#ticket_id").val(),
                        price: $("#price").val(),
                        quantity: $("#quantity").val()
                    },
                    success: function(res) {
                        window.location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status === 422) {
                            toastr.warning('Số lượng không đủ để bán');
                        } else {
                            toastr.error('Error');
                        }
                    }
                })
            });
        </script>
    @stop
</body>

</html>
