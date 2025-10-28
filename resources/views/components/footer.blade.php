@php
    try {
        $siteName = \App\Models\SeoSetting::current()->site_name ?? 'LevelMinds';
    } catch (\Throwable $e) {
        $siteName = 'LevelMinds';
    }
@endphp
<footer class="bg-gray-100 border-t mt-12">
  <div class="max-w-7xl mx-auto px-6 py-6 text-center text-sm text-gray-600 flex flex-col items-center gap-2">
    <img src="{{ asset('images/branding/logo.svg') }}" alt="{{ $siteName }}" class="h-8">
    <span>&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</span>
  </div>
</footer>
