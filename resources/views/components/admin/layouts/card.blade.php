<x-admin.layouts.master>

    <x-slot name="pageTitle">@if(isset($pageTitle) && $pageTitle->isNotEmpty()) {{ $pageTitle }} @endif</x-slot>
    <x-slot name="styles">@if(isset($styles) && $styles->isNotEmpty()) {{ $styles }} @endif</x-slot>
    <x-slot name="breadcrumb">@if(isset($breadcrumb) && $breadcrumb->isNotEmpty()) {{ $breadcrumb }} @endif</x-slot>

    <div class="card card-default color-palette-box">
        <div class="card-header">
            <h3 class="card-title">
                @if(isset($cardHeader) && $cardHeader->isNotEmpty()) {{ $cardHeader }} @endif
            </h3>
        </div>
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>

    <x-slot name="scripts">@if(isset($scripts) && $scripts->isNotEmpty()) {{ $scripts }} @endif</x-slot>
</x-admin.layouts.master>
