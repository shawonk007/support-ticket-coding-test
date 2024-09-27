@props(['heading' => 'Default', 'breadcrumbs' => []])

<section class="card bg-white border-0 rounded-0 shadow mb-5" >
  <div class="card-body d-block d-sm-flex justify-content-between pt-2 pb-0" >
    <h4 class="fw-5" >
      <strong>{{ $heading }}</strong>
    </h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" >
      <ol class="breadcrumb" >
        <li class="breadcrumb-item" ><a href="{{ route('admin.dashboard') }}">Home</a></li>
        @foreach ($breadcrumbs as $breadcrumb)
          @if ($loop->last)
            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
          @else
            <li class="breadcrumb-item"><a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['title'] }}</a></li>
          @endif
        @endforeach
      </ol>
    </nav>
  </div>
</section>
