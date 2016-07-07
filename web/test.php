<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Email от Pokupon&SuperDeal</title>
    <style type="text/css">
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Trebuchet MS", sans-serif;
        }

        .mail-nav {
            width: 100%;
            background-color: #131a26;
            padding: 16px 0;
            text-align: center;
        }

        .mail-nav h1 {
            color: #fff;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .mail-wrapper {
            padding: 90px 130px;
            background-color: #edf1fc;
        }

        .img-wrapper {
            background-color: transparent;
            text-align: center;
            margin-top: -50px;
            margin-bottom: 70px;
        }

        .conteiner-shadow {
            -webkit-box-shadow: 0px 10px 25px 0px rgba(0, 20, 51, 0.15);
            -moz-box-shadow: 0px 10px 25px 0px rgba(0, 20, 51, 0.15);
            box-shadow: 0px 10px 25px 0px rgba(0, 20, 51, 0.15);
        }

        .mail-container {
            background-color: #fff;
            padding: 50px;
            text-align: center;

        }

        .mail-container {
            -webkit-box-shadow: 0px -12px 25px 0px rgba(255, 255, 255, 0.15);
            -moz-box-shadow: 0px -12px 25px 0px rgba(255, 255, 255, 0.15);
            box-shadow: 0px -12px 25px 0px rgba(255, 255, 255, 0.15);
        }

        .mail-container h2 {
            margin: 0;
            font-size: 28px;
            color: #0f204b;
        }

        .mail-container a.button {
            display: inline-block;
            margin-top: 30px;
            margin-bottom: 50px;
            font-weight: bold;
            color: #fff;
            padding: 11px 28px;
            text-decoration: none;
            background-color: #70bafc;
        }

        .mail-container a.button:hover {
            background-color: #fff200;
            color: #131a26;
        }

        .mail-container p {
            margin: 0;
        }

        .mail-container p a {
            color: #66b3ff;
            text-decoration: underline;
        }

        .mail-container p a:hover {
            text-decoration: none;
        }

        .mail-footer {
            padding: 50px;
            color: #fff;
            background-color: #66b3ff;
            text-align: center;
        }

        .mail-footer a {
            color: #fff;
            text-decoration: underline;
        }

        .mail-footer a:hover {
            text-decoration: none;
        }

        .mail-footer p {
            margin: 0;
        }

        @media print {
            html, body {
                height: auto;
            }
        }
    </style>
</head>
<body>
<div class="mail-nav">
    <h1>Pokupon & SuperDeal</h1>
</div>
<div class="mail-wrapper">
    <div class="img-wrapper">
        <img src="http://self.service:8080/web/img/mail-rocket.png" alt="">
    </div>
    <div class="conteiner-shadow">
        <div class="mail-container">
            <h2>ПЕРЕЙДИТЕ НА СЛЕДУЮЩИЙ ШАГ</h2>
            <a href="#" class="button">Перейти</a>
            <p>Вы получили это письмо, потому что оставили заявку на нашем сайте.
                Если это были не вы, пожалуйста, <a href="#">свяжитесь с нами</a></p>
        </div>
        <div class="mail-footer">
            <p>Вы получили это письмо, потому что оставили заявку на нашем сайте.
                Если это были не вы, пожалуйста, <a href="#">свяжитесь с нами</a></p>
        </div>
    </div>
</div>
</body>
</html>
