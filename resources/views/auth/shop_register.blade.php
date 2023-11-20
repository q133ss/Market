@extends('layouts.app')
@section('title', 'Регистрация магазина')
@section('content')
    <div class="container">
        <div class="center">
            <form action="{{route('shop.register.store')}}" method="POST" class="login-form">
                @csrf
                <h3>Регистрация магазина</h3>
                <input type="text" name="name" placeholder="ФИО">
                <input type="text" name="phone" placeholder="+7 (999) 999-99-99">
                <input type="email" name="email" placeholder="Ваш Email">
                <button>Зарегистрироваться</button>
            </form>
        </div>
    </div>
@endsection
