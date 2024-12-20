@if (session('status'))
    <div {{ $attributes->merge(['class' => 'alert alert-success']) }}>
        {{ session('status') }}
    </div>
@endif