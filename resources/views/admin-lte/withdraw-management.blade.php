@extends('admin-lte.layout')

@section('style-libraries')
    <link rel="stylesheet"
        href="{{ asset('almasaeed2010/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('almasaeed2010/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('almasaeed2010/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Management withdraw</li>
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
                                <h3 class="card-title">Management Withdraw</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            {{-- <th>CCCD</th>
                                            <th>CCCD Front</th>
                                            <th>CCCD Behind</th> --}}
                                            <th>STK</th>
                                            <th>Bank</th>
                                            <th>Total (VNĐ)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraw as $data)
                                            <tr>
                                                <td><a
                                                        href="/admin/detail-withdraw-user/{{ $data->token }}">{{ $data->user->name }}</a>
                                                </td>
                                                {{-- <td>{{ $data->cccd }}</td>
                                                <td class="text-center">
                                                    <div class="filtr-item" data-category="1"
                                                        data-sort="white sample">
                                                        <a href="{{ $data->cccd_front }}" data-toggle="lightbox"
                                                            data-title="cccd Front">
                                                            <img src="{{ $data->cccd_front }}" class="img-fluid mb-2" style="height:50px;
                                                            width:50px;
                                                            object-fit:contain;" />
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="filtr-item" data-category="1"
                                                        data-sort="white sample">
                                                        <a href="{{ $data->cccd_behind }}" data-toggle="lightbox"
                                                            data-title="cccd Behind">
                                                            <img src="{{ $data->cccd_behind }}" class="img-fluid mb-2" style="height:50px;
                                                            width:50px;
                                                            object-fit:contain;" />
                                                        </a>
                                                    </div>
                                                </td> --}}
                                                <td>{{ $data->stk }}</td>
                                                <td>{{ $data->bank }}</td>
                                                <td>{{ number_format($data->total) }}</td>
                                                <td>
                                                    @if ($data->status === 'Success')
                                                        <span class="badge rounded-pill bg-success">Success</span>
                                                    @elseif ($data->status === 'Cancel')
                                                        <span class="badge rounded-pill bg-danger">Cancel</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-primary">Processing</span>
                                                    @endif
                                                </td>
                                                <td><button @if ($data->status !== 'Processing') disabled @endif
                                                        withdraw_id={{ $data->id }} data-toggle="modal"
                                                        data-target="#ModalForm" class="button_check">Check</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            {{-- <th>CCCD</th>
                                            <th>CCCD Front</th>
                                            <th>CCCD Behind</th> --}}
                                            <th>STK</th>
                                            <th>Bank</th>
                                            <th>Total (VNĐ)</th>
                                            <th>Status</th>
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
            <!-- /.container-fluid -->
            <div class="modal fade" id="ModalForm">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Login Form -->
                        <form action="">
                            <div class="modal-header">
                                <h5 class="modal-title">Status</h5>
                                <button type="button" class="btn close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div>
                                            <input id="withdrawId" type="hidden" />
                                            <label class="form-label" for="status">Status</label>
                                            <select id='status' name='status' class="custom-select">
                                                <option value="Success">Success</option>
                                                <option value="Cancel">Cancel</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer pt-4">
                                <button type="button" id="update_status"
                                    class="btn btn-success mx-auto w-100">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
    <script src="{{ asset('almasaeed2010/adminlte/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
    <script src="{{ asset('almasaeed2010/adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
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

        $(".button_check").on('click', function() {
            $("#withdrawId").val($(this).attr('withdraw_id'));
        })

        $("#update_status").on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                url: "/admin/management-withdraw",
                type: "PATCH",
                dataType: "json",
                data: {
                    withdrawId: $("#withdrawId").val(),
                    status: $("#status").find('option:selected').val()
                },
                success: function(res) {
                    window.location.reload();
                    toastr.success('Cập nhật thành công');
                },
                error: function() {
                    toastr.error('Error');
                }
            })
        });

        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
@stop
