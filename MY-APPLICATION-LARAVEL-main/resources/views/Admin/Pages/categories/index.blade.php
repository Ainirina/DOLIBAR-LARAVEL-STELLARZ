@extends('admin.Layouts.Elements.ElementLayout')
@section('title', 'Edit ' . ($category->name ?? 'Categorie'))
@section('element.active', 'categories')

@section('element')
<div class="flex justify-between items-center">
    <div></div>
    <div class="flex shrink-0 items-center gap-3 sm:mt-7">
        <a href="{{ route('categories.create') }}" class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20 [input:checked+&]:bg-gray-400 [input:checked+&]:text-white [input:checked+&]:ring-0 [input:checked+&]:hover:bg-gray-300 dark:[input:checked+&]:bg-gray-600 dark:[input:checked+&]:hover:bg-gray-500">Import categories</a>
        <a href="{{ route('categories.create') }}" class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg bg-blue-600 gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50">New category</a>
    </div>

</div>
<div class="bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-gray-800">
    <div class="overflow-x-auto rounded-xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-300 dark:border-gray-600  bg-gray-50 dark:bg-gray-900">
                    <th class="py-3 text-gray-600 dark:text-gray-100 w-80">Name</th>
                    <th class="py-3 text-gray-600 dark:text-gray-100 w-80">	Create Date</th>
                    <th class="py-3 text-gray-600 dark:text-gray-100 w-80">	Updated Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="py-3 font-medium text-gray-900 dark:text-gray-50"><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></td>
                        <td class="py-3 text-gray-500 dark:text-gray-600">{{ \Carbon\Carbon::parse($category->created_at)->format('M d, Y') }}</td>
                        <td class="py-3 text-gray-500 dark:text-gray-600">{{ \Carbon\Carbon::parse($category->updated_at)->format('M d, Y') }}</td>
                        <td class="p-2 text-center flex gap-2 justify-center">
                            <div class="inline-block text-left">
                                <!-- Bouton pour afficher le dropdown -->
                                <a href="{{ route('categories.edit', $category) }}"
                                    class="group flex items-center gap-3 rounded-xl px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                    <i class="pi pi-pen-to-square" aria-hidden="true"></i> Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection