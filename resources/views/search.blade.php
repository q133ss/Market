@extends('layouts.app')
@section('title', 'Поиск')
@section('content')
    <div class="container">
        <div class="history">
            <a href="#">Главная</a>
            <a href="#">/ каталог </a>
            <a href="#">/ одежда</a>
        </div>

        <div class="search-content">
            <div class="search-title">
                <h1>Одежда</h1>
                <p>Найдено <span>{{$products->count()}}</span> товаров</p>
            </div>

            <div class="search-controls">
                <div class="swiper search-controls-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide first-search-slide">
                            <div class="search-select main-search-control">
                                <input class="search-select-input" type="text" placeholder="Select option" readonly />
                                <ul class="options">
                                    @foreach($categories as $category)
                                    <li class="option">{{$category->name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="swiper-slide newest-items">
                            <div class="search-select">
                                <input class="search-select-input" type="text" placeholder="Новинки" readonly />
                                <ul class="options">
                                    <li class="option">Скидки</li>
                                    <li class="option">По цене <img src="/assets/images/orange-circle-arrow.svg" alt=""></li>
                                    <li class="option">По цене <img src="/assets/images/orange-circle-arrow.svg" alt=""
                                                                    style="transform: rotate(180deg);"></li>
                                </ul>
                            </div>
                        </div>

{{--                        <div class="swiper-slide">--}}
{{--                            <div class="search-select">--}}
{{--                                <input class="search-select-input" type="text" placeholder="Размер" readonly />--}}
{{--                                <ul class="options">--}}
{{--                                    <li class="option">Размер</li>--}}
{{--                                    <li class="option">Размер</li>--}}
{{--                                    <li class="option">Размер</li>--}}
{{--                                    <li class="option">Размер</li>--}}
{{--                                    <li class="option">Размер</li>--}}
{{--                                    <li class="option">Размер</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="swiper-slide">--}}
{{--                            <div class="search-select">--}}
{{--                                <input class="search-select-input" type="text" placeholder="Материал" readonly />--}}
{{--                                <ul class="options">--}}
{{--                                    <li class="option">Материал</li>--}}
{{--                                    <li class="option">Материал</li>--}}
{{--                                    <li class="option">Материал</li>--}}
{{--                                    <li class="option">Материал</li>--}}
{{--                                    <li class="option">Материал</li>--}}
{{--                                    <li class="option">Материал</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}

{{--                        </div>--}}

                        <div class="swiper-slide">

                            <div class="search-select">
                                <input class="search-select-input" name="price" type="text" placeholder="Цена" readonly />
                                <ul class="options">
                                    <li class="option">До 1000</li>
                                    <li class="option">До 3000</li>
                                    <li class="option">До 5000</li>
                                    <li class="option">До 10000</li>
                                    <li class="option">До 15000</li>
                                    <li class="option">До 20000</li>
                                </ul>
                            </div>
                        </div>

                        <div class="swiper-slide">

                            <div class="search-select">
                                <input class="search-select-input" type="text" placeholder="Цвет" readonly />
                                <ul class="options">
                                    @foreach($colors as $color)
                                    <li class="option">{{$color}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- <div class="sub-controls">
                        </div> -->
                        <!-- </div> -->

                        <div class="swiper-slide">
                            <div class="city-control">
                                <div class="search-select city-select">
                                    <input class="search-select-input" name="city_id" type="text" placeholder="Город" readonly />
                                    <ul class="options">
                                        @foreach($cities as $city)
                                        <li class="option">{{$city->name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                        <img src="{{$product->photos->pluck('src')->first()}}" alt="">
                    </div>
                    <div class="product-item-content">
                        <h3 class="item-title">{{$product->name}}</h3>
                        <div class="product-item-bottom">
                            <div class="price-info">
                                <h2 class="item-price"><span class="price-value">{{$product->price}}</span> ₽</h2>
                                <div class="in-store">
                                    <p>В наличии: </p>
                                    <p class="in-store-value"><span>3</span> шт.</p>
                                </div>
                            </div>
                            <div class="go-to-product-page" onclick="location.href = 'product-page.html';">
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
