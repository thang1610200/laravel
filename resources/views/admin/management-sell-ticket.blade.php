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

        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    @stop
</head>

<body>
    @extends('admin.layout')

    @section('content')
        <div class="container mt-5">
            <h4 class="mb-3">Management Sell Ticket</h4>
            <div class="row">
                <div class="col-12" style="overflow-x: scroll;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Seller</th>
                                <th scope="col">Ticket</th>
                                <th scope="col">Commission</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price (VNĐ)</th>
                                <th scope="col">Sold</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Create date</th>
                                <th scope="col" style="width: 150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $ticket->count(); $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    {{-- <td>{{ $ticket[$i]->seller->email }}</td> --}}
                                    <td>{{ !empty($ticket[$i]->seller) ? $ticket[$i]->seller->name : '' }}</td>
                                    <td>{{ $ticket[$i]->ticket->name }}</td>
                                    <td>{{ !empty($ticket[$i]->commission) ? $ticket[$i]->commission->cost : '' }}%</td>
                                    <td>{{ $ticket[$i]->quantity }}</td>
                                    <td>{{ number_format($ticket[$i]->price) }}</td>
                                    <td>{{ $ticket[$i]->sold }}</td>
                                    <td>{{ $ticket[$i]->isSell === 0 ? 'Ẩn' : 'Hiện' }}</td>
                                    <td><span
                                        class='badge {{ $ticket[$i]->isBrowse === 0 ? 'bg-danger' : 'bg-success' }}'>{{ $ticket[$i]->isBrowse === 0 ? 'Not Approved' : 'Approved' }}</span>
                                    </td>
                                    <td>{{ $ticket[$i]->created_at }}</td>
                                    <td>
                                        <button sellticket_id={{ $ticket[$i]->id }} class="btn btn-primary sellticket">
                                            @if ($ticket[$i]->isSell === 0)
                                                <i class="far fa-eye"></i>
                                            @else
                                                <i class="fa-solid fa-eye-slash"></i>
                                            @endif
                                        </button>
                                        <button sellticket_id={{ $ticket[$i]->id }} type="button"
                                            class="btn btn-success browse-ticket"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @stop

    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
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

            $(".browse-ticket").on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/admin/browse-ticket',
                    type: 'PATCH',
                    dataType: 'json',
                    data: {
                        sellticket_id: $(this).attr('sellticket_id')
                    },
                    success: function(res) {
                        window.location.reload();
                    }
                })
            })
        </script>
    @stop
</body>

</html>
