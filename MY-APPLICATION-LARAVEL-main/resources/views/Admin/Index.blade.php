@extends('admin.Layouts.AuthenticatedLayout')

@section('title', 'Admin Panel')

@section('content')
    <div class="bg-white text-[--Black] w-[1100px] dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold">Bienvenue, Admin</h2>
        <p class="mt-2">Gérez votre boutique ici.</p>
        <a href="{{ route('admin-Logout') }}">Se déconnecter</a>
    </div>
@endsection
