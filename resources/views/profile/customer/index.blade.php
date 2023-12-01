@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('meta')
    <link rel="stylesheet" href="/assets/style/personal-account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection
@section('content')
    <div class="container personal-account-title">
        <h1>Личный кабинет</h1>
    </div>

    <hr class="personal-line">

    <div class="container">
        <div class="personal-account">
            @if(session()->has('success'))
                <h3>{{session()->get('success')}}</h3>
            @endif
            <div class="personal-account-content my-profile">
                <div class="personal-account-btns personal-profile-btns">
                    <span class="active-personal-btn" id="personal-profile">Настройки профиля</span>
                    <span class="" id="personal-request-history">История запросов</span>
                    <span class="" id="personal-my-reviews">Мои отзывы</span>
                    <span class="" id="personal-my-questions">Мои вопросы</span>
                    <span class="" id="personal-my-waiting-list">Лист ожидания</span>
                </div>
                <div class="personal-mobile-btns">
                    <div class="search-select city-select">
                        <input class="search-select-input" id="personal-my-mobile-input" type="text" placeholder="Настройки профиля" readonly />
                        <ul class="options">
                            <li class="option" id="my-profile-settings-page">Настройки профиля</li>
                            <li class="option" id="my-search-history-page">История запросов</li>
                            <li class="option" id="my-reviews-page">Мои отзывы</li>
                            <li class="option" id="my-questions-page">Мои вопросы</li>
                            <li class="option" id="my-waiting-list-page">Лист ожидания</li>
                        </ul>
                    </div>
                </div>
                <div class="personal-account-content-items my-profile-content">
                    <div class="personal-account-content-item" id="personal-content-profile">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>Редактирование профиля</span>
                            </div>
                            <form class="personal-content-table-content" method="POST" action="{{route('cust.update')}}">
                                @csrf
                                <label>Моё имя:</label>
                                <div class="personal-account-input">
                                    <input type="text" name="name" value="{{$user->name}}">
                                    <img src="../images/edit-gray.svg" alt="">
                                </div>

                                <label>Email:</label>
                                <div class="personal-account-input">
                                    <input type="email" name="email" value="{{$user->email}}">
                                    <img src="../images/edit-gray.svg" alt="">
                                </div>

                                @if($user->social_auth == 0)
                                <label>Старый пароль:</label>
                                <div class="personal-account-input">
                                    <div style="display: flex; align-items: center; width: 100%; gap: 3px;">
                                        <input type="password" id="pwd1" name="old_password" placeholder="Пароль">
                                        <i class="fa fa-eye" id="showPwd1" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <label>Новый пароль:</label>
                                <div class="personal-account-input">
                                    <div style="display: flex; align-items: center; width: 100%; gap: 3px;">
                                        <input type="password" id="pwd2" name="new_password" placeholder="Пароль">
                                        <i class="fa fa-eye" id="showPwd2" aria-hidden="true"></i>
                                    </div>
                                </div>
                                @endif


                                <button>Сохранить изменения</button>
                            </form>
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-request-history">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>История запросов</span>
                            </div>
                            <div class="personal-content-table-content">
                                @foreach($user->searchHistory as $history)
                                <div class="personal-content-table-content-item">
                                    <div class="personal-account-input">
                                        <input type="text" disabled value="{{$history->query}}">
                                        <img src="../images/search.svg" alt="">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-my-reviews">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>Мои отзывы</span>
                            </div>
                            @foreach($reviews as $review)
                            <div class="personal-content-table-content-item">
                                <p>№<span>{{$review->id}}</span></p>
                                <span class="vertical-line"></span>
                                <p>{{$review->product->name}}</p>
                                <span class="vertical-line"></span>
                                <div class="personal-account-question-content">
                                    <div class="moder-reviews-desc">
                                        <p>
                                            {{$review->title}}
                                        </p>
                                        <div>
                                            <img src="../images/product.png" alt="">
                                            <img src="../images/product.png" alt="">
                                            <img src="../images/product.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="personal-account-content-item" id="personal-content-my-questions">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>Мои вопросы</span>
                            </div>
                            @foreach($questions as $question)
                            <div class="personal-content-table-content-item">
                                <p>№<span>{{$question->id}}</span></p>
                                <span class="vertical-line"></span>
                                <p>{{$question->product->name}}</p>
                                <span class="vertical-line"></span>
                                <p>{{$question->question}}
                                </p>
                                <div class="personal-account-question-edit">
                                    <label>Ответ магазина:</label>
                                    <p>{{$question->answer}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="personal-account-content-item" id="personal-content-my-waiting-list">
                        <div class="personal-content-table">
                            <div class="personal-content-table-header">
                                <span>Лист ожидания</span>
                            </div>
                            <div class="card-products">
                                @foreach($waits as $product)
                                <div class="product-item">
{{--                                    <div class="add-to-favorite-icon">--}}
{{--                                        <svg width="20" height="18" viewBox="0 0 25 22" fill="none"--}}
{{--                                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path--}}
{{--                                                d="M18.033 0C15.6511 0 13.6159 1.70992 12.4977 2.88877C11.3795 1.70992 9.34886 0 6.96818 0C2.86477 0 0 2.88076 0 7.00447C0 11.5482 3.55795 14.4851 7 17.3258C8.625 18.6683 10.3068 20.0555 11.5966 21.5937C11.8136 21.8512 12.1318 22 12.4659 22H12.5318C12.867 22 13.1841 21.8501 13.4 21.5937C14.692 20.0555 16.3727 18.6672 17.9989 17.3258C21.4398 14.4862 25 11.5494 25 7.00447C25 2.88076 22.1352 0 18.033 0Z"--}}
{{--                                                fill="#ffffff" />--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
                                    <div class="product-item-header">
                                        {{$product->photo ? $product->photo->src : ''}}
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/assets/script/personal-account.js"></script>

    <style>
        #showPwd1{
            cursor: pointer;
        }
        #showPwd2{
            cursor: pointer;
        }
    </style>
    <script>
        $('#showPwd1').click(function (){
            if($('#pwd1').attr('type') == 'password') {
                $('#pwd1').attr('type', 'text');
            }else{
                $('#pwd1').attr('type', 'password');
            }
        });

        $('#showPwd2').click(function (){
            if($('#pwd2').attr('type') == 'password') {
                $('#pwd2').attr('type', 'text');
            }else{
                $('#pwd2').attr('type', 'password');
            }
        });
    </script>
@endsection
