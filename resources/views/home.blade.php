<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Home')

    @section('style-libraries')
        {{-- @vite('resources/css/app.css') --}}
    @stop
</head>

<body>
    @extends('layout')

    @section('content')
        <div class="container mt-5">
            <div class="row">
                <aside class="col-md-3">
                    <div class="card rounded-0">

                        <article class="list-group">
                            <header class="card-header">
                                <h5 class="card-title">Price range</h5>
                            </header>
                            <div class="collapse show" id="collapse_1">
                                <div class="card-body">
                                    <div class="pb-3">
                                        <div class="input-group">
                                            <input type="range" class="form-range" min="0"
                                                max="{{ $price }}" name="price" id="price">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Min</label>
                                                <input id="min-price" class="form-control" placeholder="$0" value="0"
                                                    type="number">
                                            </div>
                                            <div class="form-group text-right col-md-6">
                                                <label>Max</label>
                                                <input id="max-price" class="form-control" placeholder="$1,0000"
                                                    type="number">
                                            </div>
                                        </div>
                                        <button id="search-price"
                                            class="btn btn-block btn-primary form-control mt-3">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </aside>
                <main class="col-md-9">
                    <header class="border-bottom mb-4 pb-3 row">
                        <p href="#" class="col-6 ps-5 text-black" style="font-size: 20px">Mua vé</p>
                        <!-- <a href="#" class="col d-flex justify-content-end pe-5 text-black-50" style="text-decoration: none;">Xem tất cả</a> -->
                        <div class="col-6 d-flex justify-content-end">
                            <select class="me-2 form-select sort-price" aria-label="Default select example"
                                style="width: 200px;">
                                <option value="all">Tất cả</option>
                                <option value="low">Giá: Thấp đến Cao</option>
                                <option value="high">Giá: Cao đến Thấp</option>
                            </select>
                            {{-- <div class="btn-group">
                                <a href="#" class="btn btn-outline-secondary" data-toggle="tooltip" title=""
                                    data-original-title="List view">
                                    <i class="fa fa-bars"></i></a>
                                <a href="#" class="btn  btn-outline-secondary active" data-toggle="tooltip"
                                    title="" data-original-title="Grid view">
                                    <i class="fa fa-th"></i></a>
                            </div> --}}
                        </div>
                    </header>
                    <div id="ticket-show">
                        @include('ticket-all')
                    </div>

                    @if ($ticket->lastPage() >= 2)
                        <div id="pagination">
                            {{ $ticket->links('pagination', ['ticket' => $ticket]) }}
                        </div>
                    @endif

                </main>
            </div>
        </div>
    @stop

    @section('scripts')
        <script>
            $(document).ready(function() {
                var ajax_inprocess = false;
                //phân trang
                $(document).on('click', '.page-link', function(event) {
                    let searchParams = new URLSearchParams(window.location.search)
                    //event.preventDefault(); 
                    var page = $(this).attr('page').split('page=')[1];
                    var min = searchParams.get('min');
                    var max = searchParams.get('max');
                    var sort = searchParams.get('sort');
                    var query_price = (min && max) ? `&min=${min}&max=${max}` : "";
                    var query_sort = sort ? `&sort=${sort}` : "";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: `/`,
                        type: "GET",
                        data: {
                            page,
                            min,
                            max,
                            sort
                        },
                        success: function(res) {
                            var newurl = window.location.protocol + "//" + window.location.host +
                                window.location.pathname +
                                `?page=${page}${query_price}${query_sort}`;
                            window.history.pushState({
                                path: newurl
                            }, '', newurl);
                            $("#ticket-show").empty();
                            $("#pagination").empty();
                            $("#ticket-show").html(res.html);
                            $("#pagination").html(res.pagination);
                        }
                    })
                });

                $('#price').on("change mousemove", function() {
                    $("#max-price").val($(this).val());
                });

                // min - max
                $("#search-price").on("click", function() {
                    const min = $("#min-price").val();
                    const max = $("#max-price").val();
                    let searchParams = new URLSearchParams(window.location.search)
                    var name = searchParams.get('name');
                    var query_name = name ? `&name=${name}` : "";

                    if (min < max) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $request = $.ajax({
                            type: "GET",
                            url: `/`,
                            data: {
                                min,
                                max,
                                name
                            },
                            dataType: "json",
                            beforeSend: function() {
                                if (ajax_inprocess === true) {
                                    $request.abort();
                                }
                                ajax_inprocess = true;
                            },
                            success: function(res) {
                                var newurl = window.location.protocol + "//" + window.location
                                    .host + window.location.pathname + `?min=${min}&max=${max}${query_name}`;
                                window.history.pushState({
                                    path: newurl
                                }, '', newurl);
                                $("#ticket-show").empty();
                                $("#pagination").empty();

                                $("#ticket-show").html(res.html);
                                $("#pagination").html(res.pagination);
                            }
                        })
                    }
                })

                //thấp đến cao, cao đến thấp
                $(".sort-price").on('change', function() {
                    let searchParams = new URLSearchParams(window.location.search)
                    var min = searchParams.get('min');
                    var max = searchParams.get('max');
                    var name = searchParams.get('name');
                    var query_name = name ? `&name=${name}` : "";
                    var query_price = (min && max) ? `&min=${min}&max=${max}` : "";
                    if ($(this).val() === 'all') {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $request = $.ajax({
                            url: `/`,
                            type: "GET",
                            beforeSend: function() {
                                if (ajax_inprocess === true) {
                                    $request.abort();
                                }
                                ajax_inprocess = true;
                            },
                            success: function(res) {
                                var newurl = window.location.protocol + "//" + window.location
                                    .host + window.location.pathname;
                                window.history.pushState({
                                    path: newurl
                                }, '', newurl);
                                $("#ticket-show").empty();
                                $("#pagination").empty();
                                $("#ticket-show").html(res.html);
                                $("#pagination").html(res.pagination);
                            }
                        })
                    } else if ($(this).val() === 'low') {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: `/`,
                            type: "GET",
                            data: {
                                sort: "low",
                                min,
                                max,
                                name
                            },
                            success: function(res) {
                                var newurl = window.location.protocol + "//" + window.location
                                    .host + window.location.pathname + `?sort=low${query_price}${query_name}`;
                                window.history.pushState({
                                    path: newurl
                                }, '', newurl);
                                $("#ticket-show").empty();
                                $("#pagination").empty();
                                $("#ticket-show").html(res.html);
                                $("#pagination").html(res.pagination);
                            }
                        })
                    } else if ($(this).val() === 'high') {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: `/`,
                            type: "GET",
                            data: {
                                sort: "high",
                                min,
                                max,
                                name
                            },
                            success: function(res) {
                                var newurl = window.location.protocol + "//" + window.location
                                    .host + window.location.pathname + `?sort=high${query_price}${query_name}`;
                                window.history.pushState({
                                    path: newurl
                                }, '', newurl);
                                $("#ticket-show").empty();
                                $("#pagination").empty();
                                $("#ticket-show").html(res.html);
                                $("#pagination").html(res.pagination);
                            }
                        })
                    }
                });

                //name
                $(document).on('click','.filter_name', function() {
                    var name = $(this).attr('seller_link');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $request = $.ajax({
                        url: `/`,
                        type: "GET",
                        data: {
                            name: name
                        },
                        success: function(res) {
                            var newurl = window.location.protocol + "//" + window.location
                                .host + window.location.pathname + `?name=${name}`;
                            window.history.pushState({
                                path: newurl
                            }, '', newurl);
                            $("#ticket-show").empty();
                            $("#pagination").empty();
                            $("#ticket-show").html(res.html);
                            $("#pagination").html(res.pagination);
                        }
                    })
                });

                $(document).on('ajaxStop', function() { /// khi ajax hoàn thành (kể cả thành công và thất bại)
                    ajax_inprocess = false;
                })
            })
        </script>
    @stop
</body>

</html>
