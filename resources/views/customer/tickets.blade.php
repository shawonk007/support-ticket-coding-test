<x-layouts.app>

  <x-slot name="title" >{{ $title ?: __('Default') }}</x-slot>

  <x-partials.breadcrumb :heading="$title" :breadcrumbs="[['title' => 'Tickets', 'route' => 'tickets.index'], ['title' => 'Index']]" />

  <x-partials.alert />

  <section class="row mb-5" >
    <div class="col-sm-12" >
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >
        <i class="fas fa-plus me-2"></i>
        <span>{{ __('Open Ticket') }}</span>
      </button>
    </div>
  </section>

  <section class="row" >
    <div class="col-sm-12" >
      <div class="card bg-white border-0 rounded-0 shadow" >
        <div class="card-header bg-white">
          <h5 class="card-title">{{ __('Manage Customers') }}</h5>
        </div>
        <div class="card-body">
          <table class="table table-striped table-hoverable">
            <thead class="table-dark" >
              <tr>
                <th class="d-none d-xl-table-cell" >{{ __('SL') }}</th>
                <th class="d-none d-md-table-cell" width="300" >{{ __('Title') }}</th>
                <th class="d-none d-md-table-cell" >{{ __('Status') }}</th>
                <th class="d-none d-xl-table-cell" >{{ __('Created Date') }}</th>
                <th width="90" >{{ __('Action') }}</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($tickets as $ticket)
                <tr>
                  <td class="d-none d-xl-table-cell" >{{ $loop->iteration }}</td>
                  <td class="d-none d-md-table-cell" >
                    <a href="javascript:void(0);" class="text-muted" >{{ $ticket->title }}</a>
                  </td>
                  <td class="d-none d-xl-table-cell" >
                    <span class="badge bg-{{ $ticket->status === 'close' ? 'danger' : 'warning' }}" >{{ ucfirst($ticket->status) }}</span>
                  </td>
                  <td class="d-none d-xl-table-cell" >{{ $ticket->created_at->diffForHumans() }}</td>
                  <td>
                    @if ( $ticket->status === 'open' )
                      <a href="{{ route('tickets.messages', $ticket->id) }}" class="btn btn-sm btn-warning" >
                        <i class="fas fa-eye"></i>
                      </a>
                    @endif
                    <button class="btn btn-sm btn-danger" >
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center" >
                    <span>{{ __('No Data Found') }}</span>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-footer bg-white pt-3 pb-0">
          <x-partials.pagination />
        </div>
      </div>
    </div>
  </section>

  <x-partials.modal>
    <form action="{{ route('tickets.store') }}" method="POST" >
      @csrf
      <div class="modal-header" >
        <h1 class="modal-title fs-5" id="staticBackdropLabel" >{{ __('Open Ticket') }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div class="modal-body" >
        <div class="row g-3" >
          <div class="col-12" >
            <label for="title" >
              <strong>{{ __('Title') }}</strong>
            </label>
            <input type="text" name="title" class="form-control" id="title" required />
          </div>
          <div class="col-12" >
            <label for="description" >
              <strong>{{ __('Description') }}</strong>
            </label>
            <textarea name="description" class="form-control" id="description" cols="30" rows="8" ></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer" >
        <button type="submit" class="btn btn-primary" >{{ __('Submit') }}</button>
      </div>
    </form>
  </x-partials.modal>

</x-layouts.app>
