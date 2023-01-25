<!--
=========================================================
* Argon Design System - v1.2.2
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-design-system
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="fzFKGo8f_Fn_dHBTgnFcAD-jxpJ5XJQea2oOP4UVmaY" />
    <link rel="apple-touch-icon" href="./assets/img/apple-icon.svg" type="image/svg+xml">
    <link rel="icon" href="./assets/img/favicon.svg" type="image/svg+xml">
    <title>
        @yield('title')
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="./assets/css/font-awesome.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="./assets/css/argon-design-system-change.css" rel="stylesheet" />
    <link href="./assets/css/piano.css" rel="stylesheet">

</head>

<body>
    <header>
  </header>
  <div>
                            @yield('content')
                        </div>
                        <footer>
                          <a onclick="location.href='/'">トップページ</a><br>
                            <a onclick="location.href='privacypolicy'">個人情報の取り扱いについて</a><br>
                          <a onclick="location.href='labolatory'">長谷川(光)・鶴田研究室とは？</a><br>
                          <a onclick="location.href='tame'">研究テーマについて</a><br>
                          <a onclick="location.href='link'">お問い合わせ</a><br>
                          <p class="message_font_weight_bold">宇都宮大学 長谷川(光)・鶴田研究室 絶対音感テスト</p>
                          <div align=right><p class="message_font_weight_bold">ap-test＠sound.is.utsunumiya-u.ac.jp</p></div>
                        </footer>
                        </body>
                        </html>