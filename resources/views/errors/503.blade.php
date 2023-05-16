<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">

        <meta name="robots" content="noindex, nofollow">

        <title>{{ config('app.name', 'Laravel') }} - {{ __("Be right back.") }} - 404</title>

        <style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
			font-size: 16px;
			color: #333;
			text-align: center;
			padding-top: 100px;
		}
		h1 {
			font-size: 48px;
			margin-bottom: 30px;
		}
		p {
			font-size: 24px;
			margin-bottom: 50px;
		}
        </style>
    </head>
    <body>

        <h1>{{ __("Be right back.") }}</h1>
	    <p>{{ __('We are currently undergoing maintenance and will be back shortly.')}}</p>
        <p>{{ __('Thank you for your patience.') }}</p>


    </body>
</html>