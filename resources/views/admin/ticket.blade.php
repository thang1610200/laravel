<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Management Ticket')

    @section('style-libraries')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

    @stop
</head>

<body>
    @extends('admin.layout')

    @section('content')
        <div class="container mt-5">
            <h4 class="mb-3">Management Ticket</h4>
            <div class="row">
                <div class="col-12" style="overflow-x: scroll;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Seller</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price (VNĐ)</th>
                                {{-- <th scope="col">Sold</th> --}}
                                <th scope="col">Description</th>
                                {{-- <th scope="col">isSell</th> --}}
                                <th scope="col">Create date</th>
                                <th scope="col" style="width: 150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $ticket->count(); $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    {{-- <td>{{ $ticket[$i]->seller->email }}</td> --}}
                                    <td>{{ $ticket[$i]->seller->name }} ({{ $ticket[$i]->seller->role }})</td>
                                    <td>{{ $ticket[$i]->name }}</td>
                                    <td>{{ $ticket[$i]->quantity }}</td>
                                    <td>{{ number_format($ticket[$i]->price) }}</td>
                                    {{-- <td>{{ $ticket[$i]->sold }}</td> --}}
                                    <td>{{ $ticket[$i]->description }}</td>
                                    {{-- <td>{{ !empty($ticket[$i]->commission->name) ? $ticket[$i]->commission->name: "" }}</td> --}}
                                    <td>{{ $ticket[$i]->created_at }}</td>
                                    <td>
                                        <button @if ($ticket[$i]->isBrowse) disabled @endif
                                            ticket_id="{{ $ticket[$i]->id }}" type="button"
                                            class="btn btn-success sell-ticket" data-bs-toggle="modal"
                                            data-bs-target="#modal-form"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal Form -->
        <div class="modal fade" id="modal-form" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Login Form -->
                    <form action="">
                        <div class="modal-header">
                            <h5 class="modal-title">Đăng bán vé</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="hidden" id="ticket_id">
                                        <input disabled type="text" class="form-control" id="name" name="name"
                                            placeholder="Name">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label" for="commission">Commission</label>
                                        <select id='commission' name='commission' class="form-select">
                                            @foreach ($commission as $data)
                                                <option value="{{ $data->name }}">{{ $data->cost }}%</option>
                                            @endforeach
                                        </select>
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
    @stop

    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
        <script>
            $(".sell-ticket").on('click', function() {
                $.ajax({
                    url: "/admin/get-ticket",
                    type: "GET",
                    dataType: 'json',
                    data: {
                        ticket_id: $(this).attr('ticket_id')
                    },
                    success: function(res) {
                        $("#ticket_id").val(res.data.id);
                        $("#name").val(res.data.name);
                    }
                })
            });

            $("#update-com").on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
                    url: "/admin/ticket",
                    type: "POST",
                    dataType: "json",
                    data: {
                        ticket_id: $("#ticket_id").val(),
                        commission: $("#commission").val()
                    },
                    success: function(res) {
                        $(".sell-ticket").attr('disabled', 'disabled');
                        $("#ModalForm").modal('hide');
                        toastr.success('Cập nhật phí hoa hồng thành công');
                    },
                    error: function() {
                        toastr.error('Error');
                    }
                })
            });
        </script>
    @stop
</body>

</html>
