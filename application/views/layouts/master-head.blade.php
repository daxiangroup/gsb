<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Group Study Buddy</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-responsive.min.css') }}
    {{ HTML::style('laravel/css/style.css') }}
    {{ HTML::style('css/gsb.css') }}

    {{ Asset::container('page-specific-css-header')->styles() }}
    {{ Asset::container('page-specific-js-header')->scripts() }}
</head>
<body>
    <div class="wrapper">
        <header>
            <h1>Group Study Buddy</h1>
            <h2>GSB Y'all...</h2>

            <p class="intro-text" style="margin-top: 45px;">
            </p>
        </header>

        <div role="navigation">
        @include('layouts/navigation')
        </div>

        <div role="main" class="main">