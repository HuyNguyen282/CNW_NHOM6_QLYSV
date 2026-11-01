@props(['title'])

<div class="mx-auto" style="max-width: 720px;">
    <x-page-head :title="$title" />
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            {{ $slot }}
        </div>
    </div>
</div>
