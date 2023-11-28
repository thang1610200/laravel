@extends('admin-lte.layout')

@section('style-libraries')
    <link rel="stylesheet"
        href="{{ asset('almasaeed2010/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('almasaeed2010/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('almasaeed2010/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
@stop

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Management Ticket</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Management Ticket</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Seller</th>
                                            <th>Ticket</th>
                                            <th>Quantity</th>
                                            <th>Price (VNĐ)</th>
                                            <th>Description</th>
                                            <th>Create date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ticket as $data)
                                            <tr>
                                                <td>{{ $data->seller->name }} ({{ $data->seller->role }})</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->quantity }}</td>
                                                <td>{{ number_format($data->price) }}</td>
                                                <td>{{ $data->description }}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>
                                                    <button @if ($data->isBrowse) disabled @endif
                                                        ticket_id="{{ $data->id }}" type="button"
                                                        class="btn btn-success sell-ticket" data-toggle="modal"
                                                        data-target="#ModalForm"><i class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Seller</th>
                                            <th>Ticket</th>
                                            <th>Quantity</th>
                                            <th>Price (VNĐ)</th>
                                            <th>Description</th>
                                            <th>Create date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- Modal Form -->
            <div class="modal fade" id="ModalForm">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Login Form -->
                        <form action="">
                            <div class="modal-header">
                                <h5 class="modal-title">Đăng bán vé</h5>
                                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="hidden" id="ticket_id">
                                            <input disabled type="text" class="form-control" id="name"
                                                name="name" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label" for="commission">Commission</label>
                                            <select id='commission' name='commission' class="custom-select">
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
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@stop

@section('scripts')
    <script src="{{ asset('almasaeed2010/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

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
