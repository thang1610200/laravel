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
                        <h1>Management Ticket</h1>
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

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ticket Purchased</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total tickets
                                                purchased</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $user->order->sum('quantity') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total amount spent</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ number_format($user->order->sum('total')) }}
                                                (VNĐ)</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Estimated project
                                                duration</span>
                                            <span class="info-box-number text-center text-muted mb-0">20</span>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="post">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Ticket Purchased</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="example1" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Ticket</th>
                                                            <th>Price (VNĐ)</th>
                                                            <th style="width: 40px">Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0; $i < $user->order->count(); $i++)
                                                            <tr>
                                                                <td>{{ $i + 1 }}.</td>
                                                                <td>{{ $user->order[$i]->sellticket->ticket->name }}</td>
                                                                <td>
                                                                    <div style="width: 55%">
                                                                        {{ number_format($user->order[$i]->sellticket->ticket->price) }}
                                                                    </div>
                                                                </td>
                                                                <td>{{ $user->order[$i]->quantity }}</td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                            {{-- <div class="card-footer clearfix">
                                                <ul class="pagination pagination-sm m-0 float-right">
                                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Information</h3>
                            <div class="text-muted mt-3">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ticket Sold</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total tickets
                                                sold</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $user->sellticket->sum('quantity') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total ticket sales amount</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ number_format($user->amount) }}
                                                (VNĐ)</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-center text-muted">Estimated project
                                                            duration</span>
                                                        <span class="info-box-number text-center text-muted mb-0">20</span>
                                                    </div>
                                                </div>
                                            </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="post">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Ticket Sold</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="example2" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Ticket</th>
                                                            <th>Price (VNĐ)</th>
                                                            <th>Quantity</th>
                                                            <th>Sold</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0; $i < $user->sellticket->count(); $i++)
                                                            <tr>
                                                                <td>{{ $i + 1 }}.</td>
                                                                <td>{{ $user->sellticket[$i]->ticket->name }}</td>
                                                                <td>
                                                                    <div style="width: 55%">
                                                                        {{ number_format($user->sellticket[$i]->ticket->price) }}
                                                                    </div>
                                                                </td>
                                                                <td>{{ $user->sellticket[$i]->quantity }}</td>
                                                                <td>{{ $user->sellticket[$i]->sold }}</td>
                                                                <td>
                                                                @if ($user->sellticket[$i]->quantity - $user->sellticket[$i]->sold > 0)
                                                                    @if ($user->sellticket[$i]->isSell === 1)
                                                                        <span class="badge rounded-pill bg-success">On Sale</span>
                                                                    @else
                                                                        <span class="badge rounded-pill bg-primary">Hidden</span>
                                                                    @endif
                                                                @else
                                                                    <span class="badge rounded-pill bg-danger">Out of stock</span>
                                                                @endif
                                                                </td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                            {{-- <div class="card-footer clearfix">
                                                <ul class="pagination pagination-sm m-0 float-right">
                                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Information</h3>
                            <div class="text-muted mt-3">
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
                                    </div>
                                </div>
                            </div>
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
    <script>
        $(function() {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
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
    </script>
@stop