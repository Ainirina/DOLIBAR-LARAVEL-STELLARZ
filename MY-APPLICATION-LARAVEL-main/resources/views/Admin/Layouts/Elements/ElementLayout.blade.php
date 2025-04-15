@extends('admin.Layouts.AuthenticatedLayout')

@section('title', 'Product list')
@section('active', 'elements')

@section('content')
    <div class="flex flex-col gap-8 md:flex-row md:items-start my-9 mb-4"> 
        @include('admin.partials.elementmenu')
        <div class="grid flex-1 auto-cols-fr gap-y-8">
            @yield('element')
        </div>
    </div>
@endsection