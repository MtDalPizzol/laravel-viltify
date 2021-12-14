<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <title>{{ config('app.name') }}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
  @routes
</head>

<body>
  <noscript>
    <strong>We're sorry but {{ config('app.name') }} doesn't work properly without JavaScript enabled. Please enable it
      to continue.</strong>
  </noscript>
  @inertia
  <!-- built files will be auto injected -->
</body>

</html>