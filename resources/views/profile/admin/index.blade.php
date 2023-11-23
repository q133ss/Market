@extends('layouts.app')
@section('title', 'Панель администратора')
@section('meta')
    <link rel="stylesheet" href="/assets/style/personal-account.css">
@endsection
@section('content')
    <div class="container personal-account-title">
        <h1>Личный кабинет администратора</h1>
    </div>

    <hr class="personal-line">

    <div class="container">
        <div class="personal-account">
            <div class="add-product" id="add-admin-product"><span onclick="addSeller()">+</span></div>
            <div class="personal-account-content admin-account-page">
                <div class="personal-account-btns">
                    <span class="active-personal-btn" id="personal-sellers">Продавцы</span>
                    <span class="" id="personal-moder-reviews">Модерация отзывов</span>
                    <span class="" id="personal-rating">Рейтинг продавцов</span>
                    <span class="" id="personal-adds">Реклама</span>
                    <span class="" id="personal-store-reviews">Отзывы магазинов</span>
                    <span class="" id="personal-city">Города</span>
                </div>
                <div class="personal-mobile-btns">
                    <div class="search-select city-select">
                        <input class="search-select-input" id="personal-my-mobile-input" type="text" placeholder="Продавцы" readonly />
                        <ul class="options">
                            <li class="option" id="admin-sellers-page">Продавцы</li>
                            <li class="option" id="admin-moder-reviews-page">Модерация отзывов</li>
                            <li class="option" id="admin-rating-page">Рейтинг продавцов</li>
                            <li class="option" id="admin-adds-page">Реклама</li>
                            <li class="option" id="admin-store-reviews-page">Отзывы магазинов</li>
                            <li class="option" id="admin-city">Отзывы магазинов</li>
                        </ul>
                    </div>
                </div>
                <div class="personal-account-content-items admin-account-content">
                    <div class="personal-account-content-item" id="personal-content-sellers">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>ID</span>
                                <span>Продавец</span>
                                <span>Магазин</span>
                                <span>Статус</span>
                            </div>
{{--                            тут foreacg--}}
                            @foreach($sellers as $seller)
                            <div class="personal-content-table-content">
                                <div class="personal-content-table-content-item">
                                    <p>ID{{$seller->id}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$seller->name}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$seller->shop->title ?? ''}}</p>
                                    <span class="vertical-line"></span>
                                    @if($seller->status == 1)
                                        <p class="green">Активный</p>
                                    @else
                                        <p>Не активный</p>
                                    @endif
                                    <span class="vertical-line"></span>
                                    <span class="product-action show-card-products">Товары</span>
                                    @if($seller->status == 1)
                                    <span class="product-action" onclick="location.href='{{route('admin.status.change', [$seller->id, 0])}}'">Деактивировать</span>
                                    @else
                                    <span class="product-action" onclick="location.href='{{route('admin.status.change', [$seller->id, 1])}}'">Активировать</span>
                                    @endif
                                    <span class="seller-products-btn"></span>
                                </div>
                                <form class="add-product-items-content edit_usr admin-edit-product" action="{{route('admin.user.update', $seller->id)}}" method="POST" id="admin-edit-product-1" enctype="multipart/form-data">
                                    @csrf
                                    <div class="add-product-img-content">
                                        <div class="add-product-img-swiper">
                                            <div class="product-imaage">
                                                <img style="max-width: 125px;" src="{{$seller->photos->pluck('src')->first() ?? ''}}" alt="">
                                            </div>
                                        </div>
                                        <div class="file-input">
                                            <input type="file" name="file_input[]" id="write-review-file-input"
                                                   class="file-input__input" multiple />
                                            <label class="file-input__label"
                                                   for="write-review-file-input"><span>Загрузить
                                                    фото</span></label>
                                        </div>
                                    </div>
                                    <div class="add-characteristics-form">
                                        <label>ФИО продавца:</label>
                                        <input type="text" name="name" value="{{$seller->name}}">

                                        <label>Email для входа:</label>
                                        <input type="email" name="email" value="{{$seller->email}}">

                                        <label>Название магазина:</label>
                                        <input type="text" name="shop_name" value="{{$seller->shop->title ?? ''}}">

                                        <label>Описание:</label>
                                        <textarea cols="30" name="shop_description" rows="10">{{$seller->shop->description ?? ''}}</textarea>

                                        <label>Информация о доставке:</label>
                                        <textarea cols="30" name="shop_shipping" rows="6">{{$seller->shop->shipping_info ?? ''}}</textarea>

                                        <label>Информация о связи с продавцом:</label>
                                        <textarea cols="30" name="shop_communication_info" rows="6">{{$seller->shop->communication_info ?? ''}}</textarea>

                                        <label>Место на карте:</label>
                                        <div class="map"></div>

                                        <button type="submit">СОХРАНИТЬ</button>
                                    </div>
                                </form>
                                <div class="card-products" id="show-card-product-1">
                                    @if($seller->shop)
                                    @foreach($seller->shop->products as $product)
                                    <div class="product-item">
                                        <div class="add-to-favorite-icon">
                                            <svg width="20" height="18" viewBox="0 0 25 22" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.033 0C15.6511 0 13.6159 1.70992 12.4977 2.88877C11.3795 1.70992 9.34886 0 6.96818 0C2.86477 0 0 2.88076 0 7.00447C0 11.5482 3.55795 14.4851 7 17.3258C8.625 18.6683 10.3068 20.0555 11.5966 21.5937C11.8136 21.8512 12.1318 22 12.4659 22H12.5318C12.867 22 13.1841 21.8501 13.4 21.5937C14.692 20.0555 16.3727 18.6672 17.9989 17.3258C21.4398 14.4862 25 11.5494 25 7.00447C25 2.88076 22.1352 0 18.033 0Z"
                                                    fill="#ffffff" />
                                            </svg>
                                        </div>
                                        <div class="product-item-header">
                                            <img src="{{$product->photos != null ? $product->photos->pluck('src')->first() : ''}}" alt="">
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
                                                <div class="go-to-product-page"
                                                     onclick="location.href = '{{route('products.show', $product->id)}}';">
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
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-moder-reviews">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>№</span>
                                <span>Название</span>
                                <span>Вопрос</span>
                            </div>
                            <div class="personal-content-table-content">
                                @foreach($reviews as $review)
                                <div class="personal-content-table-content-item">
                                    <p>№<span>{{$review->id}}</span></p>
                                    <span class="vertical-line"></span>
                                    <p>{{$review->product->name}}</p>
                                    <span class="vertical-line"></span>
                                    <div class="personal-account-question-content">
                                        <div class="moder-reviews-desc">
                                            <p>{{$review->title}}</p>
                                            <div>
                                                @foreach($review->files as $photo)
                                                <img src="{{$photo->src}}" alt="">
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="personal-account-question-btns">
                                            <button onclick="location.href='{{route('admin.review.action', [$review->id, 1])}}'">Сохранить</button>
                                            <button onclick="location.href='{{route('admin.review.action', [$review->id, 0])}}'">Отклонить</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-rating">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>ID</span>
                                <span>ФИО</span>
                                <span>Магазин</span>
                                <span>Рейтинг</span>
                            </div>

                            @foreach($sellers as $seller)
                            <div class="personal-content-table-content">
                                <form class="personal-content-table-content-item" action="{{route('admin.users.rating', $seller->id)}}" method="POST">
                                    @csrf
                                    <p>ID{{$seller->id}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$seller->name ?? ''}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$seller->shop->title ?? ''}}</p>
                                    <span class="vertical-line"></span>
                                    <div class="search-select">
                                        <input class="search-select-input" name="rating" type="text" placeholder="{{$seller->rating}}" readonly />
                                        @php
                                        $ratings = [
                                            '-1' => '#FF0000',
                                            '0' => '#969696',
                                            '1' => '#42FF00',
                                            '2' => '#FD8002',
                                        ];
                                        @endphp
                                        <ul class="options">
                                            @foreach($ratings as $rating => $key)
                                            <li class="option" style="color: {{$key}};">{{$rating}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <span class="vertical-line"></span>
                                    <button type="submit">Сохранить</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-adds">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>Баннер</span>
                            </div>
                            <div class="personal-content-table-content">
                                @foreach($banners as $banner)
                                <div class="personal-content-table-content-item banner-action">
                                    <p class="">Баннер {{$banner->id}}</p>
                                </div>
                                <form class="banner-hidden-item" action="{{route('admin.banners.update', $banner->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="banner-hidden-photo">
                                        <div class="banner-hidden-img" style="background-image: url('{{$banner->img ? $banner->img->src : ''}}'); background-size: cover"></div>
                                        <div class="file-input">
                                            <input type="file" name="img" id="write-review-file-input_{{$banner->id}}"
                                                   class="file-input__input" />
                                            <label class="file-input__label"
                                                   for="write-review-file-input_{{$banner->id}}"><span>Загрузить</span></label>
                                        </div>
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr">
                                        <input type="text" value="{{$banner->title}}" name="title" placeholder="Заголовок" class="banner-link">
                                        <input type="text" value="{{$banner->text}}" name="text" placeholder="Текст" class="banner-link">
                                        <input type="text" value="{{$banner->link}}" name="link" placeholder="Ссылка на кнопку" class="banner-link">
                                    </div>
                                    <button type="submit">Сохранить</button>
                                </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-store-reviews">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>Магазин</span>
                                <span>Имя</span>
                                <span>Отзыв</span>
                            </div>
                            <div class="personal-content-table-content">
                                @foreach($allReviews as $review)
                                <div class="personal-content-table-content-item">
                                    <p>{{$review->shop()->title}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$review->user->name}}</p>
                                    <span class="vertical-line"></span>
                                    <p>
                                        {{$review->title}}
                                    </p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="seller_add">
                        <div class="add-product-content">
                            <div class="add-header"></div>
                            <div class="add-product-items-content">
                                <form method="POST" action="{{route('admin.user.store')}}" class="add-product-items-content" enctype="multipart/form-data">
                                    @csrf
                                    <div class="add-product-img-content">
                                        <div class="add-product-img-swiper">
                                            <div class="product-imaage">
                                                <img src="../images/product.png" alt="">
                                            </div>
                                        </div>
                                        <div class="file-input">
                                            <input type="file" name="img" id="write-review-file-input_user"
                                                   class="file-input__input" />
                                            <label class="file-input__label"
                                                   for="write-review-file-input_user"><span>Загрузить
                                                    фото</span></label>
                                        </div>
                                    </div>
                                    <div class="add-characteristics-form">
                                        <label>ФИО продавца:</label>
                                        <input type="text" name="name">

                                        <label>Email для входа:</label>
                                        <input type="email" name="email">

                                        <label>Пароль:</label>
                                        <input type="password" name="password">

                                        <label>Название магазина:</label>
                                        <input name="shop_name" type="text">

                                        <label>Описание:</label>
                                        <textarea cols="30" name="shop_description" rows="10"></textarea>

                                        <label>Информация о доставке:</label>
                                        <textarea cols="30" name="shop_shipping" rows="6"></textarea>

                                        <label>Информация о связи с продавцом:</label>
                                        <textarea cols="30" name="shop_communication_info" rows="6"></textarea>

                                        <label>Место на карте:</label>
                                        <div class="map"></div>

                                        <button>СОХРАНИТЬ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-city">
                        <div class="add-product-content">
                            <div class="add-header"></div>
                            @foreach($cities as $city)
                                <div class="personal-content-table-content-item banner-action">
                                    <p class="">{{$city->name}}</p>
                                </div>
                                <form class="banner-hidden-item" action="{{route('admin.city.update', $city->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div style="display: grid; grid-template-columns: 1fr">
                                        <input type="text" value="{{$city->name}}" name="name" placeholder="Название" class="banner-link">
                                    </div>
                                    <button type="submit">Сохранить</button>
                                </form>
                            @endforeach
                        </div>
                    </div>

                    <div class="personal-account-content-item" id="banner_add">
                        <div class="add-product-content">
                            <div class="add-header"></div>
                            <div class="add-product-items-content">
                                <form class="add-product-items-content" action="{{route('admin.banners.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="add-product-img-content">
                                        <div class="add-product-img-swiper">
                                            <div class="product-imaage">
                                                <img src="../images/product.png" alt="">
                                            </div>
                                        </div>
                                        <div class="file-input">
                                            <input type="file" name="img" id="write-review-file-input_banner"
                                                   class="file-input__input" />
                                            <label class="file-input__label"
                                                   for="write-review-file-input_banner"><span>Загрузить
                                                    фото</span></label>
                                        </div>
                                    </div>
                                    <div class="add-characteristics-form">
                                        <label>Заголовок:</label>
                                        <input type="text" name="title">

                                        <label>Текст:</label>
                                        <input type="text" name="text">

                                        <label>Ссылка на кнопку:</label>
                                        <input type="text" name="link">

                                        <button>СОХРАНИТЬ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="personal-account-content-item" id="city_add">
                        <div class="add-product-content">
                            <div class="add-header"></div>
                            <div class="add-product-items-content">
                                <form class="add-product-items-content" action="{{route('admin.city.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="add-characteristics-form">
                                        <label>Название:</label>
                                        <input type="text" name="name">

                                        <button>СОХРАНИТЬ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/assets/script/personal-admin-account.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $('.show-card-products').click(function (){
            let el = $(this).parent().parent().find('.card-products');
            if(el.css('display') == 'none') {
                el.css('display', 'flex')
            }else{
                el.css('display', 'none')
            }
        });

        $('.seller-products-btn').click(function (){
            let el = $(this).parent().parent().find($(".edit_usr"));
            if(el.css('display') == 'none') {
                el.css('display', 'flex');
            }else{
                el.css('display', 'none');
            }
        });

        $('#personal-adds').click(function(){
            $('#add-admin-product > span').attr('onclick', 'addBanner()');
        });

        $('#personal-sellers').click(function(){
            $('#add-admin-product > span').attr('onclick', 'addSeller()');
        });

        function addBanner(){
            $('.personal-account-content-item').css('display', 'none');
            $('#banner_add').css('display', 'block');
        }

        function addSeller(){
            $('.personal-account-content-item').css('display', 'none');
            $('#seller_add').css('display', 'block');
        }

        $('#personal-city').click(function (){
            $('#add-admin-product > span').attr('onclick', 'addCity()');
        });

        function addCity(){
            $('.personal-account-content-item').css('display', 'none');
            $('#city_add').css('display', 'block');
        }
    </script>
@endsection
