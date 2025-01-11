<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $title ?? config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ URL::to('/') }}/">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#f3047dd9">
    <meta name="msapplication-navbutton-color" content="#f3047dd9">
    @vite('resources/js/app.js')
    @stack('styles')
</head>

<body>
    <div class='container'>
        <div class='row'>
            <div class='col-12'>
                <div class="card">
                    <div class='card-header d-flex'>
                        <span class='fs-2 justify-content-center'>Product Upload Center</span>
                    </div>
                    <div class=" card-body">
                        <form action="{{ $action }}" id="form" method="post" data-bc="created">
                            <div class="row">
                                <div class="col-12 my-1">
                                    <label class='text-dark'>Product Name</label>
                                    <input type="text"
                                        @if ($item) value="{{ $item->product_name }}" @endif
                                        name="product_name" class="form-control" />
                                </div>
                                <div class="col-12 my-1">
                                    <label class='text-dark'>Quantity (in stock)</label>
                                    <input type="text"
                                        @if ($item) value="{{ $item->quantity }}" @else value='1' @endif
                                        name="quantity" class="form-control" />
                                </div>
                                <div class="col-12 my-1">
                                    <label class='text-dark'>Price</label>
                                    <input type="number" step='any'
                                        @if ($item) value="{{ $item->price }}" @endif
                                        name="price" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <input class="btn btn-block btn-dark btn-lg w-100" type="submit"
                                    value="{{ $actionText }}" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class='col-12 mt-3 products hide'>
                <div class="card">
                    <div class=" card-body">
                        <table class="table table-stripped table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Date submitted</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody class="bg-dark text-light">
                            </tbody>
                        </table>

                        <table class="table table-stripped">
                            <thead class="bg-light">
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <span class="total-value"></span>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
