@php
    try {
        $siteName = \App\Models\SeoSetting::current()->site_name ?? 'LevelMinds';
    } catch (\Throwable $e) {
        $siteName = 'LevelMinds';
    }
@endphp
<header class="bg-white shadow-md">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <a href="/" class="flex items-center space-x-2 text-2xl font-bold text-blue-600">
      <img src="{{ asset('images/branding/logo.svg') }}" alt="LevelMinds logo" class="h-10">
      <span>{{ $siteName }}</span>
    </a>
    <nav class="space-x-6 text-gray-700 font-medium">
      <a href="/" class="hover:text-blue-600">Home</a>
      <a href="/team" class="hover:text-blue-600">Team</a>
      <a href="/tour" class="hover:text-blue-600">Tour</a>
      <a href="/careers" class="hover:text-blue-600">Careers</a>
      <a href="/contact" class="hover:text-blue-600">Contact</a>
      <a href="/blog" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Blog</a>
      <a href="https://lmap.in/signup" target="_blank" rel="noopener" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-2 rounded-md hover:opacity-90 transition">
        Login / Sign Up
      </a>
    </nav>
  </div>
</header>
