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
                        <h1>Ticket Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Ticket Detail</li>
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
                    <h3 class="card-title">User Purchased</h3>

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
                                            <span class="info-box-text text-center text-muted">Total users
                                                purchased</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $sell_ticket->order->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total amount users
                                                purchased</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ number_format($sell_ticket->order->sum('total')) }}
                                                (VNĐ)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="post">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Users Purchased</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="example1" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Total (VNĐ)</th>
                                                            <th style="width: 40px">Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0; $i < $sell_ticket->order->count(); $i++)
                                                            <tr>
                                                                <td>{{ $i + 1 }}.</td>
                                                                <td>{{ $sell_ticket->order[$i]->user->name }}</td>
                                                                <td>{{ $sell_ticket->order[$i]->user->email }}</td>
                                                                <td>
                                                                    <div style="width: 55%">
                                                                        {{ number_format($sell_ticket->order[$i]->total) }}
                                                                    </div>
                                                                </td>
                                                                <td>{{ $sell_ticket->order[$i]->quantity }}</td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Total (VNĐ)</th>
                                                            <th style="width: 40px">Quantity</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer clearfix">
                                                <ul class="pagination pagination-sm m-0 float-right">
                                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a>
                                                    </li>
                                                </ul>
                                            </div>
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
                                            <span class="col-4">Ticket:</span>
                                            <div class="col-8"><b>{{ $sell_ticket->ticket->name }}</b></div>
                                        </div>

                                        <div class="row mb-2">
                                            <span class="col-4">Description:</span>
                                            <div class="col-8"><b>{{ $sell_ticket->ticket->description }}</b></div>
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
                    <h3 class="card-title">User Sold</h3>

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
                                            <span class="info-box-text text-center text-muted">Total users
                                                on sale</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $ticket->sellticket->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total amount sold</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ number_format($ticket->sellticket->sum('sold') * $ticket->price) }}
                                                (VNĐ)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="post">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Users Purchased</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="example2" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Price (VNĐ)</th>
                                                            <th>Quantity</th>
                                                            <th>Sold</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0; $i < $ticket->sellticket->count(); $i++)
                                                            <tr>
                                                                <td>{{ $i + 1 }}.</td>
                                                                <td>{{ $ticket->sellticket[$i]->seller->name }}</td>
                                                                <td>{{ $ticket->sellticket[$i]->seller->email }}</td>
                                                                <td>
                                                                    {{ number_format($ticket->sellticket[$i]->price) }}
                                                                </td>
                                                                <td>{{ $ticket->sellticket[$i]->quantity }}</td>
                                                                <td>{{ $ticket->sellticket[$i]->sold }}</td>
                                                                <td> <span
                                                                        class='badge {{ $ticket->sellticket[$i]->isSell === 0 ? 'bg-danger' : 'bg-success' }}'>{{ $ticket->sellticket[$i]->isSell === 0 ? 'Not Approved' : 'Approved' }}</span>
                                                                </td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Price (VNĐ)</th>
                                                            <th>Quantity</th>
                                                            <th>Sold</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </tfoot>
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
                                            <span class="col-4">Ticket:</span>
                                            <div class="col-8"><b>{{ $ticket->name }}</b></div>
                                        </div>

                                        <div class="row mb-2">
                                            <span class="col-4">Description:</span>
                                            <div class="col-8"><b>{{ $ticket->description }}</b></div>
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
