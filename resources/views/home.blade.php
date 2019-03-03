<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart Hospital by PIREHO</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
<div id="app"></div>
</body>
<script src="/js/app.js"></script>
    <script src='https://www.amcharts.com/lib/3/amcharts.js'></script>
    <script src='https://www.amcharts.com/lib/3/serial.js'></script>
</html>