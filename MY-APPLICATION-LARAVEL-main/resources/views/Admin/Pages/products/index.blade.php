@extends('admin.Layouts.Elements.ElementLayout')
@section('element.active', 'products')

@section('element')
    <div class="flex justify-between items-center">
        <div></div>
        <div class="flex shrink-0 items-center gap-3 sm:mt-7">
            <a href="{{ route('categories.create') }}" class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20 [input:checked+&]:bg-gray-400 [input:checked+&]:text-white [input:checked+&]:ring-0 [input:checked+&]:hover:bg-gray-300 dark:[input:checked+&]:bg-gray-600 dark:[input:checked+&]:hover:bg-gray-500">Import products</a>
            <a href="{{ route('products.create') }}" class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg bg-blue-600 gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50">New product</a>
        </div>
    </div>

    <div class="grid gap-6">
        <div>
            <div class="grid gap-6 md:grid-cols-3">
                <div
                    class=" relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                    <div class="grid gap-y-2">
                        <div class="flex items-center gap-x-2">
                            <span
                                class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Total Products
                            </span>
                        </div>
                        <div
                            class="text-3xl font-semibold tracking-tight text-gray-950 dark:text-white">
                            {{ count($products) }}
                        </div>
                    </div>
                </div>
                <div
                    class=" relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                    <div class="grid gap-y-2">
                        <div class="flex items-center gap-x-2">
                            <span
                                class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Product Inventory
                            </span>
                        </div>
                        <div
                            class="text-3xl font-semibold tracking-tight text-gray-950 dark:text-white">
                            218
                        </div>
                    </div>
                </div>

                <div
                    class=" relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                    <div class="grid gap-y-2">
                        <div class="flex items-center gap-x-2">

                            <span
                                class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Average price
                            </span>
                        </div>
                        <div
                            class="text-3xl font-semibold tracking-tight text-gray-950 dark:text-white">
                            235.83
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-gray-800">

        <div class="overflow-x-auto rounded-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-300 dark:border-gray-600  bg-gray-50 dark:bg-gray-900">
                        <th class="py-3 text-gray-600 dark:text-gray-100 w-80">Name</th>
                        <th class="py-3 text-gray-600 dark:text-gray-100 w-36">Price</th>
                        <th class="py-3 text-gray-600 dark:text-gray-100 w-36">Model</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 dark:divide-gray-700 divide-opacity-100">
                    @foreach ($products as $product)
                        <tr>
                            <td class="py-3 font-medium text-gray-900 dark:text-gray-50"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                            <td class="py-3 text-gray-500 dark:text-gray-600">{{ $product->price }}€</td>
                            <td class="py-3 text-gray-500 dark:text-gray-600">{{ $product->model }}</td>
                            <td class="p-2 text-center flex gap-2 justify-center">
                                <div class="inline-block text-left">
                                    <!-- Bouton pour afficher le dropdown -->
                                    <a href="{{ route('products.edit', $product) }}"
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
