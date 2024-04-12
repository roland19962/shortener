<!doctype html>
<html lang="en">
<head itemscope itemtype="http://schema.org/WPHeader">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/sass/app.sass', 'resources/js/app.js'])

    <title itemprop="headline">shortener</title>
    <meta itemprop="description" name="description" content="">
    <meta itemprop="description" property="og:description" content=""/>
    <meta itemprop="description" name="twitter:description" content=""/>
    <meta itemprop="description" name="twitter:text:description" content=""/>
    <meta itemprop="keywords" name="keywords" content="" />

</head>
<body>
<div id="app" class="page-container">
    <h1>Not found current url</h1>
</div>
</body>
</html>
