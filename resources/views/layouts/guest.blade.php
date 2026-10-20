
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CampusVoice') }} — Masuk</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            min-height: 100%;
            margin: 0;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            color: #172033;
            -webkit-font-smoothing: antialiased;
        }

        button, input {
            font: inherit;
        }

        .cv-page {
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 42px 20px 28px;
            background: linear-gradient(
                180deg,
                #ad151c 0%,
                #913035 40%,
                #55565b 100%
            );
        }

        .cv-brand {
            text-align: center;
            margin-bottom: 26px;
            color: #fff;
        }

        .cv-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .cv-logo-mark {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: rgba(255, 255, 255, .12);
            color: #fff;
            flex-shrink: 0;
        }

        .cv-logo-mark svg {
            width: 27px;
            height: 27px;
        }

        .cv-logo-name {
            font-size: 25px;
            line-height: 1.2;
            font-weight: 700;
            letter-spacing: -.7px;
            color: #fff;
        }

        .cv-logo-name span {
            color: #fff;
        }

        .cv-tagline {
            margin: 0;
            color: rgba(255, 255, 255, .95);
            font-size: 13px;
            line-height: 1.6;
        }

        .cv-card {
            width: 100%;
            max-width: 480px;
            background: #fff;
            border-radius: 16px;
            padding: 38px 36px 36px;
            box-shadow: 0 12px 35px rgba(30, 15, 20, .08);
        }

        .cv-heading {
            margin: 0 0 5px;
            text-align: center;
            color: #151c2e;
            font-size: 25px;
            line-height: 1.35;
            font-weight: 700;
            letter-spacing: -.6px;
        }

        .cv-subheading {
            margin: 0 0 29px;
            text-align: center;
            color: #71809a;
            font-size: 13px;
            line-height: 1.6;
        }

        .cv-field {
            margin-bottom: 20px;
        }

        .cv-label {
            display: block;
            margin-bottom: 9px;
            color: #34425b;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .2px;
        }

        .cv-input-wrap {
            display: flex;
            align-items: center;
            width: 100%;
            min-height: 46px;
            border: 1px solid #dce4ef;
            border-radius: 13px;
            background: #f7f9fc;
            transition: border-color .2s, box-shadow .2s;
        }

        .cv-input-wrap:focus-within {
            border-color: #df292d;
            box-shadow: 0 0 0 3px rgba(223, 41, 45, .08);
        }

        .cv-input-icon {
            display: block;
            width: 19px;
            height: 19px;
            margin-left: 13px;
            flex-shrink: 0;
            color: #8da0bd;
        }

        .cv-input {
            display: block;
            width: 100%;
            min-width: 0;
            height: 44px;
            padding: 0 12px;
            border: none !important;
            border-radius: 12px;
            outline: none !important;
            box-shadow: none !important;
            background: transparent !important;
            color: #243149;
            font-size: 13px;
        }

        .cv-input::placeholder {
            color: #9aa7ba;
            opacity: 1;
        }

        .cv-password-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            margin-right: 3px;
            padding: 0;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #8da0bd;
            cursor: pointer;
        }

        .cv-password-toggle:hover {
            color: #df292d;
        }

        .cv-password-toggle svg {
            width: 19px;
            height: 19px;
        }

        .cv-hint {
            margin: 7px 0 0;
            color: #8fa0bc;
            font-size: 10px;
            line-height: 1.6;
        }

        .cv-error {
            margin: 7px 0 0;
            color: #c5222b;
            font-size: 11px;
            line-height: 1.5;
        }

        .cv-error-box {
            margin-bottom: 18px;
            padding: 11px 13px;
            border: 1px solid #f2c4c7;
            border-radius: 9px;
            background: #fff4f4;
            color: #b91c27;
            font-size: 12px;
            line-height: 1.6;
        }

        .cv-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 2px 0 22px;
        }

        .cv-remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #52617a;
            font-size: 11px;
            cursor: pointer;
        }

        .cv-remember input {
            appearance: none;
            width: 16px;
            height: 16px;
            margin: 0;
            border: 1px solid #d6dce6;
            border-radius: 4px;
            background: #fff;
            cursor: pointer;
        }

        .cv-remember input:checked {
            border-color: #df292d;
            background: #df292d;
            box-shadow: inset 0 0 0 3px #df292d;
        }

        .cv-remember input:checked::after {
            content: "✓";
            display: block;
            margin-top: -1px;
            color: #fff;
            text-align: center;
            font-size: 12px;
            font-weight: 700;
        }

        .cv-link {
            color: #e32229;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
        }

        .cv-link:hover {
            color: #ae161d;
            text-decoration: underline;
        }

        .cv-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 48px;
            padding: 13px 16px;
            border: 0;
            border-radius: 12px;
            background: #df292d;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .2px;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .cv-submit:hover {
            background: #c81f26;
        }

        .cv-submit:active {
            transform: scale(.99);
        }

        .cv-submit svg {
            width: 17px;
            height: 17px;
        }

        .cv-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 23px 0;
            color: #a0aabe;
            font-size: 10px;
        }

        .cv-divider::before,
        .cv-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #edf0f5;
        }

        .cv-register {
            margin: 0;
            text-align: center;
            color: #64738b;
            font-size: 11px;
            line-height: 1.6;
        }

        .cv-register a {
            margin-left: 3px;
        }

        .cv-role {
            display: table;
            margin: 23px auto 0;
            padding: 7px 13px;
            border: 1px solid #fde0e0;
            border-radius: 30px;
            background: #fff0f0;
            color: #d91f27;
            font-size: 10px;
            font-weight: 600;
        }

        .cv-role-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .cv-role svg {
            width: 14px;
            height: 14px;
        }

        .cv-footer {
            width: 100%;
            max-width: 480px;
            margin-top: 28px;
            text-align: center;
            color: rgba(255, 255, 255, .9);
            font-size: 11px;
            line-height: 1.7;
        }

        .cv-footer strong {
            font-weight: 600;
        }

        @media (max-width: 520px) {
            .cv-page {
                justify-content: flex-start;
                padding: 34px 16px 24px;
            }

            .cv-brand {
                margin-bottom: 24px;
            }

            .cv-logo-name {
                font-size: 24px;
            }

            .cv-card {
                padding: 30px 23px 28px;
                border-radius: 14px;
            }

            .cv-footer {
                margin-top: 22px;
            }
        }

        @media (max-height: 820px) and (min-width: 521px) {
            .cv-page {
                padding-top: 25px;
                padding-bottom: 20px;
            }

            .cv-brand {
                margin-bottom: 20px;
            }

            .cv-card {
                padding-top: 30px;
                padding-bottom: 28px;
            }

            .cv-footer {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <main class="cv-page">
        {{ $slot }}
    </main>
</body>
</html>
