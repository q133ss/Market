@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('meta')
    <link rel="stylesheet" href="/assets/style/personal-account.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <div class="container personal-account-title">
        <h1>Личный кабинет продавца</h1>
    </div>

    <hr class="personal-line">

    <div class="container">
        <div class="personal-account">
            <div class="add-product" id="add-product"><span>+</span></div>
            @if(session()->has('success'))
                <h3 class="item-title">{{ session()->get('success') }}</h3>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                </div>
            @endif

            <div class="personal-account-content">
                <div class="personal-account-btns">
                    <span class="active-personal-btn" id="personal-products">Товары</span>
                    <span class="" id="personal-questions">Вопросы</span>
                    <span class="" id="personal-statistics">Статистика</span>
                    <span class="" id="personal-stores">О магазине</span>
                    <span class="" id="personal-reviews">Отзывы о работе магазина</span>
                    <span class="" id="personal-waiting-list">Лист ожидания</span>
                </div>
                <!-- ------------------------------------ -->
                <div class="personal-mobile-btns">
                    <div class="search-select city-select">
                        <input class="search-select-input" id="personal-seller-mobile-input" type="text"
                               placeholder="Товары" readonly />
                        <ul class="options">
                            <li class="option" id="seller-products-page">Товары</li>
                            <li class="option" id="seller-questions-page">Вопросы</li>
                            <li class="option" id="seller-statistic-page">Статистика</li>
                            <li class="option" id="seller-store-page">О магазине</li>
                            <li class="option" id="seller-reviews-page">Отзывы о работе магазина</li>
                            <li class="option" id="seller-waiting-list-page">Лист ожидания</li>
                        </ul>
                    </div>
                </div>
                <div class="personal-account-content-items">
                    <div class="personal-account-content-item" id="personal-content-products">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>№</span>
                                <span>Название</span>
                                <span>Цена</span>
                                <span>Категория</span>
                                <span>Цвет</span>
                                <span>Наличие</span>
                                <span style="width: 20px;"></span>
                            </div>
                            <div class="personal-content-table-content">
                                @foreach($products as $product)
                                <div class="personal-content-table-content-item">
                                    <p>№<span>{{$product->id}}</span></p>
                                    <span class="vertical-line"></span>
                                    <p>{{$product->name}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$product->price}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$product->category->name}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$product->color}}</p>
                                    <span class="vertical-line"></span>
                                    <p class="gray">
                                        <span @if($product->in_stock)class="orange"@endif>Да</span>
                                        /
                                        <span @if(!$product->in_stock)class="orange"@endif>Нет</span>
                                    </p>
                                    <span class="vertical-line"></span>
                                    <span class="table-action"></span>
                                </div>
                                <div class="personal-content-table-hidden-item">
                                    <form method="POST" action="{{route('seller.product.update', $product->id)}}" class="add-product-items-content" enctype="multipart/form-data">
                                        <div class="add-product-img-content">
                                            <div class="add-product-img-swiper">
                                                <div class="product-imaage">
                                                    <img src="{{$product->photos ? $product->photos->pluck('src')->first() : ''}}" style="width: 115px;" alt="">
                                                </div>
                                            </div>
                                            <div class="file-input">
                                                <input type="file" name="img[]" id="write-review-file-input_{{$product->id}}"
                                                       class="file-input__input" multiple />
                                                <label class="file-input__label"
                                                       for="write-review-file-input_{{$product->id}}"><span>Загрузить фото</span></label>
                                            </div>
                                        </div>
                                        <div class="add-characteristics-form">
                                            @csrf

                                            <div style="display: flex; overflow-x: scroll; width: 680px">
                                                @foreach($product->photos as $photo)
                                                    <div id="file_{{$photo->id}}">
                                                        @if($photo->category == 'product')
                                                        <img src="{{$photo->src}}" style="width: 225px; height: 200px;" alt="">
                                                        @else
                                                            <video style="width: 225px; height: 200px;" controls="controls">
                                                                <source src="{{$photo->src}}">
                                                            </video>
                                                        @endif
                                                        <button type="button" onclick="imgDelete('{{$photo->id}}')">Удалить</button>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <label>Название:</label>
                                            <input type="text" name="name" value="{{$product->name}}">

                                            <label>Категория:</label>
{{--                                            <input type="text" name="category_id">--}}
                                            <select name="category_id" id="" style="background-color: #EDEDED;
                                                                                    padding: 6px 0px 6px 12px;
                                                                                    border-radius: 4px;
                                                                                    width: 335px;">
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>

                                            <label>Состав:</label>
                                            <input type="text" name="compound" value="{{$product->compound}}">

                                            <label>Цвет:</label>
                                            <input type="text" name="color" value="{{$product->color}}">

                                            <div class="sizes-and-gender">
                                                <div class="add-sizes product_sizes_{{$product->id}}" id="add-product-from-list-1">
                                                    <p>Размеры:</p>
                                                    <div>
                                                        <span onclick="changeProductSize('{{$product->id}}')" class="add-row-btn"><img src="/assets/images/white-cross.svg"
                                                                                       alt=""></span>
                                                    </div>
                                                    @foreach($product->sizes as $size)
                                                        <div id="size_item_{{$size->id}}">
                                                            {{$size->size}}
                                                            <img src="/assets/images/cross-arrow.svg"
                                                                 alt="" style="cursor: pointer" onclick="sizeDelete('{{$size->id}}')">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <label>Цена:</label>
                                            <input type="text" name="price" value="{{$product->price}}">

                                            <label>Старая цена:</label>
                                            <input type="text" value="{{$product->old_price}}" name="old_price">

                                            <div class="about-added-product" id="chars_wrap_{{$product->id}}">
                                                <p>О товаре:</p>
                                                <div class="about-added-product-content">
                                                    <div class="about-added-items" id="add-characteristic-1">
                                                    </div>
                                                    <span class="add-row-btn characteristic" onclick="addCharOpen('{{$product->id}}')"><img
                                                            src="/assets/images/white-cross.svg" alt=""></span>
                                                </div>

                                                @foreach($product->chars as $char)
                                                    <div class="about-added-product-content" id="char_item_{{$char->id}}" style="margin-top: 10px; display: flex; flex-direction: row; justify-content: center; gap: 10px">
                                                        <span>{{$char->key}} : {{$char->value}}</span>
                                                        <img src="/assets/images/cross-arrow.svg"
                                                             alt="" style="cursor: pointer" onclick="charDelele('{{$char->id}}')">
                                                    </div>
                                                @endforeach
                                            </div>

                                            <label>Номер телефона для связи с покупателем</label>
                                            <input type="text" value="{{$product->phone}}" name="phone" placeholder="+7 (999) 999-99-99" class="phone-input">

                                            <label>Описание:</label>
                                            <textarea cols="30" rows="10" name="description">{{$product->description}}</textarea>

                                            <label>Информация о доставке:</label>
                                            <textarea cols="30" name="shipping" rows="10">{{$product->shipping}}</textarea>

