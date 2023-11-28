<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light px-0 py-3" style="background-color: #e3f2fd;">
        <div class="container-xl">
            <a class="navbar-brand" href="/">
                <img src="https://irace.vn/wp-content/uploads/2020/08/irace-logo-500-180-300x99.png"
                    style="width: 10rem;" class="h-6 w-6" alt="image">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mx-auto" id="navbarCollapse">
                <div class="navbar-nav mx-lg-auto">
                    {{-- <a class="nav-item nav-link active" href="/" aria-current="page">Home</a>
                <a class="nav-item nav-link" href="#">Buy</a>
                <a class="nav-item nav-link" href="#">Sell</a> --}}
                    <div class="input-group" style="width: 450px">
                        <input id="search" type="search" class="form-control" placeholder="Search this ticket">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-2" style="top: 60px; position: absolute; width: 410px; max-height: 200px;">
                        <ul class="list-group" id="search-results">
                        </ul>
                    </div>
                </div>
                <div class="navbar-nav gap-4 me-3">
                    {{-- <a href="#" class="nav-item nav-link"><i class="fa-regular fa-bell fa-xl"></i></a>
                    <a href="#" class="nav-item nav-link"><i class="fa-regular fa-comment-dots fa-xl"></i></a> --}}
                </div>
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            @auth
                                @if (Auth::user()->role === 'user')
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ Auth::user()->image }}" width="40" height="40"
                                            class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="/user/management-ticket">Management Order</a>
                                        <a class="dropdown-item" href="/user/management-sell-ticket">Management Sell
                                            Ticket</a>
                                        <a class="dropdown-item" href="/user/withdraw">Withdraw</a>
                                        <a class="dropdown-item" href="/logout">Log Out</a>
                                        <p class="dropdown-item"><span class="fw-bold">Balance:</span>
                                            {{ number_format(Auth::user()->amount) }} (VNĐ)</p>
                                    </div>
                                @else
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="https://static.thenounproject.com/png/4038155-200.png" width="40"
                                            height="40" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="/auth/login">Sign in</a>
                                        <a class="dropdown-item" href="/auth/register">Sign up</a>
                                    </div>
                                @endif
                            @endauth
                            @guest
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="https://static.thenounproject.com/png/4038155-200.png" width="40"
                                        height="40" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="/auth/login">Sign in</a>
                                    <a class="dropdown-item" href="/auth/register">Sign up</a>
                                </div>
                            @endguest
                        </li>
                    </ul>
                </div>
                {{-- @guest
            <div class="navbar-nav ms-lg-4">
                <a class="nav-item nav-link" href="/auth/login">Sign in</a>
            </div>
            <div class="d-flex align-items-lg-center mt-3 mt-lg-0 ms-3">
                <a href="/auth/register" class="btn btn-sm btn-primary w-full w-lg-auto rounded-3">
                  Register
                </a>
            </div>
            @endguest --}}
                <div class="navbar-nav">
                    <a href="/user/create-ticket" class="btn btn-primary"><i
                            class="fa-regular fa-pen-to-square"></i>&nbsp; Đăng bán</a>
                </div>
            </div>
        </div>
    </nav>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var ajax_inprocess = false;
        $("#search").on('focusout', function() {
            setTimeout(function() {
                $("#search-results").empty();
            }, 150);
        });

        $("#search").on('input', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if ($(this).val().trim() !== "") {
                $request = $.ajax({
                    type: "GET",
                    url: "/search-ticket",
                    dataType: 'json',
                    data: {
                        slug: $(this).val().trim()
                    },
                    beforeSend: function() {
                        if (ajax_inprocess === true) {
                            $request.abort();
                        }
                        ajax_inprocess = true;
                    },
                    success: function(res) {
                        $("#search-results").empty();
                        res.ticket.forEach(function(data) {
                            $("#search-results").append(
                                `<a href='http://localhost:3000/ticket/${data.slug}' class="list-group-item">${ data.name }</a>`
                            )
                        });
                    }
                });

                //ajaxComplete // chỉ trả về khi ajax thành công

                $(document).on('ajaxStop', function() { /// khi ajax hoàn thành (kể cả thành công và thất bại)
                    ajax_inprocess = false;
                })
            } else {
                $("#search-results").empty();
            }
        });

        $("#withdraw").on('click', function (){
            
        });
    </script>
</body>

</html>
