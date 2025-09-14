<div class="card card-default color-palette-box">
    @if(!empty($cardHeader))
        <div class="card-header">
            <h3 class="card-title">
                {{ $cardHeader }}
            </h3>
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
