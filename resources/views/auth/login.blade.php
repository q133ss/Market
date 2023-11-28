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
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <style>
        #showPwd{
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
