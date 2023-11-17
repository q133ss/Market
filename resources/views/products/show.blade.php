@extends('layouts.app')
@section('title', '222')
@section('meta')
    <link rel="stylesheet" href="/assets/style/templates.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <div class="container">
        <div class="history">
            <a href="#">Главная</a>
            <a href="#">/ каталог </a>
            <a href="#">/ бомбер</a>
            <a href="#">/ крошки</a>
            <a href="#">/ крошки</a>
            <a href="#">/ крошки</a>
        </div>
        <div class="product">
            <h2 class="store-name">{{$product->shop->title}}</h2>
            <div class="product-conent">
                <div class="product-main-info">
                    <h2>{{$product->name}}</h2>
                    <div class="product-rate">
                        <span><img src="/assets/images/star.svg" alt=""> 4,7</span>
                        <span>20 оценок</span>
                        <span>Артикул: 32423453</span>
                    </div>
                    <div class="product-image-and-characteristic">
                        <div class="product-img-swiper">
                            <div class="swiper product-img-slider">
                                <div class="swiper-wrapper">
                                    @foreach($product->photos as $photo)
                                    <div class="swiper-slide">
                                        <div class="product-imaage">
                                            <img src="{{$photo->src}}" alt="">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <span class="swiper-button-prev"></span>
                                <span class="swiper-button-next"></span>
                            </div>
                        </div>
                        <div class="product-characteristics">
                            <div class="product-characteristic">
                                <p>Состав: </p>
                                <span>{{$product->compound}}</span>
                            </div>
                            <div class="product-characteristic">
                                <p>Цвет: </p>
                                <span>{{$product->color}}</span>
                            </div>
                            <div class="product-sizes">
                                <p>Таблица размеров: </p>
                                <div class="product-sizes-list">
                                    @foreach($product->sizes as $size)
                                    <div class="product-sizes-list-item">{{$size->size}}</div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="product-links">
                                <a href="{{route('shop.products', $product->shop->id)}}">
                                    <span>Все товары магазина {{$product->shop->name}}</span>
                                    <img src="/assets/images/arrow-bg-orang.svg" alt="">
                                </a>
                                <a href="{{route('category.show', $product->category_id)}}">
                                    <span>Все товары в категории</span>
                                    <img src="/assets/images/arrow-bg-orang.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-other-info">
                    <div class="product-price">
                        <p>Цена:</p>
                        <div class="price-amounts">
                            <p><span>{{$product->price}} </span> ₽</p>
                            @if($product->old_price != null)
                            <span>{{$product->old_price}} ₽</span>
                            @endif
                        </div>
                    </div>
                    @if($product->in_stock == 0)
                    <div class="no-in-stoke">
                        <h2>Нет в наличии</h2>
                        <div class="add-to-wating-list">
                            <p>Добавить в лист ожидания</p>
                            <img src="/assets/images/orange-croos-circle.svg" alt="">
                        </div>
                    </div>
                    @endif
                    <div class="add-to-favorite-list" onclick="addTo('{{$product->id}}', 'favorite', '{{csrf_token()}}')">
                        <p>Добавить товар в избранное</p>
                        <div class="user-control-btn">
                            <svg width="25" height="22" viewBox="0 0 25 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.033 0C15.6511 0 13.6159 1.70992 12.4977 2.88877C11.3795 1.70992 9.34886 0 6.96818 0C2.86477 0 0 2.88076 0 7.00447C0 11.5482 3.55795 14.4851 7 17.3258C8.625 18.6683 10.3068 20.0555 11.5966 21.5937C11.8136 21.8512 12.1318 22 12.4659 22H12.5318C12.867 22 13.1841 21.8501 13.4 21.5937C14.692 20.0555 16.3727 18.6672 17.9989 17.3258C21.4398 14.4862 25 11.5494 25 7.00447C25 2.88076 22.1352 0 18.033 0Z"
                                    fill="#FD8002" />
                            </svg>
                        </div>
                    </div>
                    <div class="product-buy-info">
                        <div class="custom-info-select">
                            <div class="custom-info-select-title">
                                <p>Связаться с продавцом</p>
                                <svg width="34" height="34" viewBox="0 0 18 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="9.04208" cy="9.33898" r="8.81356" fill="white" />
                                    <path
                                        d="M9.04192 12.0508L13.1097 7.94393L12.4317 7.30508L9.04192 10.6819L5.65209 7.30508L4.97412 7.94393L9.04192 12.0508Z"
                                        fill="#2F2F2F" />
                                </svg>
                            </div>
                            <div class="select-info">
                                <p>Контактный телефон:</p>
                                <div class="contact-info-item">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.4323 11.5928L12.17 11.3184C11.904 11.2852 11.6343 11.3165 11.3813 11.4099C11.1283 11.5034 10.8986 11.6565 10.7093 11.8578L9.07041 13.5991C6.54193 12.2328 4.48677 10.0492 3.20082 7.36264L4.84858 5.61188C5.23157 5.20495 5.41862 4.63714 5.35627 4.05986L5.09797 1.67505C5.04747 1.21339 4.83895 0.787591 4.51211 0.478712C4.18527 0.169833 3.76293 -0.00055102 3.32551 1.3388e-06H1.78464C0.778165 1.3388e-06 -0.0590758 0.889574 0.0032719 1.95895C0.475333 10.0408 6.55869 16.495 14.1562 16.9965C15.1627 17.0628 15.9999 16.1732 15.9999 15.1038V13.4666C16.0088 12.5108 15.3319 11.7064 14.4323 11.5928Z"
                                            fill="#FD8002" />
                                    </svg>
                                    <p>{{$product->phone == null ? $product->shop->phone : $product->phone}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="custom-info-select">
                            <div class="custom-info-select-title">
                                <p>Доставка</p>
                                <svg width="34" height="34" viewBox="0 0 18 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="9.04208" cy="9.33898" r="8.81356" fill="white" />
                                    <path
                                        d="M9.04192 12.0508L13.1097 7.94393L12.4317 7.30508L9.04192 10.6819L5.65209 7.30508L4.97412 7.94393L9.04192 12.0508Z"
                                        fill="#2F2F2F" />
                                </svg>
                            </div>
                            <div class="select-info delivery-times">
                                <p>{{$product->shipping == null ? $product->shop->shipping_info : $product->shipping}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-text-info">
                <div class="product-about">
                    <h2>О товаре:</h2>
                    <div class="product-about-items">
                        @foreach($product->chars as $char)
                        <div class="product-about-item">
                            <span>{{$char->key}}</span>
                            <p>{{$char->value}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="product-description">
                    <h2>Описание:</h2>
                    <h3>{{$product->name}}:</h3>
                    <p>{{$product->description}}</p>
                </div>
            </div>

            <div class="review-questions">
                <p class="review-info">Вся информация основывается на сведениях предоставленных магазином</p>

                <div class="review-questions-btns">
                    <div class="swiper reviwe-controls-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <span class="review-btn active-review-btn" id="review">
                                    <p>Отзывы</p>
                                    <div>{{$product->reviews->count() < 20 ? $product->reviews->count() : '20+'}}</div>
                                </span>
                            </div>
                            <div class="swiper-slide">
                                <span class="review-btn" id="questions">
                                    <p>Вопросы</p>
                                    <div>{{$product->questions->count() < 20 ? $product->questions->count() : "20+"}}</div>
                                </span>
                            </div>
                            <div class="swiper-slide">
                                <span class="review-btn" id="write-review">
                                    <p>Написать отзыв</p>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="10" cy="10" r="10" fill="#FD8002" stroke="#FD8002"
                                                stroke-width="1" />
                                        <path
                                            d="M15.3536 10.3536C15.5488 10.1583 15.5488 9.84171 15.3536 9.64645L12.1716 6.46447C11.9763 6.2692 11.6597 6.2692 11.4645 6.46447C11.2692 6.65973 11.2692 6.97631 11.4645 7.17157L14.2929 10L11.4645 12.8284C11.2692 13.0237 11.2692 13.3403 11.4645 13.5355C11.6597 13.7308 11.9763 13.7308 12.1716 13.5355L15.3536 10.3536ZM4 10.5H15V9.5H4V10.5Z"
                                            fill="white" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="review-slider" id="review-content">
                    <div class="swiper review-questions-slider">
                        <div class="swiper-wrapper">
                            @foreach($product->reviews as $review)
                            <div class="swiper-slide">
                                <div class="review-questions-item slider-width-fullscren">
                                    <div class="review-questions-header">
                                        <h3>{{$review->user->name}}</h3>
                                        <p>{{$review->title}}</p>
                                    </div>
                                    <div class="review-questions-content">
                                        <div class="review-questions-content-items">
                                            @foreach($review->files as $file)
                                                <img src="{{$file->src}}" height="37" width="37" alt="">
                                            @endforeach
{{--                                            <div></div>--}}
{{--                                            <div></div>--}}
                                        </div>
                                        <img src="/assets/images/arrow-bg-orang.svg" alt=""
                                             style="transform: rotate(-45deg);">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <span class="swiper-button-prev"></span>
                        <span class="swiper-button-next"></span>
                    </div>
                </div>

                <div class="questions-content" id="questions-content">
                    @if(Auth()->check())
                    <div class="question-form">
                        <input type="text" id="quest_name" placeholder="Ваше имя" value="{{Auth()->user()->name}}" class="querstion-form-name">
                        <div class="querstion-form-email">
                            <input type="text" id="question" placeholder="Задайте свой вопрос" class="querstion-form-email">
                            <button onclick="questionSend()">ЗАДАТЬ</button>
                        </div>
                    </div>
                    @else
                        <div class="thenks-for-review" id="thenks-for-review" style="display:block;">
                            <h1>Войдите в аккаунт, что бы задать вопрос</h1>
                        </div>
                    @endif
                    <div class="swiper review-response-slider">
                        <div class="swiper-wrapper" id="questionSlider">
                            @foreach($product->questions as $question)
                            <div class="swiper-slide">
                                <div class="review-questions-item review-response-item">
                                    <div class="review-questions-header">
                                        <h3>{{$question->user->name}}</h3>
                                        <p>{{$question->question}}</p>
                                    </div>
                                    @if($question->answer != null)
                                    <div class="review-response-content">
                                        <h3>Продавец:</h3>
                                        <p>
                                            {{$question->answer}}
                                        </p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <span class="swiper-button-prev"></span>
                        <span class="swiper-button-next"></span>
                    </div>
                </div>


                <div class="question-fullscreen">
                    <span class="close-full">X</span>
                    <div class="swiper review-question-fullscreen-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="question-fullscreen-item">
                                    <div class="swiper product-img-slider-in-fullscreen">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="product-imaage">
                                                    <img src="/assets/images/large-product.png" alt="">
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="product-imaage">
                                                    <img src="/assets/images/large-product.png" alt="">
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="product-imaage">
                                                    <img src="/assets/images/large-product.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <span class="swiper-button-prev-full"></span>
                                        <span class="swiper-button-next-full"></span>
                                    </div>
                                    <div class="fullscreen-item-content">
                                        <h2>Алина</h2>
                                        <p>Мы вынуждены отталкиваться от того, что базовый вектор
                                            развития прекрасно подходит для реализации новых предложений.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="question-fullscreen-item">
                                    <div class="fullscreen-item-img">
                                        <div class="swiper product-img-slider-in-fullscreen">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="product-imaage">
                                                        <img src="/assets/images/large-product.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="product-imaage">
                                                        <img src="/assets/images/large-product.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="product-imaage">
                                                        <img src="/assets/images/large-product.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="swiper-button-prev-full"></span>
                                            <span class="swiper-button-next-full"></span>
                                        </div>
                                    </div>
                                    <div class="fullscreen-item-content">
                                        <h2>Алина</h2>
                                        <p>Мы вынуждены отталкиваться от того, что базовый вектор
                                            развития прекрасно подходит для реализации новых предложений.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="swiper-button-prev"></span>
                        <span class="swiper-button-next"></span>
                    </div>
                </div>

                <div class="write-review-content" id="write-review-content">
                    @if(Auth()->check())
                    <form action="{{route('products.review.store')}}" method="POST" class="write-review-form" id="write-review-form" enctype="multipart/form-data">
                        @csrf
                        <input type="text" placeholder="Ваше имя" value="{{Auth()->user()->name}}" name="name" id="reviewName" class="querstion-form-name">
                        <textarea placeholder="Напишите свой отзыв" name="review" id="reviewText" class="write-review-form-email" cols="30"
                                  rows="10"></textarea>
                        <input type="hidden" value="{{$product->id}}" name="id">
                        <div class="write-review-btns">
                            <div class="write-review-photo-input">
                                <div class="file-input">
                                    <input type="file" name="file_input[]" multiple id="write-review-file-input"
                                           class="file-input__input" />
                                    <label class="file-input__label" for="write-review-file-input"><span>Загрузить
                                            фото</span></label>
                                </div>
                                <span class="write-review-photo-error">*Добавьте фото</span>
                            </div>
                            <button id="write-review-submit" type="button">Отправить</button>
                        </div>
                    </form>
                    @else
                        <div class="thenks-for-review" id="thenks-for-review" style="display:block;">
                            <h1>Войдите в аккаунт, что бы оставить отзыв</h1>
                        </div>
                    @endif
                    <div class="thenks-for-review" id="thenks-for-review">
                        <span>
                            <svg width="35" height="35" viewBox="0 0 35 35" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.5 0.4375C7.99375 0.4375 0.4375 7.99375 0.4375 17.5C0.4375 27.0063 7.99375 34.5625 17.5 34.5625C27.0063 34.5625 34.5625 27.0063 34.5625 17.5C34.5625 7.99375 27.0063 0.4375 17.5 0.4375ZM24.0812 26.0312L17.5 19.45L10.9188 26.0312L8.96875 24.0812L15.55 17.5L8.96875 10.9188L10.9188 8.96875L17.5 15.55L24.0812 8.96875L26.0312 10.9188L19.45 17.5L26.0312 24.0812L24.0812 26.0312Z"
                                    fill="#FD8002" />
                            </svg>
                        </span>
                        <h1>Благодарим за обратную связь!</h1>
                    </div>
                </div>

            </div>

            <div class="last-viewed">
                <h1>Вы недавно смотрели:</h1>
                <div class="last-viewed-items">
                    <div class="swiper last-viewed-slider">
                        <div class="swiper-wrapper">
                            @foreach($lastSeenProducts as $product)
                            <div class="swiper-slide">
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
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>

        $(document).ready(function() {
            $('#write-review-submit').click(function(e) {
                e.preventDefault();

                var form = $('#write-review-form')[0];
                var formData = new FormData(form);

                let err = $('.write-review-photo-error');
                let err_status = false;

                if($('#write-review-file-input').val() == ''){
                    err.text('*Добавьте фото');
                    err.css('display', 'block');
                    err_status = true;
                    return;
                }

                if($('#reviewName').val() == ''){
                    err.text('*Введите имя');
                    err.css('display', 'block');
                    err_status = true;
                    return;
                }else{
                    err.css('display', 'none');
                    err_status = false;
                }

                if($('#reviewText').val() == ''){
                    err.text('*Введите отзыв');
                    err.css('display', 'block');
                    err_status = true;
                    return;
                }else{
                    err.css('display', 'none');
                    err_status = false;
                }

                if(!err_status) {
                    $.ajax({
                        url: "{{route('products.review.store')}}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            // Обработка успешного ответа
                            writeReviewForm.style.display = "none";
                            tanksForm.style.display = "flex";
                        },
                        error: function (xhr, status, error) {
                            // Обработка ошибки
                            console.log(error);
                        }
                    });
                }
            });
        });

        function questionSend(){
            let quest = $('#question').val();

            @if(Auth()->check())
            if(quest != ''){
                $.ajax({
                    url: "{{route('products.question.store')}}",
                    type: 'POST',
                    data: {
                        'question': quest,
                        'product_id': '{{$product->id}}'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Обработка успешного ответа

                        $('#quest_name').val('');
                        $('#question').val('');

                        $('#questionSlider').append(
                            '<div class="swiper-slide">'+
                            '<div class="review-questions-item review-response-item">'+
                            '<div class="review-questions-header">'+
                                '<h3>{{Auth()->user()->name}}</h3>'+
                                '<p>'+response.question+'</p>'+
                            '</div>'+
                            '</div>'+
                            '</div>'
                        );


                        updateSlider();

                    },
                    error: function (xhr, status, error) {
                        // Обработка ошибки
                        console.log(error);
                    }
                });
            }
            @endif
        }
    </script>
@endsection
