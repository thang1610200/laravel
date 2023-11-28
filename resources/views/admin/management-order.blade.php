<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Management Sell Ticket')

    @section('style-libraries')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stop
</head>

<body>
    @extends('admin.layout')

    @section('content')
        <div class="container mt-5">
            <h4 class="mb-3">Management Order</h4>
            <div class="row">
                <div class="col-12" style="overflow-x: scroll;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">User</th>
                                <th scope="col">Ticket</th>
                                <th scope="col">Commission</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total (VNĐ)</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $order->count(); $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $order[$i]->user->email }}</td>
                                    <td>{{ $order[$i]->sellticket->ticket->name }}</td>
                                    <td>{{ $order[$i]->sellticket->commission->cost }}%</td>
                                    <td>{{ $order[$i]->quantity }}</td>
                                    <td>{{ number_format($order[$i]->total) }}</td>
                                    <td>@if ($order[$i]->deleted_at)
                                        <span class="badge rounded-pill bg-success">Paid</span>

                                        @else

                                        <span class="badge rounded-pill bg-primary">Unpaid</span>
                                    @endif</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @stop
</body>

</html>
