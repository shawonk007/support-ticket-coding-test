<x-layouts.app>

  <x-slot name="title" >{{ $title ?: __('Default') }}</x-slot>

  <x-partials.breadcrumb :heading="$title" :breadcrumbs="[['title' => 'Tickets', 'route' => 'tickets.index'], ['title' => 'Index']]" />

  <section class="row mb-5" >
    <div class="col-sm-12" >
      <a href="{{ route('tickets.index') }}" class="btn btn-primary" >{{ __('Home') }}</a>
      <a href="{{ route('tickets.opened') }}" class="btn btn-outline-primary" >{{ __('Requests (' . $request . ')') }}</a>
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
                    @if ( $ticket->status === 'open' )
                      <a href="{{ route('tickets.history', $ticket->id) }}" class="btn btn-sm btn-warning view me-2" >
                        <i class="fas fa-eye"></i>
                      </a>
                    @endif
                    <form method="POST" action="{{ route('tickets.closed', $ticket->id) }}" >
                      @csrf
                      @method('patch')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="event.preventDefault();this.closest('form').submit();" @if ( $ticket->status === 'close' ) disabled @endif >
                        <i class="fas fa-trash-alt" ></i>
                      </button>
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
