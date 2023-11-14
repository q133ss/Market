@extends('layouts.app')
@section('title', 'Регистрация')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <div class="container">
        <div class="center">
            <div class="login-form">
                <h3>Войти по Email</h3>
                <input type="email" id="email" placeholder="Введите ваш Email">
                <button onclick="send()">Войти</button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function send(){
            let email = $('#email').val();
            $.ajax({
                url: '/register',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'email': email
                },
                success: (data) => {
                    $('.login-form').html('<h3>На вашу почту отправлены доступы к аккаунту</h3>');
                },
                error: function (request, status, error) {
                    alert(request.responseText)
                }
            });
        }
    </script>
@endsection
