@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.settings.affiliate.create-edit', ['city' => $city, 'affiliate' => $affiliate ])
    </div>
@endsection
