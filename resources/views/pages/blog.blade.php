@extends('layouts.app')
@section('title', 'Blog - LevelMinds')

@section('content')
<section class="max-w-6xl mx-auto py-16 px-6">
  <h1 class="text-4xl font-bold text-center mb-10 text-blue-600">Insights & Stories</h1>

  <div class="grid md:grid-cols-3 gap-8">
    @foreach ($blogs as $blog)
      <a href="/blog/{{ $blog->slug }}" class="bg-white shadow hover:shadow-lg rounded-lg overflow-hidden transition">
        @if($blog->thumbnail_url)
          <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
        @endif
        <div class="p-5">
          <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $blog->title }}</h2>
          <p class="text-sm text-gray-600 mb-4">{{ $blog->excerpt }}</p>
          <div class="text-sm text-gray-500">{{ $blog->views }} views · {{ $blog->likes }} likes</div>
        </div>
      </a>
    @endforeach
  </div>

  <div class="mt-8">
    {{ $blogs->links() }}
  </div>
</section>
@endsection
