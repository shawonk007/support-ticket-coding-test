<x-layouts.app>

    <x-slot name="title" >{{ $title ?: __('Default') }}</x-slot>

    <x-partials.breadcrumb :heading="$title" :breadcrumbs="[['title' => 'Dashboard']]" />

    {{ __("You're logged in!") }}

</x-layouts.app>
