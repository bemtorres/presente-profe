<div class="col-12">
  <div class="row mb-2">
    <div class="col-auto">
      <h3 class="pp-page-title mb-0">

        @if (!empty($route))
        <a href="{{ $route }}" class="text-{{ $color ?? 'dark' }} align-middle me-2">
          <i class="fas fa-arrow-circle-left"></i>
        </a>
        @endif
        @if (!empty($icon))
          <i class="{{ $icon ?? '' }}"></i>
        @endif
        {!! $body ?? '' !!}
        @if (!empty($url_btn))
          <a class="btn app-btn-secondary btn-xs" href="{{ $url_btn }}">{{ $url_text ?? 'Ir' }}</a>
        @endif
      </h3>


    </div>
  </div>
</div>
