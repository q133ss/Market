<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/style/main.css">
    <link rel="stylesheet" href="/assets/style/swiper9.css">
    <title>@yield('title') - Redionselect</title>
    @yield('meta')
</head>

<body>
<div class="container">
    <div class="top-nav">
        <a href="#">Партнёрам</a>
        <a href="#">Покупателям</a>
        <a href="#" class="active" onclick="location.href = 'templates/store-register.html';">Продавайте на
            Regionselect</a>
    </div>

    <div class="menu">
        <div class="menu-icon-logo">
            <div class="menu-icon">
                <div class="burger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="logo" onclick="location.href = '/';">
                <img src="/assets/images/logo.png" alt="">
            </div>
            <div class="mega-menu">
                <div class="mega-menu-items">
                    @foreach($main_categories as $category)
                    <div class="mega-menu-item">
                        <span class="cataloge-title">{{$category->name}}</span>
                        @foreach($category->children as $child)
                        <a href="#">{{$child->name}}</a>
                        @endforeach
                        <a href="#">Ещё..</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="search">
            <input type="text" placeholder="Поиск по товарам">
            <div class="search-btn" onclick="location.href = 'templates/search.html';">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M10.5 2C9.14459 2.00012 7.80886 2.32436 6.60426 2.94569C5.39965 3.56702 4.36109 4.46742 3.57524 5.57175C2.78938 6.67609 2.27901 7.95235 2.08671 9.29404C1.89441 10.6357 2.02575 12.004 2.46978 13.2846C2.91381 14.5652 3.65765 15.7211 4.63924 16.6557C5.62083 17.5904 6.8117 18.2768 8.11251 18.6576C9.41332 19.0384 10.7863 19.1026 12.117 18.8449C13.4477 18.5872 14.6974 18.015 15.762 17.176L19.414 20.828C19.6026 21.0102 19.8552 21.111 20.1174 21.1087C20.3796 21.1064 20.6304 21.0012 20.8158 20.8158C21.0012 20.6304 21.1064 20.3796 21.1087 20.1174C21.111 19.8552 21.0102 19.6026 20.828 19.414L17.176 15.762C18.164 14.5086 18.7792 13.0024 18.9511 11.4157C19.123 9.82905 18.8448 8.22602 18.1482 6.79009C17.4517 5.35417 16.3649 4.14336 15.0123 3.29623C13.6597 2.44911 12.096 1.99989 10.5 2ZM4 10.5C4 8.77609 4.68482 7.12279 5.90381 5.90381C7.12279 4.68482 8.77609 4 10.5 4C12.2239 4 13.8772 4.68482 15.0962 5.90381C16.3152 7.12279 17 8.77609 17 10.5C17 12.2239 16.3152 13.8772 15.0962 15.0962C13.8772 16.3152 12.2239 17 10.5 17C8.77609 17 7.12279 16.3152 5.90381 15.0962C4.68482 13.8772 4 12.2239 4 10.5Z"
                          fill="black" />
                </svg>
            </div>
        </div>
        <span class="vertical-line"></span>
        <div class="contact-info">
            <div class="contact-info-item">
                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.4323 11.5928L12.17 11.3184C11.904 11.2852 11.6343 11.3165 11.3813 11.4099C11.1283 11.5034 10.8986 11.6565 10.7093 11.8578L9.07041 13.5991C6.54193 12.2328 4.48677 10.0492 3.20082 7.36264L4.84858 5.61188C5.23157 5.20495 5.41862 4.63714 5.35627 4.05986L5.09797 1.67505C5.04747 1.21339 4.83895 0.787591 4.51211 0.478712C4.18527 0.169833 3.76293 -0.00055102 3.32551 1.3388e-06H1.78464C0.778165 1.3388e-06 -0.0590758 0.889574 0.0032719 1.95895C0.475333 10.0408 6.55869 16.495 14.1562 16.9965C15.1627 17.0628 15.9999 16.1732 15.9999 15.1038V13.4666C16.0088 12.5108 15.3319 11.7064 14.4323 11.5928Z"
                        fill="#FD8002" />
                </svg>
                <p>+7 (999) 999-99-99</p>
            </div>
            <div class="contact-info-item">
                <svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.9 14C1.3775 14 0.930051 13.8285 0.557651 13.4855C0.185251 13.1425 -0.00063172 12.7307 1.6129e-06 12.25V1.75C1.6129e-06 1.26875 0.186202 0.856626 0.558602 0.513626C0.931001 0.170626 1.37813 -0.000581848 1.9 1.48557e-06H17.1C17.6225 1.48557e-06 18.0699 0.171501 18.4423 0.514501C18.8147 0.857501 19.0006 1.26933 19 1.75V12.25C19 12.7312 18.8138 13.1434 18.4414 13.4864C18.069 13.8294 17.6219 14.0006 17.1 14H1.9ZM9.5 7.875L17.1 3.5V1.75L9.5 6.125L1.9 1.75V3.5L9.5 7.875Z"
                        fill="#FD8002" />
                </svg>
                <p>regionselect@mail.ru</p>
            </div>
        </div>
        <span class="vertical-line"></span>
        <div class="user-controls">
            <div class="user-control-btn phone-mob">
                <svg width="19" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.4323 11.5928L12.17 11.3184C11.904 11.2852 11.6343 11.3165 11.3813 11.4099C11.1283 11.5034 10.8986 11.6565 10.7093 11.8578L9.07041 13.5991C6.54193 12.2328 4.48677 10.0492 3.20082 7.36264L4.84858 5.61188C5.23157 5.20495 5.41862 4.63714 5.35627 4.05986L5.09797 1.67505C5.04747 1.21339 4.83895 0.787591 4.51211 0.478712C4.18527 0.169833 3.76293 -0.00055102 3.32551 1.3388e-06H1.78464C0.778165 1.3388e-06 -0.0590758 0.889574 0.0032719 1.95895C0.475333 10.0408 6.55869 16.495 14.1562 16.9965C15.1627 17.0628 15.9999 16.1732 15.9999 15.1038V13.4666C16.0088 12.5108 15.3319 11.7064 14.4323 11.5928Z"
                        fill="#929292" />
                </svg>
            </div>
            <div class="user-control-btn profile">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 4.97368C5 7.71584 7.24333 9.94737 10 9.94737C12.7567 9.94737 15 7.71584 15 4.97368C15 2.23153 12.7567 0 10 0C7.24333 0 5 2.23153 5 4.97368ZM20 21V19.8947C20 15.6295 16.51 12.1579 12.2222 12.1579H7.77778C3.48889 12.1579 0 15.6295 0 19.8947V21H20Z"
                        fill="#929292" />
                </svg>
                <div class="user-controls-hidden-items register-items">
                    <button onclick="location.href = '{{route('login')}}';">Войти по Email</button>
                    <a href="#" onclick="location.href = '{{route('register')}}';">Создать аккаунт</a>
                    <a href="#" onclick="location.href = 'templates/personal-account.html';" style="line-height: 12px;">Личный кабинет</a>
                    <a href="#" onclick="location.href = 'templates/personal-seller-account.html';" style="line-height: 12px;">Личный кабинет продавца</a>
                    <a href="#" onclick="location.href = 'templates/personal-admin-account.html';" style="line-height: 12px;">Личный кабинет администратора</a>
                </div>
                <!-- <div class="user-controls-hidden-items logedin-items">
                    <a href="#">Личный кабинет</a>
                    <a href="#">Лист ожидания</a>
                    <a href="#">Мои вопросы</a>
                    <a href="#">Выйти</a>
                </div> -->
            </div>
            <div class="user-control-btn favorite" onclick="location.href = 'templates/favorite-products.html';">
                <svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18.033 0C15.6511 0 13.6159 1.70992 12.4977 2.88877C11.3795 1.70992 9.34886 0 6.96818 0C2.86477 0 0 2.88076 0 7.00447C0 11.5482 3.55795 14.4851 7 17.3258C8.625 18.6683 10.3068 20.0555 11.5966 21.5937C11.8136 21.8512 12.1318 22 12.4659 22H12.5318C12.867 22 13.1841 21.8501 13.4 21.5937C14.692 20.0555 16.3727 18.6672 17.9989 17.3258C21.4398 14.4862 25 11.5494 25 7.00447C25 2.88076 22.1352 0 18.033 0Z"
                        fill="#929292" />
                </svg>
            </div>
        </div>
    </div>
