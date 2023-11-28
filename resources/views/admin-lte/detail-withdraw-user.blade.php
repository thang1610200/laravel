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
        <section style="background-color: #eee;">
            <div class="container py-3">
                <div>
                    <div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Full Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $withdraw->user->name }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $withdraw->user->email }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">CCCD</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $withdraw->cccd }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Phone</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $withdraw->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4 mb-md-0">
                                    <div class="card-body">
                                        <p class="mb-4">
                                            Citizen identification card front
                                        </p>
                                        <div class="filtr-item" data-category="1" data-sort="white sample">
                                            <a href="{{ $withdraw->cccd_front }}" data-toggle="lightbox"
                                                data-title="cccd Front">
                                                <img src="{{ $withdraw->cccd_front }}" class="card-img-top mb-2" style="height: 350px; object-fit: contain"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4 mb-md-0">
                                    <div class="card-body">
                                        <p class="mb-4">
                                            Citizen identification card on the back
                                        </p>
                                        <div class="filtr-item" data-category="1" data-sort="white sample">
                                            <a href="{{ $withdraw->cccd_behind }}" data-toggle="lightbox"
                                                data-title="cccd Behind">
                                                <img src="{{ $withdraw->cccd_behind }}" class="card-img-top mb-2" style="height: 350px; object-fit: contain"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
