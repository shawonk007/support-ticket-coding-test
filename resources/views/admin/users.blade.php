<x-layouts.app>

  <x-slot name="title" >{{ $title ?: __('Default') }}</x-slot>

  <x-partials.breadcrumb :heading="$title" :breadcrumbs="[['title' => 'Users', 'route' => 'users.index'], ['title' => 'Index']]" />

  <section class="row" >
    <div class="col-sm-12" >
      <div class="card bg-white border-0 rounded-0 shadow" >
        <div class="card-header bg-white">
          <h5 class="card-title">{{ __('Manage Users') }}</h5>
        </div>
        <div class="card-body">
          <table class="table table-striped table-hoverable">
            <thead class="table-dark" >
              <tr>
                <th class="d-none d-xl-table-cell" >{{ __('SL') }}</th>
                <th width="300" >{{ __('Name') }}</th>
                <th class="d-none d-md-table-cell" width="300" >{{ __('Email') }}</th>
                <th class="d-none d-xl-table-cell" >{{ __('Joined Date') }}</th>
                <th width="130" >{{ __('Action') }}</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
                <tr>
                  <td class="d-none d-xl-table-cell" >{{ $loop->iteration }}</td>
                  <td>
                    <strong>{{ $user->name }}</strong>
                  </td>
                  <td class="d-none d-md-table-cell" >
                    <a href="javascript:void(0);" class="text-muted" >{{ $user->email }}</a>
                  </td>
                  <td class="d-none d-xl-table-cell" >{{ $user->created_at->diffForHumans() }}</td>
                  <td>
                    <button class="btn btn-sm btn-info" >
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-warning" >
                      <i class="fas fa-eye"></i>
                    </button>
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

</x-layouts.app>
