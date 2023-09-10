<div class="col-12">
  <div class="row mb-2">
    <div class="col-sm-12">
      <h3 class="card-title">

        @if (!empty($route))
        <a href="{{ $route }}" class="text-{{ $color ?? 'dark' }} align-middle me-2"><i class="fas fa-arrow-circle-left"></i></a>@endif @if (!empty($icon)) <i class="{{ $icon ?? '' }}"></i>@endif{!! $body ?? '' !!}
      </h3>
    </div>
  </div>
</div>