</div>

@yield('content')

<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-links">
                <div class="links-by-parts">
                    <p>Покупателям</p>
                    <a href="#">Правила использования площадки</a>
                    <a href="#">Пользовательское соглашение</a>
                    <a href="#">Политика конфиденциальности</a>
                    <a href="#">Вопросы и ответы</a>
                </div>
                <div class="links-by-parts">
                    <p>Партнёрам</p>
                    <a href="#">Сотрудничайте с Regionselect</a>
                    <a href="#">Пользовательское соглашение с продавцами</a>
                </div>
                <div class="links-by-parts">
                    <p>Компания</p>
                    <a href="#">О нас</a>
                    <a href="#">Реквизиты</a>
                    <a href="#">Контакты</a>
                    <a href="#">Вакансии</a>
                </div>
            </div>
            <a href="templates/store-register.html" class="mobile-store-sale">Продавайте на Regionselect</a>
            <div class="email-notification">
                <h2>ПРИСОЕДИНЯЙТЕСЬ!</h2>
                <p>Подпишитесь на наши новости и узнавайте первыми все акции и предлоджения </p>
                <div class="notification-btn">
                    <input type="text" placeholder="Ваш Email">
                    <button>Подписаться</button>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="/assets/script/main.js"></script>
<script src="/assets/script/swiper9.js"></script>
<script src="/assets/script/slider.js"></script>
@yield('scripts')
</body>

</html>
