<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
        <title>{{ $post['title'] ?? 'Post' }} — Investor Blog</title>
     
    </head>
    <body>
     @include('partials.header')
        <div class="container">
            <div class="hero">
                <h1>{{ $post['title'] ?? 'Post title' }}</h1>
                <div class="meta">{{ $post['date'] ?? '' }} · {{ $post['author'] ?? '' }}</div>
            </div>

            <div class="content">
                {!! nl2br(e($post['content'] ?? '')) !!}
            </div>

            <a class="back" href="{{ url()->previous() ?: url('/') }}">← Back</a>
        </div>
    </body>
</html>
