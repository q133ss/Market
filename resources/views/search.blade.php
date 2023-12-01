@extends('layouts.app')
@section('title', 'Поиск')
@section('content')
    <div class="container">
        <div class="history">
            <a href="/">Главная</a>
            <a href="#">/ Поиск </a>
        </div>

        <div class="search-content">
            <div class="search-title">
                <h1>Одежда</h1>
                <p>Найдено <span>{{$products->count()}}</span> товаров</p>
            </div>
            <form id="filter_form" class="search-controls">
                <div class="filter_cats">
                    <select name="category_id" class="filter-item">
                        <div id="first_filter_wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                <rect x="0.398438" y="0.881363" width="16.9492" height="14.9153" rx="4" fill="white"/>
                                <path d="M5.82227 6.3051H11.924H5.82227ZM5.82227 8.339H11.924H5.82227ZM5.82227 10.3729H11.924H5.82227Z" fill="white"/>
                                <path d="M5.82227 6.3051H11.924M5.82227 8.339H11.924M5.82227 10.3729H11.924" stroke="#2D2D2D" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                                <option value="" selected disabled>Категория</option>
                                @foreach($categories as $category)
                                <option @if(\Request()->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                            <circle cx="9.04208" cy="9.33898" r="8.81356" fill="white"/>
                            <path d="M9.04192 12.0508L13.1097 7.94393L12.4317 7.30508L9.04192 10.6819L5.65209 7.30508L4.97412 7.94393L9.04192 12.0508Z" fill="#2F2F2F"/>
                        </svg>
                    </select>

                    <select name="sort" class="filter-item">
                        <div id="first_filter_wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                <rect x="0.398438" y="0.881363" width="16.9492" height="14.9153" rx="4" fill="white"/>
                                <path d="M5.82227 6.3051H11.924H5.82227ZM5.82227 8.339H11.924H5.82227ZM5.82227 10.3729H11.924H5.82227Z" fill="white"/>
                                <path d="M5.82227 6.3051H11.924M5.82227 8.339H11.924M5.82227 10.3729H11.924" stroke="#2D2D2D" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                                <option value="1" @if(\Request()->sort == 1) selected @endif>Новинки</option>
                                <option value="2" @if(\Request()->sort == 2) selected @endif>По увеличению цены</option>
                                <option value="3" @if(\Request()->sort == 3) selected @endif>По уменьшению цены</option>
                                <option value="4" @if(\Request()->sort == 4) selected @endif>По рейтингу</option>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                            <circle cx="9.04208" cy="9.33898" r="8.81356" fill="white"/>
                            <path d="M9.04192 12.0508L13.1097 7.94393L12.4317 7.30508L9.04192 10.6819L5.65209 7.30508L4.97412 7.94393L9.04192 12.0508Z" fill="#2F2F2F"/>
                        </svg>
                    </select>

                    <select name="size_id" class="filter-item">
                        <div id="first_filter_wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                <rect x="0.398438" y="0.881363" width="16.9492" height="14.9153" rx="4" fill="white"/>
                                <path d="M5.82227 6.3051H11.924H5.82227ZM5.82227 8.339H11.924H5.82227ZM5.82227 10.3729H11.924H5.82227Z" fill="white"/>
                                <path d="M5.82227 6.3051H11.924M5.82227 8.339H11.924M5.82227 10.3729H11.924" stroke="#2D2D2D" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                                <option value="" selected disabled>Размер</option>
                                @foreach($sizes as $size)
                                <option @if(\Request()->size_id == $size->id) selected @endif value="{{$size->id}}">{{$size->size}}</option>
                                @endforeach
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                            <circle cx="9.04208" cy="9.33898" r="8.81356" fill="white"/>
                            <path d="M9.04192 12.0508L13.1097 7.94393L12.4317 7.30508L9.04192 10.6819L5.65209 7.30508L4.97412 7.94393L9.04192 12.0508Z" fill="#2F2F2F"/>
                        </svg>
                    </select>

{{--                    <div class="filter-item">--}}
{{--                        <div id="first_filter_wrap">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">--}}
{{--                                <rect x="0.398438" y="0.881363" width="16.9492" height="14.9153" rx="4" fill="white"/>--}}
{{--                                <path d="M5.82227 6.3051H11.924H5.82227ZM5.82227 8.339H11.924H5.82227ZM5.82227 10.3729H11.924H5.82227Z" fill="white"/>--}}
{{--                                <path d="M5.82227 6.3051H11.924M5.82227 8.339H11.924M5.82227 10.3729H11.924" stroke="#2D2D2D" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                            <select name="material" id="">--}}
{{--                                <option value="" selected disabled>Материал</option>--}}
{{--                                @foreach($materials as $material)--}}
{{--                                    <option value="{{$material}}">{{$material}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">--}}
{{--                            <circle cx="9.04208" cy="9.33898" r="8.81356" fill="white"/>--}}
{{--                            <path d="M9.04192 12.0508L13.1097 7.94393L12.4317 7.30508L9.04192 10.6819L5.65209 7.30508L4.97412 7.94393L9.04192 12.0508Z" fill="#2F2F2F"/>--}}
{{--                        </svg>--}}
{{--                    </div>--}}

{{--                    <select class="filter-item" name="price">--}}
{{--                        <div id="first_filter_wrap">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">--}}
{{--                                <rect x="0.398438" y="0.881363" width="16.9492" height="14.9153" rx="4" fill="white"/>--}}
{{--                                <path d="M5.82227 6.3051H11.924H5.82227ZM5.82227 8.339H11.924H5.82227ZM5.82227 10.3729H11.924H5.82227Z" fill="white"/>--}}
{{--                                <path d="M5.82227 6.3051H11.924M5.82227 8.339H11.924M5.82227 10.3729H11.924" stroke="#2D2D2D" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                                <option value="" selected disabled>Цена</option>--}}
{{--                                <option value="1000" @if(\Request()->price == 1000) selected @endif >До 1000</option>--}}
{{--                                <option value="2000" @if(\Request()->price == 2000) selected @endif >До 2000</option>--}}
{{--                                <option value="3000" @if(\Request()->price == 3000) selected @endif >До 3000</option>--}}
{{--                                <option value="5000" @if(\Request()->price == 5000) selected @endif >До 5000</option>--}}
{{--                                <option value="10000" @if(\Request()->price == 10000) selected @endif >До 10000</option>--}}
{{--                        </div>--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">--}}
{{--                            <circle cx="9.04208" cy="9.33898" r="8.81356" fill="white"/>--}}
{{--                            <path d="M9.04192 12.0508L13.1097 7.94393L12.4317 7.30508L9.04192 10.6819L5.65209 7.30508L4.97412 7.94393L9.04192 12.0508Z" fill="#2F2F2F"/>--}}
{{--                        </svg>--}}
{{--                    </select>--}}

                    <select name="color" class="filter-item">
                        <div id="first_filter_wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                <rect x="0.398438" y="0.881363" width="16.9492" height="14.9153" rx="4" fill="white"/>
                                <path d="M5.82227 6.3051H11.924H5.82227ZM5.82227 8.339H11.924H5.82227ZM5.82227 10.3729H11.924H5.82227Z" fill="white"/>
                                <path d="M5.82227 6.3051H11.924M5.82227 8.339H11.924M5.82227 10.3729H11.924" stroke="#2D2D2D" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                                <option value="" selected disabled>Цвет</option>
                                @foreach($colors as $color)
                                <option value="{{$color}}" @if(\Request()->color == $color) selected @endif >{{$color}}</option>
                                @endforeach
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                            <circle cx="9.04208" cy="9.33898" r="8.81356" fill="white"/>
                            <path d="M9.04192 12.0508L13.1097 7.94393L12.4317 7.30508L9.04192 10.6819L5.65209 7.30508L4.97412 7.94393L9.04192 12.0508Z" fill="#2F2F2F"/>
                        </svg>
                    </select>

                    <select name="type" class="filter-item">
                        <div id="first_filter_wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                <rect x="0.398438" y="0.881363" width="16.9492" height="14.9153" rx="4" fill="white"/>
                                <path d="M5.82227 6.3051H11.924H5.82227ZM5.82227 8.339H11.924H5.82227ZM5.82227 10.3729H11.924H5.82227Z" fill="white"/>
                                <path d="M5.82227 6.3051H11.924M5.82227 8.339H11.924M5.82227 10.3729H11.924" stroke="#2D2D2D" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <option value="" selected disabled>Тип</option>
                            <option value="1" @if(\Request()->type == 1) selected @endif >Мужской</option>
                            <option value="2" @if(\Request()->type == 2) selected @endif >Женский</option>
                            <option value="3" @if(\Request()->type == 3) selected @endif >Детский</option>
                            <option value="4" @if(\Request()->type == 4) selected @endif >Мальчикам</option>
                            <option value="5" @if(\Request()->type == 5) selected @endif >Девочкам</option>
                            <option value="6" @if(\Request()->type == 6) selected @endif >Новорожденным</option>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                            <circle cx="9.04208" cy="9.33898" r="8.81356" fill="white"/>
                            <path d="M9.04192 12.0508L13.1097 7.94393L12.4317 7.30508L9.04192 10.6819L5.65209 7.30508L4.97412 7.94393L9.04192 12.0508Z" fill="#2F2F2F"/>
                        </svg>
                    </select>

                    <div class="price_range filter-item">
                        <span>{{$min}}</span>
                        <input type="range" id="priceInp" name="price" @if(\Request()->has('price') == 3) value="{{\Request()->price}}" @endif min="{{$min}}" max="{{$max}}">
                        <span>{{$max}}</span>
                    </div>
                </div>

                <select name="city_id" class="filter-item city_item">
                    <div id="first_filter_wrap">
                            <option value="" selected disabled>Город</option>
                            @foreach($cities as $city)
                            <option value="{{$city->id}}" @if(\Request()->city_id == $city->id) selected @endif >{{$city->name}}</option>
                            @endforeach
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="19" viewBox="0 0 22 19" fill="none">
                        <ellipse cx="10.9594" cy="9.84747" rx="10.6122" ry="9.0339" fill="white"/>
                        <path d="M11 13L15 8.67308L14.3333 8L11 11.5577L7.66667 8L7 8.67308L11 13Z" fill="#2F2F2F"/>
                    </svg>
                </select>
            </form>

            <div class="main-products">
                @foreach($products as $product)
                <div class="product-item">
                    <div class="add-to-favorite-icon">
                        <svg width="20" height="18" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.033 0C15.6511 0 13.6159 1.70992 12.4977 2.88877C11.3795 1.70992 9.34886 0 6.96818 0C2.86477 0 0 2.88076 0 7.00447C0 11.5482 3.55795 14.4851 7 17.3258C8.625 18.6683 10.3068 20.0555 11.5966 21.5937C11.8136 21.8512 12.1318 22 12.4659 22H12.5318C12.867 22 13.1841 21.8501 13.4 21.5937C14.692 20.0555 16.3727 18.6672 17.9989 17.3258C21.4398 14.4862 25 11.5494 25 7.00447C25 2.88076 22.1352 0 18.033 0Z"
                                fill="#ffffff" />
                        </svg>
                    </div>
                    <div class="product-item-header">
                        @if($product->photos->pluck('category')->first() == 'video')
                            <video style="width: 225px; height: 200px;" controls="controls">
                                <source src="{{$product->photos->pluck('src')->first()}}">
                            </video>
                        @else
                            <img src="{{$product->photos->pluck('src')->first()}}" onclick="location.href = '{{route('products.show', $product->id ?? '')}}';" alt="" style="width: 100%;">
                        @endif
                    </div>
                    <div class="product-item-content">
                        <h3 class="item-title">{{$product->name}}</h3>
                        <div class="product-item-bottom">
                            <div class="price-info">
                                <h2 class="item-price"><span class="price-value">{{$product->price}}</span> ₽</h2>
                                <div class="in-store">
                                    <p>В наличии: </p>
                                    <p class="in-store-value"><span>{{$product->qty}}</span> шт.</p>
                                </div>
                            </div>
                            <div class="go-to-product-page" onclick="location.href = '{{route('products.show', $product->id ?? '')}}';">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.37313 1.16481C9.37313 0.888666 9.14927 0.664808 8.87313 0.664808L4.37313 0.664808C4.09698 0.664808 3.87313 0.888666 3.87313 1.16481C3.87313 1.44095 4.09698 1.66481 4.37313 1.66481L8.37313 1.66481L8.37313 5.66481C8.37313 5.94095 8.59698 6.16481 8.87313 6.16481C9.14927 6.16481 9.37313 5.94095 9.37313 5.66481L9.37313 1.16481ZM0.802009 9.94303L9.22668 1.51836L8.51957 0.811255L0.0949024 9.23592L0.802009 9.94303Z"
                                        fill="#FD8002" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

    </div>
@endsection
@section('scripts')
    <style>
        .search-controls{
            display: flex;
            justify-content: space-between;
        }

        .filter_cats{
            display: flex;
            gap: 10px;
        }

        .filter-item{
            display: flex;
            align-items: center;

            padding: 12px;
            border-radius: 8px;
            border: 1px solid #E6E6E6;
            background: #F6F6F6;

            color: #2F2F2F;

            font-family: 'Jost', sans-serif;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
        }
        .filter-item:first-child{
            width: 221px;
            justify-content: space-between;
            margin-right: 32px;
        }

        #first_filter_wrap{
            display: flex;
            align-items: center;
        }

        .filter-item select{
            border:0px;
            outline:0px;
            -webkit-appearance: none;
            outline: none !important;
        }

        .city_item{
            background: #FF8000;
            color: #ffffff;
        }

        .city_item select{
            background: #FF8000;
            color: #ffffff;
        }

        .city_item svg{
            margin-left: 51px;
        }

        @media screen and (max-width: 1089px) {
            .search-controls{
                display: grid;
            }

            .filter_cats{
                display: grid;
            }

            .filter_cats select{
                width: 100% !important;
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // $('.filter-item').click(function (){
        //     $(this).find('select').show().focus().click();
        // });

        if($('select').change(function (){
            $('#filter_form').submit();
        }
        ));

        $('#priceInp').change(function (){
            $('#filter_form').submit();
        });
        //$('#filter_form').submit();
    </script>
@endsection
