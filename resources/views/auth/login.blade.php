@extends('layouts.app')
@section('title', 'Вход')
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
                <input type="password" name="password" placeholder="Пароль">
                <button type="submit">Войти</button>
            </form>
        </div>
    </div>
@endsection
