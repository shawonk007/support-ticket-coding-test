<x-layouts.app>

  <x-slot name="title" >{{ $title ?: __('Default') }}</x-slot>

  <x-partials.breadcrumb :heading="$title" :breadcrumbs="[['title' => 'Tickets', 'route' => 'tickets.index'], ['title' => 'Index']]" />

  <section class="row mb-5" >
    <div class="col-sm-12" >
      <a href="{{ route('tickets.index') }}" class="btn btn-outline-primary" >{{ __('Home') }}</a>
      <a href="{{ route('tickets.opened') }}" class="btn btn-primary" >{{ __('Requests (' . $tickets->where('status', 'open')->count() . ')') }}</a>
    </div>
  </section>

  <x-partials.alert />

  <section class="row" >
    <div class="col-sm-12" >
      <div class="card bg-white border-0 rounded-0 shadow" >
        <div class="card-header bg-white">
          <h5 class="card-title">{{ __('Manage Tickets') }}</h5>
        </div>
        <div class="card-body">
          <table class="table table-striped table-hoverable">
            <thead class="table-dark" >
              <tr>
                <th class="d-none d-xl-table-cell" >{{ __('SL') }}</th>
                <th width="300" >{{ __('Customer Name') }}</th>
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
                  <td>
                    <strong>{{ $ticket->customer->name }}</strong>
                  </td>
                  <td class="d-none d-md-table-cell" >
                    <a href="javascript:void(0);" class="text-muted" >{{ $ticket->title }}</a>
                  </td>
                  <td class="d-none d-xl-table-cell" >
                    <span class="badge bg-{{ $ticket->status === 'close' ? 'danger' : 'warning' }}" >{{ ucfirst($ticket->status) }}</span>
                  </td>
                  <td class="d-none d-xl-table-cell" >{{ $ticket->created_at->diffForHumans() }}</td>
                  <td class="d-flex" >
                    <button class="btn btn-sm btn-warning view me-2" data-ticket="{{ $ticket->title }}" data-code="{{ $ticket->code }}" data-description="{{ $ticket->description }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >
                      <i class="fas fa-eye"></i>
                    </button>
                    <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" >
                      @csrf
                      @method('patch')
                      <a href="{{ route('tickets.update', $ticket->id) }}" class="btn btn-sm btn-secondary" onclick="event.preventDefault();this.closest('form').submit();" >
                        <i class="fas fa-check" ></i>
                      </a>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center" >
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
    <div class="modal-header" >
      <h1 class="modal-title fs-5" id="staticBackdropLabel" >{{ __('View Ticket') }}</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
    </div>
    <div class="modal-body" >
      <div class="row g-3" >
        <div class="col-12" >
          <label for="title" >
            <strong>{{ __('Title') }}</strong>
          </label>
          <p id="title" ></p>
        </div>
        <div class="col-12" >
          <label for="title" >
            <strong>{{ __('Code') }}</strong>
          </label>
          <p id="code" ></p>
        </div>
        <div class="col-12" >
          <label for="description" >
            <strong>{{ __('Description') }}</strong>
          </label>
          <p id="description" ></p>
        </div>
      </div>
    </div>
  </x-partials.modal>

  <x-slot name="scripts" >
    <script>
      $(document).ready( function () {
        $('.view').click( function() {
          var title = $(this).data('ticket');
          var code = $(this).data('code');
          var description = $(this).data('description');
          $('#title').html(title);
          $('#code').html(code);
          $('#description').html(description);
        });
      });
    </script>
  </x-slot>

</x-layouts.app>
