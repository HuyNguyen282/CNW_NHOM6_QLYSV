@props(['title', 'subtitle' => null, 'href' => null, 'label' => null])
<div class="page-head">
    <div>
        <h1 class="page-title">{{ $title }}</h1>
        @if($subtitle)<p class="page-sub">{{ $subtitle }}</p>@endif
    </div>
    @if($href)<a href="{{ $href }}" class="btn-primary-soft">+ {{ $label }}</a>@endif
</div>
