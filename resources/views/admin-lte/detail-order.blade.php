@extends('admin-lte.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Management Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Management Order</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                Invoice:
                <strong>{{ $order->token }}</strong>
                <span style="float: right"> <strong>Status:</strong> <span class="badge @if (!$order->deleted_at)
                    bg-primary
                    @else
                    bg-success
                @endif">@if ($order->deleted_at) Success @else Unpaid @endif</span></span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">Seller:</h6>
                        <div>
                            <strong>{{ $order->sellticket->seller->name }}</strong>
                        </div>
                        <div>Email: {{ $order->sellticket->seller->email }}</div>
                    </div>
                    <div class="col-sm-4">
                        <h6 class="mb-3">Buyer:</h6>
                        <div>
                            <strong>{{ $order->user->name }}</strong>
                        </div>
                        <div>Email: {{ $order->user->email }}</div>
                    </div>
                    @if (!$order->deleted_at)
                    <div class="col-sm-2">
                        <a href="/user/checkout/{{ $order->token }}" class="btn btn-info" style="float: right">Payment</a>
                    </div>
                    @endif
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th class="right">Cost</th>
                                <th class="center">Quantity</th>
                                <th class="right">Total (VNĐ)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="center">1</td>
                                <td class="left strong">{{ $order->sellticket->ticket->name }}</td>
                                <td class="right">{{ number_format($order->sellticket->price) }}</td>
                                <td class="center">{{ $order->quantity }}</td>
                                <td class="right">{{ number_format($order->sellticket->price * $order->quantity) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">{{ number_format($order->sellticket->price * $order->quantity) }} (VNĐ)</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>{{ number_format($order->total) }} (VNĐ)</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
@stop