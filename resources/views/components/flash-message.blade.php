@if (session('status') || session('success') || session('error'))
    @php
        $message = session('error') ?? session('status') ?? session('success');
        $type = session('error') ? 'danger' : 'success';
    @endphp
    <div class="alert alert-{{ $type }}" role="alert">
        {{ $message }}
    </div>
@endif