{{--                                            <div class="present-in-stock">--}}
{{--                                                <p>Есть в наличии:</p>--}}
{{--                                                <input type="hidden" name="in_stock" value="{{$product->in_stock}}" id="in_stock">--}}
{{--                                                <div class="in-stock-controls">--}}
{{--                                                    <span onclick="selectStock(1)" @if($product->in_stock)class="active-personal-btn"@endif>да</span>--}}
{{--                                                    <span onclick="selectStock(0)" @if(!$product->in_stock)class="active-personal-btn"@endif>нет</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <label>Количество товара</label>
                                            <input type="text" placeholder="1" name="qty" value="{{$product->qty}}">

                                            <button>СОХРАНИТЬ</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-questions">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>№</span>
                                <span>Название</span>
                                <span>Вопрос</span>
                            </div>
                            <div class="personal-content-table-content">
                                @foreach($questions as $question)
                                <div class="personal-content-table-content-item">
                                    <p>№<span>{{$question->id}}</span></p>
                                    <span class="vertical-line"></span>
                                    <p>{{$question->product->name}}</p>
                                    <span class="vertical-line"></span>
                                    <form class="personal-account-question-content" method="POST" action="{{route('seller.quest.update', $question->id)}}">
                                        @csrf
                                        <h3>
                                            {{$question->question}}
                                        </h3>
                                        <div class="personal-account-question-edit">
                                            <label>Ответ:</label>
                                            <textarea cols="22" name="answer" rows="5">{{$question->answer}}</textarea>
                                        </div>
                                        <div class="personal-account-question-btns">
                                            <button>Сохранить</button>
{{--                                            <a href="#">Скрыть/показать</a>--}}
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-statistics">
                        <!-- <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>№</span>
                                <span>Название</span>
                                <span>Просмотры</span>
                                <span>В избранном</span>
                                <span>Купили</span>
                                <span>Лист ожидания</span>
                            </div>
                            <div class="personal-content-table-content">
                                <div class="personal-content-table-content-item">
                                    <p>№<span>234</span></p>
                                    <p>Название товара</p>
                                    <p>2500</p>
                                    <p>121</p>
                                    <p>25</p>
                                    <p>465</p>
                                </div>
                            </div>
                        </div> -->
                        <table>
                            <tr>
                                <th>№</th>
                                <th>Название</th>
                                <th>Просмотры</th>
                                <th>В избранном</th>
                                <th>Посмотрели контакты</th>
                                <th>Лист ожидания</th>
                            </tr>
                            @foreach($products as $product)
                            <tr>
                                <td>№<span>{{$product->id}}</span></td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->views}}</td>
                                <td>{{$product->favorites}}</td>
                                <td>{{$product->buys}}</td>
                                <td>{{$product->wait_list}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-stores">
                        <div class="personal-content-table-header">
                        </div>
                        <form action="{{route('seller.shop.update')}}" method="POST" class="add-product-items-content" enctype="multipart/form-data">
                            @csrf
                            <div class="add-product-img-content">
                                <div class="add-product-img-swiper">
                                    <div class="product-imaage">
                                        <img src="{{$user->shop->photo ? $user->shop->photo->src : ''}}" alt="" width="100%">
                                    </div>
                                </div>
                                <div class="file-input">
                                    <input type="file" name="img" id="write-review-file-input_shop"
                                           class="file-input__input" />
                                    <label class="file-input__label" for="write-review-file-input_shop"><span>Загрузить
                                            фото</span></label>
                                </div>
                            </div>
                            <div class="add-characteristics-form">
                                <label>Название магазина:</label>
                                <input type="text" name="title" value="{{$user->shop->title}}">

                                <label>Номер телефона для связи с покупателем</label>
                                <input type="text" placeholder="+7 (999) 999-99-99" class="phone-input" name="phone" value="{{$user->shop->phone}}">

                                <label>Описание:</label>
                                <textarea cols="30" name="description" rows="10">{{$user->shop->description}}</textarea>

                                <label>Информация о связи с продавцом:</label>
                                <textarea cols="30" name="communication_info" rows="6">{{$user->shop->communication_info}}</textarea>

                                <label>Информация о доставке:</label>
                                <textarea cols="30" name="shipping_info" rows="6">{{$user->shop->shipping_info}}</textarea>

                                <label>Место на карте:</label>
                                <div class="map"></div>

                                <button>СОХРАНИТЬ</button>
                            </div>
                        </form>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-reviews">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span style="width: 20px;"></span>
                            </div>
                            <div class="personal-content-table-content">
                                @foreach($reviews as $review)
                                <div class="personal-content-table-content-item">
                                    <p>{{$review->user->name}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$review->title}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-waiting-list">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>№</span>
                                <span>Название</span>
                                <span>Цена</span>
                                <span>Категория</span>
                                <span>Цвет</span>
                                <span>Ожидают</span>
                                <span style="width: 20px;"></span>
                            </div>
                            <div class="personal-content-table-content">
                                @foreach($products as $product)
                                <div class="personal-content-table-content-item">
                                    <p>№<span>{{$product->id}}</span></p>
                                    <span class="vertical-line"></span>
                                    <p>{{$product->name}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$product->price}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$product->category->id}}</p>
                                    <span class="vertical-line"></span>
                                    <p>{{$product->color}}</p>
                                    <span class="vertical-line"></span>
                                    <p class="gray">{{$product->wait_list}}</p>
                                    <span class="vertical-line"></span>
                                    <span></span>
{{--                                    <span class="table-action"></span>--}}
                                </div>
                                <div class="personal-content-table-hidden-item">
                                    <div class="add-product-items-content">
                                        <div class="add-product-img-content">
                                            <div class="add-product-img-swiper">
                                                <div class="product-imaage">
                                                    <img src="/assets/images/product.png" alt="">
                                                </div>
                                            </div>
                                            <div class="file-input">
                                                <input type="file" name="file-input" id="write-review-file-input"
                                                       class="file-input__input" />
                                                <label class="file-input__label"
                                                       for="write-review-file-input"><span>Загрузить фото</span></label>
                                            </div>
                                        </div>
                                        <div class="add-characteristics-form">
                                            <label>Название:</label>
                                            <input type="text">

                                            <label>Категория:</label>
                                            <input type="text">

                                            <label>Состав:</label>
                                            <input type="text">

                                            <label>Цвет:</label>
                                            <input type="text">

                                            <div class="sizes-and-gender">
                                                <div class="add-sizes" id="add-product-waiting-list-1">
                                                    <p>Размеры:</p>
                                                    <div>
                                                        <span class="add-row-btn"><img src="/assets/images/white-cross.svg"
                                                                                       alt=""></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <label>Цена:</label>
                                            <input type="text">

                                            <label>Старая цена:</label>
                                            <input type="text">

                                            <div class="about-added-product">
                                                <p>О товаре:</p>
                                                <div class="about-added-product-content">
                                                    <div class="about-added-items"
                                                         id="add-characteristic-from-waiting-list-1">
                                                    </div>
                                                    <span class="add-row-btn characteristic"><img
                                                            src="/assets/images/white-cross.svg" alt=""></span>
                                                </div>
                                            </div>

                                            <label>Номер телефона для связи с покупателем</label>
                                            <input type="text" placeholder="+7 (999) 999-99-99" class="phone-input">

                                            <label>Описание:</label>
                                            <textarea cols="30" rows="10"></textarea>


                                            <div class="present-in-stock">
                                                <p>Есть в наличии:</p>
                                                <div class="in-stock-controls">
                                                    <span class="active-personal-btn">да</span>
                                                    <span>нет</span>
                                                </div>
                                            </div>

                                            <button>СОХРАНИТЬ</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-add-product">
                        <div class="add-product-content">
                            <div class="add-header"></div>
                            <form action="{{route('seller.product.store')}}" method="POST" id="addProductForm" class="add-product-items-content" enctype="multipart/form-data">
                                @csrf
                                <span class="dublicate"><img src="/assets/images/dublicate.svg" alt=""></span>
                                <div class="add-product-img-content">
                                    <div class="add-product-img-swiper">
                                        <div class="swiper add-product-img-slider">
                                            <div class="swiper-wrapper">
{{--                                                <div class="swiper-slide">--}}
{{--                                                    <div class="product-imaage">--}}
{{--                                                        <img src="/assets/images/product.png" alt="">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="swiper-slide">--}}
{{--                                                    <div class="product-imaage">--}}
{{--                                                        <img src="/assets/images/product.png" alt="">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>
                                            <span class="swiper-button-prev"></span>
                                            <span class="swiper-button-next"></span>
                                        </div>
                                    </div>
                                    <div class="file-input">
                                        <input type="file" name="img[]" multiple id="write-review-file-input_product_add"
                                               class="file-input__input" />
                                        <label class="file-input__label" for="write-review-file-input_product_add"><span>Загрузить
                                                фотографии</span></label>
                                    </div>
                                </div>
                                <div class="add-characteristics-form">
                                    <label>Название:</label>
                                    <input type="text" name="name" value="{{old('name')}}">

                                    <label>Категория:</label>
                                    <select name="category_id" id="" style="background-color: #EDEDED;
                                                                            padding: 6px 0px 6px 12px;
                                                                            border-radius: 4px;
                                                                            width: 335px;">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    <label>Состав:</label>
                                    <input type="text" name="compound" value="{{old('compound')}}">

                                    <label>Цвет:</label>
                                    <input type="text" name="color" value="{{old('color')}}">

                                    <div class="sizes-and-gender">
                                        <div class="add-sizes new_product_sizes" id="add-product-form">
                                            <p>Размеры:</p>
                                            <div>
                                                <span class="add-row-btn" onclick="newAddSize()"><img src="/assets/images/white-cross.svg"
                                                                               alt=""></span>
                                            </div>
                                        </div>
{{--                                        <div class="add-gender">--}}
{{--                                            <p>Пол:</p>--}}
{{--                                            <div class="gender-items">--}}
{{--                                                <span class="active-personal-btn">Мужской</span>--}}
{{--                                                <span>Женский</span>--}}
{{--                                                <span>Унисекс</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>

                                    <label>Цена:</label>
                                    <input type="text" name="price" value="{{old('price')}}">

                                    <label>Старая цена:</label>
                                    <input type="text" name="old_price" value="{{old('old_price')}}">

                                    <div class="about-added-product" id="new_product_chars">
                                        <p>О товаре:</p>
                                        <div class="about-added-product-content">
                                            <div class="about-added-items" id="add-characteristic-form">
                                            </div>
                                            <span onclick="newAddChar()" class="add-row-btn characteristic"><img
                                                    src="/assets/images/white-cross.svg" alt=""></span>
                                        </div>
                                    </div>

                                    <label>Номер телефона для связи с покупателем</label>
                                    <input type="text" placeholder="+7 (999) 999-99-99" name="phone" value="{{old('phone')}}" class="phone-input">

                                    <label>Описание:</label>
                                    <textarea cols="30" rows="10" name="description">{{old('description')}}</textarea>

                                    <label>Информация о доставке:</label>
                                    <textarea cols="30" rows="10" name="shipping">{{old('qty')}}</textarea>

                                    <input type="hidden" id="newInStock" name="in_stock" value="1">

                                    <label>Количество товара</label>
                                    <input type="text" placeholder="1" name="qty" value="{{old('qty')}}">

{{--                                    <div class="present-in-stock">--}}
{{--                                        <p>Есть в наличии:</p>--}}
{{--                                        <div class="in-stock-controls">--}}
{{--                                            <span onclick="newChangeStock(1)" class="active-personal-btn">да</span>--}}
{{--                                            <span onclick="newChangeStock(0)">нет</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <button type="submit">СОХРАНИТЬ</button>
                                </div>
                                <div class="about-select-country">
                                    <p>Город:</p>
                                    <div class="search-select city-select">
                                        <input class="search-select-input" name="city" type="text" placeholder="Город" readonly />
                                        <ul class="options">
                                            @foreach($cities as $city)
                                            <li class="option">{{$city->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--------------------------- MODALS  START------------------->
    <div class="modal add-size-popup" id="modal">
        <div class="modal-content">
            <input type="text" id="char_size" placeholder="Введите размер" class="size">
            <input type="hidden" id="size-or-characteristic-div-id">
            <input type="hidden" name="product_id" id="size_product_id" value="">
            <button type="button" onclick="addSize()" class="add-size-or-characteristic-btn">Добавить</button>
        </div>
    </div>

    <div class="modal add-characteristic-popup" id="modal">
        <div class="modal-content">
            <input type="text" placeholder="Параметр" class="parametr" id="char_key">
            <input type="text" placeholder="Комментарий" class="comment" id="char_value">
            <input type="hidden" id="char_product_id">
            <input type="hidden" id="size-or-characteristic-div-id">
            <button class="add-size-or-characteristic-btn" onclick="addChar()">Добавить</button>
        </div>
    </div>
    <!--------------------------- MODALS  END------------------->
@endsection
@section('scripts')
    <script src="/assets/script/personal-seller-account.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        function selectStock(type){
            $('#in_stock').val(type)
        }

        function changeProductSize(id){
            $('#size_product_id').val(id)
        }

        function addSize(){
            let id = $('#size_product_id').val();
            let size = $('#char_size').val();

            if(id != 'new') {
                $.ajax({
                    url: '/account/seller/product/' + id + '/add/size',
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'size': size
                    },
                    success: (data) => {
                        $('.add-size-popup').css('display', 'none');
                        $('.product_sizes_' + id).append("<div>" + data.size + "</div>");
                    },
                    error: function (request, status, error) {
                        //console.log(statusCode = request.responseText);
                    }
                });
            }else{
                $('#addProductForm').append("<input type='hidden' id='size_inp_"+size+"' name='sizes[]' value='"+size+"'>");

                $('.new_product_sizes').append("<div id='new_product_s_"+size+"'>" + size + "<img src='/assets/images/cross-arrow.svg' alt='' style='cursor: pointer' onclick='newSizeDel("+size+")'></div>");

                $('#char_size').val("");
                $('.add-size-popup').css('display', 'none');
            }
        }

        function sizeDelete(id){
            $.ajax({
                url: '/account/seller/product/size/'+id+'/delete',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('#size_item_'+id).remove();
                },
                error: function (request, status, error) {
                    //console.log(statusCode = request.responseText);
                }
            });
        }

        function addCharOpen(id){
            $('#char_product_id').val(id)
        }

        function addChar(){
            let key = $('#char_key').val();
            let value = $('#char_value').val();
            let id = $('#char_product_id').val();

            if(id != 'new') {
                $.ajax({
                    url: '/account/seller/product/' + id + '/add/char',
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'key': key,
                        'value': value
                    },
                    success: (data) => {
                        $('.add-characteristic-popup').css('display', 'none');
                        $('#chars_wrap_' + id).append(
                            '<div class="about-added-product-content" id="char_item_' + data.id + '" style="margin-top: 10px; display: flex; flex-direction: row; justify-content: center; gap: 10px">' +
                            data.key + ' : ' + data.value +
                            '<img src="/assets/images/cross-arrow.svg" alt="" style="cursor: pointer" onclick="charDelele(\'' + data.id + '\')">' +
                            '</div>'
                        );
                    },
                    error: function (request, status, error) {
                        //console.log(statusCode = request.responseText);
                    }
                });
            }else{
                let form = $('#addProductForm');
                form.append("<input type='hidden' id='char_key_inp_"+key+"' name='char_keys[]' value='"+key+"'>");
                form.append("<input type='hidden' id='char_val_inp_"+key+"' name='char_vals[]' value='"+value+"'>");

                $('#new_product_chars').append(
                    '<div class="about-added-product-content" id="new_char_item_' + key + '" style="margin-top: 10px; display: flex; flex-direction: row; justify-content: center; gap: 10px">' +
                    key + ' : ' + value +
                    '<img src="/assets/images/cross-arrow.svg" alt="" style="cursor: pointer" onclick="newCharDelele(\''+key+'\')">' +
                    '</div>'
                );

                $('#char_key').val("");
                $('#char_value').val("");
                $('.add-characteristic-popup').css('display', 'none');
            }
        }

        function charDelele(char_id){
            $.ajax({
                url: '/account/seller/product/char/'+char_id+'/delete',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    $('#char_item_'+char_id).remove();
                },
                error: function (request, status, error) {
                    //console.log(statusCode = request.responseText);
                }
            });
        }

        function newAddSize(){
            $('#size_product_id').val('new');
        }

        function newAddChar(){
            $('#char_product_id').val('new');
        }

        function newSizeDel(size){
            $('#size_inp_' + size).remove();
            $('#new_product_s_' + size).remove();
        }

        function newCharDelele(key){
            $('#char_key_inp_'+key).remove();
            $('#char_val_inp_'+key).remove();
            $('#new_char_item_'+key).remove();
        }

        function newChangeStock(status){
            $('#newInStock').val(status)
        }

        function imgDelete(id){
            let conf = confirm('Подтвердите');

            if(conf){
                $.ajax({
                    url: '/account/seller/delete/file/'+id,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        $('#file_'+id).remove();
                    },
                    error: function (request, status, error) {
                        //console.log(statusCode = request.responseText);
                    }
                });
            }

            return false;
        }
    </script>
@endsection
