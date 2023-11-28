<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Managemet Ticket')

    @section('style-libraries')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
        {{-- @vite('resources/css/app.css') --}}
    @stop
</head>

<body>
    @extends('layout')

    @section('content')
        <div class="container mt-5">
            {{-- <div class="row mb-5">
                <div class="col-md-7 col-12">
                    <div class="card">
                        <h4 class="card-header">Information</h4>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row mb-2">
                                        <span class="col-4">Họ tên:</span>
                                        <div class="col-8"><b>{{ $user->name }}</b></div>
                                    </div>

                                    <div class="row mb-2">
                                        <span class="col-4">Email:</span>
                                        <div class="col-8"><b>{{ $user->email }}</b></div>
                                    </div>

                                    <div class="row mb-2">
                                        <span class="col-4">Số lượng vé đã bán:</span>
                                        <div class="col-8"><b>{{ $ticket->count() }}</b></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-12" style="overflow-x: scroll;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ticket</th>
                                <th scope="col">Price (VNĐ)</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $ticket->count(); $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $ticket[$i]->ticket->name }}</td>
                                    <td>{{ number_format($ticket[$i]->price) }}</td>
                                    <td>{{ $ticket[$i]->quantity - $ticket[$i]->sold }}</td>
                                    <td>
                                        @if ($ticket[$i]->quantity - $ticket[$i]->sold > 0)
                                            <span class="badge rounded-pill bg-primary">Stocking</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Out of stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/ticket/{{ $ticket[$i]->slug }}" class="btn btn-primaryl"><i
                                                class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div> --}}
            <div class="row row-cols-6">
                @foreach ($ticket as $data)
                    <div class="col-xs-12 col-sm-4 d-flex justify-content-center pb-4">
                        <div class="card border-info">
                            <a href="http://localhost:3000/ticket/{{ $data->slug }}">
                                <img class="card-img-top" src="{{ $data->ticket->image }}" style="object-fit: contain" />
                            </a>
                            <div class="card-body">
                                <a href="http://localhost:3000/ticket/{{ $data->slug }}"
                                    style="text-decoration: none; color: black;">
                                    <h5 class="card-title fw-bold">{{ $data->ticket->name }}</h5>
                                </a>
                                <p class="card-text"
                                    style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $data->ticket->description }}</p>
                                <p class="card-text text-danger fw-bold">Price: {{ number_format($data->price, '0', '.', ',') }} (VNĐ)</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @stop
</body>

</html>
