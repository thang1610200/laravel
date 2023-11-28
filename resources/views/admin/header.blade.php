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
            <a class="navbar-brand" href="/admin">
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
                        <input type="text" class="form-control" placeholder="Search this ticket">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
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
                                @if (Auth::user()->role === 'admin')
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ Auth::user()->image }}" width="40" height="40"
                                            class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="/admin/commission">Commission</a>
                                        <a class="dropdown-item" href="/admin/management-order">Management Order</a>
                                        <a class="dropdown-item" href="/admin/ticket">Management Ticket</a>
                                        <a class="dropdown-item" href="/admin/sell-ticket">Management Sell Ticket</a>
                                        <a class="dropdown-item" href="/admin/logout">Log Out</a>
                                    </div>
                                @else
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="https://static.thenounproject.com/png/4038155-200.png" width="40"
                                            height="40" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="/admin/auth/login">Sign in</a>
                                        <a class="dropdown-item" href="/admin/auth/register">Sign up</a>
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
                                    <a class="dropdown-item" href="/admin/auth/login">Sign in</a>
                                    <a class="dropdown-item" href="/admin/auth/register">Sign up</a>
                                </div>
                            @endguest
                        </li>
                    </ul>
                </div>
                {{-- <div class="ms-2 navbar-nav">
                    <a href="/admin/create-ticket" class="btn btn-primary"><i
                            class="fa-regular fa-pen-to-square"></i>&nbsp; Đăng bán</a>
                </div> --}}
            </div>
        </div>
    </nav>
</body>

</html>
