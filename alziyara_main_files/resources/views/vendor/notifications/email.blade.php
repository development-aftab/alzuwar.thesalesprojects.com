@component('mail::message')
{{-- Greeting --}}
{{--@if (! empty($greeting))--}}
{{--# {{ $greeting }}--}}
{{--@else--}}
{{--@if ($level == 'error')--}}
{{--# @lang('Whoops!')--}}
{{--@else--}}
{{--# @lang('Hello!')--}}
{{--@endif--}}
{{--@endif--}}

{{-- Intro Lines --}}
{{--@foreach ($introLines as $line)--}}
{{--{{ $line }}--}}

{{--@endforeach--}}

{{-- Action Button --}}
{{--@isset($actionText)--}}
<?php
//    switch ($level) {
//        case 'success':
//            $color = 'green';
//            break;
//        case 'error':
//            $color = 'red';
//            break;
//        default:
//            $color = 'blue';
//    }
?>
{{--<!DOCTYPE html>--}}
<html lang="en">
<head>
    <title>Forgot Your Password?</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; }
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; width:90px;}
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
        a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }
        u + #body a { color: inherit; text-decoration: none; font-size: inherit; font-family: inherit; font-weight: inherit; line-height: inherit; }
        #MessageViewBody a { color: inherit; text-decoration: none; font-size: inherit; font-family: inherit; font-weight: inherit; line-height: inherit; }
        a { color: #B200FD; font-weight: 600; text-decoration: underline; }
        a:hover { color: #000000 !important; text-decoration: none !important; }
        @media screen and (min-width:600px) {
            h1 { font-size: 48px !important; line-height: 48px !important; }
            .intro { font-size: 24px !important; line-height: 36px !important; }
        }
    </style>
</head>
<body style="margin: 0 !important; padding: 0 !important;">
<div style="display: none; max-height: 0; overflow: hidden;">
</div>
<div style="display: none; max-height: 0px; overflow: hidden;">
    &nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;
</div>
<table cellspacing="0" cellpadding="0" border="0" width="600" align="center" role="presentation">
    <tr>
        <td>
            <div role="article" aria-label="An email from AlZuwar" lang="en" style="background-color: white; color: #2b2b2b; font-family: 'Avenir Next', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-size: 18px; font-weight: 400; line-height: 28px; margin: 0 auto; max-width: 600px; padding: 40px 20px 40px 20px;">
                <header>
                    <a href="">
                        <center>
                            <img  src="{{asset('website/img/alziyara_white_background_logo.png')}}" alt="AlZuwar.com">
                        </center>
                    </a>
                    <h1 style="color: #000000; font-size: 32px; font-weight: 800; line-height: 32px; margin: 48px 0; text-align: center;">Forgot Your Password?</h1>
                </header>
                <main>
                    <div style="background-color: ghostwhite; border-radius: 4px; padding: 24px 48px;">
                        <table cellspacing="0" cellpadding="0" border="0" width="600" align="center" role="presentation">
                            <tr>
                                <td style="background-color: ghostwhite;font-family: 'Avenir Next', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; padding: 24px 48px 24px 48px;">
                                    <p>If you've lost your password or wish to reset it, use the link below to get started.</p>
                                    <a href="{{$actionUrl}}" style="color: #B200FD; text-decoration: underline;">Reset Your Password</a>
                                    <p>If that doesn't work, copy and paste the following link in your browser:<br /><br /><a href="{{$actionUrl}}" style="color: #B200FD; text-decoration: underline;">{{$actionUrl}}</a></p>
                                    <p>if you did not request a password reset, you can safely ignore this email. Only a person with access to your email can reset your account password.</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </main>
                <footer>
                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; margin-top: 48px;">You received this email because someone (hopefully you!) has requested to reset the password at <strong><a href="https://{servername}">AlZuwar.com</a></strong></p>
                </footer>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
{{--@component('mail::button', ['url' => $actionUrl, 'color' => $color])--}}
{{--{{ $actionText }}--}}
{{--@endcomponent--}}
{{--@endisset--}}

{{-- Outro Lines --}}
{{--@foreach ($outroLines as $line)--}}
{{--{{ $line }}--}}
{{--@endforeach--}}

{{-- Salutation --}}
{{--@if (! empty($salutation))--}}
{{--{{ $salutation }}--}}
{{--@else--}}
{{--@lang('Regards'),<br>{{ config('app.name') }}--}}
{{--@endif--}}

{{-- Subcopy --}}
{{--@isset($actionText)--}}
{{--@component('mail::subcopy')--}}
{{--@lang(--}}
    {{--"If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".--}}
    {{--'into your web browser: [:actionURL](:actionURL)',--}}
    {{--[--}}
        {{--'actionText' => $actionText,--}}
        {{--'actionURL' => $actionUrl--}}
    {{--]--}}
{{--)--}}
{{--@endcomponent--}}
{{--@endisset--}}
@endcomponent
