<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Management Sell Ticket')
</head>

<body>
    @extends('layout')

    @section('content')
        <div class="container mt-5">
            <h4 class="mb-3">Management Sell Ticket</h4>
            <div class="row">
                <div class="col-12" style="overflow-x: scroll;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ticket</th>
                                <th scope="col">Price (VNĐ)</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Sold</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width: 150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $ticket->count(); $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $ticket[$i]->ticket->name }}</td>
                                    <td>{{ number_format($ticket[$i]->price) }}</td>
                                    <td>{{ $ticket[$i]->quantity }}</td>
                                    <td>{{ $ticket[$i]->sold }}</td>
                                    <td>{{ $ticket[$i]->isSell === 0 ? 'Ẩn' : 'Hiện' }}</td>
                                    <td><span
                                            class='badge {{ $ticket[$i]->isBrowse === 0 ? 'bg-danger' : 'bg-success' }}'>{{ $ticket[$i]->isBrowse === 0 ? 'Not Approved' : 'Approved' }}</span>
                                    </td>
                                    <td>
                                        <button sellticket_id={{ $ticket[$i]->id }} class="btn btn-primary sellticket">
                                            @if ($ticket[$i]->isSell === 0)
                                                <i class="far fa-eye"></i>
                                            @else
                                                <i class="fa-solid fa-eye-slash"></i>
                                            @endif
                                        </button>
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
                    <!-- Login Form -->
                    <form action="">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal Login Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Username">Username<span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" id="Username"
                                    placeholder="Enter Username">
                            </div>

                            <div class="mb-3">
                                <label for="Password">Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" id="Password"
                                    placeholder="Enter Password">
                            </div>
                            <div class="mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="remember" required>
                                <label class="form-check-label" for="remember">Remember Me</label>
                                <a href="#" class="float-end">Forgot Password</a>
                            </div>
                        </div>
                        <div class="modal-footer pt-4">
                            <button type="button" class="btn btn-success mx-auto w-100">Login</button>
                        </div>
                        <p class="text-center">Not yet account, <a href="#">Signup</a></p>
                    </form>
                </div>
            </div>
        </div>
    @stop

    @section('scripts')
        <script>
            $(".sellticket").on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
                    url: "/admin/sell-ticket",
                    type: "PATCH",
                    dataType: 'json',
                    data: {
                        sellticket_id: $(this).attr('sellticket_id')
                    },
                    success: function(res) {
                        window.location.reload();
                        //toastr.success('Update success!');
                    }
                })
            });
        </script>
    @stop
</body>

</html>
