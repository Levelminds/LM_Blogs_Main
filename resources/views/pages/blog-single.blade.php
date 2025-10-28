@extends('layouts.app')
@section('title', $blog->title)

@section('content')
<section class="max-w-4xl mx-auto py-16 px-6">
  <h1 class="text-4xl font-bold mb-4 text-blue-600">{{ $blog->title }}</h1>
  <p class="text-gray-500 mb-6">{{ $blog->views }} views · {{ $blog->likes }} likes</p>
  @if($blog->thumbnail_url)
    <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}" class="w-full rounded-lg mb-6">
  @endif
  <div class="prose max-w-none">{!! nl2br(e($blog->content)) !!}</div>
</section>
@endsection
    