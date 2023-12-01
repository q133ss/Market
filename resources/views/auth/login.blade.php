@extends('layouts.app')
@section('title', 'Вход')
@section('meta')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection
@section('content')
    <div class="container">
        <div class="center">
            <form class="login-form" method="POST" action="{{route('auth')}}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @csrf
                <h3>Войти по Email</h3>
                <input type="email" name="email" placeholder="Введите ваш Email">
                <div style="display: flex; align-items: center; width: 100%; gap: 3px;">
                    <input type="password" id="pwd" name="password" placeholder="Пароль">
                    <i class="fa fa-eye" id="showPwd" aria-hidden="true"></i>
                </div>
                <button type="submit">Войти</button>

                <div class="socials">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 48 48" onclick="location.href='{{route('vk.auth')}}'">
                <path fill="#1976d2" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5 V37z"></path><path fill="#fff" d="M35.937,18.041c0.046-0.151,0.068-0.291,0.062-0.416C35.984,17.263,35.735,17,35.149,17h-2.618 c-0.661,0-0.966,0.4-1.144,0.801c0,0-1.632,3.359-3.513,5.574c-0.61,0.641-0.92,0.625-1.25,0.625C26.447,24,26,23.786,26,23.199 v-5.185C26,17.32,25.827,17,25.268,17h-4.649C20.212,17,20,17.32,20,17.641c0,0.667,0.898,0.827,1,2.696v3.623 C21,24.84,20.847,25,20.517,25c-0.89,0-2.642-3-3.815-6.932C16.448,17.294,16.194,17,15.533,17h-2.643 C12.127,17,12,17.374,12,17.774c0,0.721,0.6,4.619,3.875,9.101C18.25,30.125,21.379,32,24.149,32c1.678,0,1.85-0.427,1.85-1.094 v-2.972C26,27.133,26.183,27,26.717,27c0.381,0,1.158,0.25,2.658,2c1.73,2.018,2.044,3,3.036,3h2.618 c0.608,0,0.957-0.255,0.971-0.75c0.003-0.126-0.015-0.267-0.056-0.424c-0.194-0.576-1.084-1.984-2.194-3.326 c-0.615-0.743-1.222-1.479-1.501-1.879C32.062,25.36,31.991,25.176,32,25c0.009-0.185,0.105-0.361,0.249-0.607 C32.223,24.393,35.607,19.642,35.937,18.041z"></path>
                </svg>

                <svg onclick="location.href='{{route('ok.auth')}}'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="37.5" height="37.5" viewBox="0 0 389.404 387.417" enable-background="new 0 0 389.404 387.417" xml:space="preserve">
                <g>
                	<path fill="#FAAB62" d="M389.404,330.724c0,31.312-25.383,56.693-56.693,56.693H56.693C25.382,387.417,0,362.036,0,330.724V56.693   C0,25.382,25.382,0,56.693,0h276.018c31.311,0,56.693,25.382,56.693,56.693V330.724z"/>
                	<path fill="#F7931E" d="M387.404,329.317c0,30.989-25.122,56.11-56.111,56.11H58.11c-30.989,0-56.11-25.121-56.11-56.11V58.1   C2,27.111,27.122,1.99,58.11,1.99h273.183c30.989,0,56.111,25.122,56.111,56.11V329.317z"/>
                	<path fill="#FFFFFF" d="M194.485,57.901c-38.593,0-69.878,31.286-69.878,69.878c0,38.593,31.285,69.881,69.878,69.881   s69.878-31.288,69.878-69.881C264.363,89.187,233.078,57.901,194.485,57.901z M194.485,156.667   c-15.953,0-28.886-12.934-28.886-28.887s12.933-28.886,28.886-28.886s28.886,12.933,28.886,28.886S210.438,156.667,194.485,156.667   z"/>
                	<g>
                		<path fill="#FFFFFF" d="M219.155,253.262c27.975-5.699,44.739-18.947,45.626-19.658c8.186-6.565,9.501-18.523,2.936-26.71    c-6.564-8.186-18.521-9.501-26.709-2.937c-0.173,0.14-18.053,13.856-47.472,13.876c-29.418-0.02-47.676-13.736-47.849-13.876    c-8.188-6.564-20.145-5.249-26.709,2.937c-6.565,8.187-5.25,20.145,2.936,26.71c0.899,0.721,18.355,14.314,47.114,19.879    l-40.081,41.888c-7.284,7.554-7.065,19.582,0.489,26.866c3.687,3.555,8.439,5.322,13.187,5.322c4.978,0,9.951-1.945,13.679-5.812    l37.235-39.665l40.996,39.922c7.428,7.416,19.456,7.404,26.87-0.021c7.414-7.426,7.405-19.456-0.021-26.87L219.155,253.262z"/>
                		<path fill="#FFFFFF" d="M193.536,217.832c-0.047,0,0.046,0.001,0,0.002C193.49,217.833,193.583,217.832,193.536,217.832z"/>
                	</g>
                </g>
                </svg>
                </div>

            </form>

        </div>
    </div>
@endsection
@section('scripts')
    <style>
        #showPwd{
            cursor: pointer;
        }

        .socials{
            display: flex;
            align-items: center;
        }

        .socials svg{
            cursor: pointer;
        }
    </style>
    <script>
        $('#showPwd').click(function (){
            if($('#pwd').attr('type') == 'password') {
                $('#pwd').attr('type', 'text');
            }else{
                $('#pwd').attr('type', 'password');
            }
        });
    </script>
@endsection
