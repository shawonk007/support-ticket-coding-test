<x-layouts.app>

    <x-slot name="title" >{{ $title ?: __('Default') }}</x-slot>

    <x-partials.breadcrumb :heading="$title" :breadcrumbs="[['title' => 'Dashboard']]" />

    <section class="row g-3" >
      @foreach ($widgets as $widget)
        <div class="col-6 col-md-6 col-xl-3" >
          <div class="card bg-white border-0 rounded-0 shadow" >
            <div class="card-body pt-1 pb-3" >
              <div class="row" >
                <div class="col-12 mb-1" >
                  <h5 class="border-bottom pb-2" >{{ $widget['title'] }}</h5>
                </div>
                <div class="col-5 col-xl-4" >
                  <button class="btn btn-lg btn-{{ $widget['theme'] ?: __('secondary') }} rounded-0 fs-4 w-100" >
                    <i class="fas fa-{{ $widget['icon'] ?: __('font-awesome') }} text-white" ></i>
                  </button>
                </div>
                <div class="col-7 col-xl-8 text-end" >
                  <h1>{{ $widget['data'] ?: __('0') }}</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </section>

</x-layouts.app>
