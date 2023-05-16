<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8">

    <meta name="robots" content="noindex, nofollow">


    <title>{{ config('app.name', 'Laravel') }} - {{ __("Oops! That page can't be found.") }} - 404</title>

    
    <style>
        .container {
        margin: auto;
        max-width: 600px;
        text-align: center;
        }

        h1 {
        font-size: 48px;
        margin-bottom: 20px;
        }

        a {
        color: #000;
        text-decoration: none;
        font-weight: bold;
        border: 2px solid #000;
        padding: 10px 20px;
        display: inline-block;
        margin-top: 20px;
        }

        a:hover {
        background-color: #000;
        color: #fff;
        }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>{{ __("Oops! That page can't be found.") }}</h1>
      <p>{{ __("Sorry, the page you are looking for cannot be found. It may have been removed, had its name changed, or is temporarily unavailable.") }}</p>
      <a href="{{ url('/') }}">{{ __('Go back to homepage') }}</a>
    </div>
  </body>
</html>