<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Detail Ticket')

    @section('style-libraries')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    @stop
</head>

<body>
    @extends('layout')

    @section('content')
        <div class="container mt-2 me-5">
            <div class="row">
                <div class="col" style="width: 800px;">
                    <div class="col">
                        <img src="{{ $ticket->ticket->image }}" style="height: 400px; width: 800px;">
                        <div class="mt-5">
                            {{ $ticket->ticket->description }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card ms-5" style="width: 300px;">
                        <div class="card-body ms-2">
                            <p>Price: {{ number_format($ticket->price) }}đ</p>
                            <p>Number: {{ $ticket->quantity - $ticket->sold }}</p>
                            <div class="form-outline">
                                <input type="number" min="1" max="{{ $ticket->quantity - $ticket->sold }}" id="number" class="form-control"
                                    placeholder="0" />
                            </div>

                            @if(Auth::check())
                            <button @if ($ticket->quantity - $ticket->sold === 0 || Auth::user()->id === $ticket->seller_id) disabled @endif id="order_button" type="button"
                                class="btn btn-info mt-2 form-control">Buy</button>
                            @else
                            <button disabled type="button"
                                class="btn btn-info mt-2 form-control">Buy</button>
                            @endif
                        </div>
                    </div>

                    @if ($ticket->seller_id)
                        <a href="/?name={{ $ticket->seller->link }}" style="text-decoration-line: none">
                            <div class="card ms-5 mt-5" style="width: 300px;">
                                <img src="{{ $ticket->seller->image }}" class="rounded-circle m-auto mt-2"
                                    style="width:120px; height:120px; object-fit:cover" />
                                <div class="card-body mt-3 text-center">
                                    <p class="fs-5">{{ $ticket->seller->name }}</p>
                                    {{-- @auth
                                    <p>{{ $ticket->seller->email }}</p>
                                    @endauth --}}
                                    
                                    <p class="text-secondary">Seller</p>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @stop

    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
        <script>
            $("#order_button").on('click', function() {
                const quantity = $("#number").val();
                const max = $("#number").attr('max');
                var urlParams = window.location.href.split('/');
                if(Number(quantity) > Number(max)){
                    toastr.error('Số lượng không đủ');
                    return;
                }

                if (quantity > 0) {
                    $(document).on('ajaxStart', function() {
                        $("#number").attr('disabled', true);
                        $("#order_button").empty();
                        $("#order_button").append(
                            `<div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>`
                        );
                    });

                    $(document).on('ajaxComplete', function() {
                        $("#number").attr('disabled', false);
                        $("#order_button").attr('disabled', false);
                        $("#order_button").empty();
                        $("#order_button").append(
                            `Buy`
                        );
                    })

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "/user/order",
                        dataType: 'json',
                        data: {
                            quantity: quantity,
                            slug: urlParams[urlParams.length - 1]
                        },
                        success: function(res) {
                            window.location.href = `/user/checkout/${res.token}`
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status === 422) {
                                toastr.error('Hết hàng');
                            } else if (jqXHR.status === 400) {
                                toastr.error('Số lượng không đủ');
                            } else {
                                toastr.error('Error');
                            }
                        }
                    })
                } else {
                    toastr.info("Vui lòng chọn số lượng vé.");
                }
            });
        </script>
    @stop
</body>

</html>
