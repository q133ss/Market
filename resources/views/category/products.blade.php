@extends('layouts.app')
@section('title', 'Категория '.$category->name)
@section('meta')
    <link rel="stylesheet" href="/assets/style/templates.css">
@endsection
@section('content')
    <div class="container">
        <div class="store-products">
            <div class="store-products-header">
                <h1>Товары категории {{$category->name}}</h1>
                <p>Найдено <span>{{$category->products->count()}}</span> товаров</p>
            </div>
            <div class="store-products-content">
                <div class="main-products">
                    @foreach($category->products as $product)
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
                                <img src="{{$product->photos->pluck('src')->first()}}" onclick="location.href = '{{route('products.show', $product->id)}}';" alt="">
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
                                    <div class="go-to-product-page" onclick="location.href = '{{route('products.show', $product->id)}}';">
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

{{--                <div class="store-information">--}}
{{--                    <h3>{{$category->title}}</h3>--}}
{{--                    <img src="/assets/images/partner.png" alt="">--}}
{{--                    <div class="select-info">--}}
{{--                        <p>Контактный телефон:</p>--}}
{{--                        <div class="contact-info-item">--}}
{{--                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none"--}}
{{--                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path--}}
{{--                                    d="M14.4323 11.5928L12.17 11.3184C11.904 11.2852 11.6343 11.3165 11.3813 11.4099C11.1283 11.5034 10.8986 11.6565 10.7093 11.8578L9.07041 13.5991C6.54193 12.2328 4.48677 10.0492 3.20082 7.36264L4.84858 5.61188C5.23157 5.20495 5.41862 4.63714 5.35627 4.05986L5.09797 1.67505C5.04747 1.21339 4.83895 0.787591 4.51211 0.478712C4.18527 0.169833 3.76293 -0.00055102 3.32551 1.3388e-06H1.78464C0.778165 1.3388e-06 -0.0590758 0.889574 0.0032719 1.95895C0.475333 10.0408 6.55869 16.495 14.1562 16.9965C15.1627 17.0628 15.9999 16.1732 15.9999 15.1038V13.4666C16.0088 12.5108 15.3319 11.7064 14.4323 11.5928Z"--}}
{{--                                    fill="#FD8002" />--}}
{{--                            </svg>--}}
{{--                            <p>{{$category->phone}}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <p class="store-description">--}}
{{--                        {{$category->description}}--}}
{{--                    </p>--}}
{{--                    <span class="add-to-favorite-list add-store-review">--}}
{{--                        Оставить отзыв о работе магазина--}}
{{--                    </span>--}}
{{--                    <div class="store-writen-review" id="store-writen-review">--}}
{{--                        <p>Ваше имя:</p>--}}
{{--                        <input type="text">--}}

{{--                        <p>Напишите свой отзыв о магазине:</p>--}}
{{--                        <textarea class="write-review-form-email" cols="30" rows="10"></textarea>--}}

{{--                        <button>Отправить</button>--}}

{{--                        <a href="#">Правила публикации</a>--}}
{{--                    </div>--}}

{{--                    <div class="store-map-area"></div>--}}
{{--                </div>--}}
            </div>

        </div>

    </div>
@endsection
