@extends('admin.Layouts.Elements.ElementLayout')
@section('title', 'Edit ' . ($product->name ?? 'Product'))
@section('element.active', 'products')

@section('element')
    {{-- <h1>{{ isset($product) ? 'Modifier' : 'Ajouter' }} un produit</h1>
    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST">
        @csrf
        @if (isset($product)) @method('PUT') @endif

        <label>Nom :</label>
        <input type="text" name="name" value="{{ $product->name ?? old('name') }}" required>

        <label>Prix :</label>
        <input type="number" name="price" value="{{ $product->price ?? old('price') }}" required>

        <label>Modèle :</label>
        <input type="text" name="model" value="{{ $product->model ?? old('model') }}" required>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form> --}}

    <x-card>
        <x-slot name="title">
            <h1>{{ isset($product) ? 'Modifier' : 'Ajouter' }} un produit</h1>
        </x-slot>
    
        <x-slot name="content">
            <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST">
                @csrf
                @if (isset($product)) @method('PUT') @endif
        
                <livewire:input-text 
                    label="Name"
                    name="name"
                    value="{{ $product->name ?? old('name') }}"
                    placeholder=""
                    required="{{ true }}"
                />

                {{-- <livewire:file-upload
                    name="image"
                    accept="image/*"
                    fileType="image"
                 /> --}}
        
                {{-- <label>Prix :</label>
                <input type="number" name="price" value="{{ $product->price ?? old('price') }}" required> --}}

                <livewire:input-number
                    label="Prix"
                    name="price"
                    value="{{ $product->price ?? old('price') }}"
                    inputId="price-input"
                    required
                    placeholder=""
                    disabled="{{ false }}"
                    prefix="€"
                    suffix="EUR"
                    thousandsSeparator=","
                    decimalSeparator="."
                    fluid
                />
        
                <livewire:input-text 
                    label="Modèle"
                    name="model"
                    wire:model.defer="model"
                    value="{{ $product->model ?? old('model') }}"
                    placeholder=""
                    required="{{ true }}"
                />
        
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </form>
        </x-slot>
        
    </x-card>
    

    
    


    <section class="flex flex-col gap-y-8 py-8">
        <header class="fi-header flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <nav class="mb-2 hidden sm:block">
                    <ol class="list flex flex-wrap items-center gap-x-2">
                        <li class="flex items-center gap-x-2">
                            <a href="{{ route('products.index') }}"
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 transition duration-75 hover:text-gray-700 dark:hover:text-gray-200">
                                Products
                            </a>
                        </li>
                        <li class="flex items-center content-center gap-x-2">
                            <p class="pi pi-chevron-right flex  text-[15px] text-gray-400 dark:text-gray-500 ltr:hidden"></p>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                {{ isset($product) ? $product->name  : 'Create' }}
                            </span>
                        </li>
                    </ol>
                </nav>

                <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                    {{ isset($product) ? 'Modifie' : 'Create' }} Product
                </h1>
            </div>

            <div class="flex shrink-0 items-center gap-3 sm:mt-7">

            </div>
        </header>
        <div class="">
            <div class="grid flex-1 auto-cols-fr gap-y-8">




                <form method="post">
                    <div style="2: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(3, minmax(0, 1fr));"
                        class="grid grid-cols-[2] lg:grid-cols-[--cols-lg] gap-6">
                        <div style="--col-span-default: span 1 / span 1; --col-span-lg: span 2 / span 2;"
                            class="col-[--col-span-default] lg:col-[--col-span-lg]">
                            <div>
                                <div class="grid grid-cols-[2] gap-6">
                                        <x-card>
                                            <x-slot name="title">
                                                Base
                                            </x-slot>

                                            <x-slot name="content">
                                                    <div style="2: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                                                        class="grid grid-cols-[2] lg:grid-cols-[--cols-lg] gap-6 mb-6">

                                                        <livewire:input-text 
                                                            label="Name"
                                                            name="name"
                                                            value="{{ $product->name ?? old('name') }}"
                                                            placeholder=""
                                                            required="{{ true }}"
                                                        />


                                                        <livewire:input-text 
                                                            label="Slug"
                                                            name="slug"
                                                            required="{{ false }}"
                                                            disabled={{ true }}
                                                        />
                                                    </div>
                                                    
                                                    <livewire:textarea 
                                                        name="description"
                                                        label="Description"
                                                        value="{{ old('description') }}"
                                                        placeholder=""
                                                        rows="5"
                                                        required="true"
                                                    />
                                            </x-slot>
                                        </x-card>

                                        <x-card>
                                            <x-slot name="title">
                                                Images
                                            </x-slot>

                                            <x-slot name="content">
                                                <livewire:file-upload
                                                    name="image"
                                                    accept="image/*"
                                                    fileType="image"
                                                />
                                            </x-slot>
                                        </x-card>

                                        <x-card>
                                            <x-slot name="title">
                                                Pricing
                                            </x-slot>

                                            <x-slot name="content">
                                                <div style="2: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                                                    class="grid grid-cols-[2] lg:grid-cols-[--cols-lg] gap-6 mb-6">

                                                    <livewire:input-number
                                                        label="Price"
                                                        name="price"
                                                        wire:model.defer="price"
                                                        value="{{ $product->price ?? old('price') }}"
                                                        inputId="price-input"
                                                        required
                                                        placeholder="Entrez le prix"
                                                        disabled="{{ false }}"
                                                        prefix="€"
                                                        suffix="EUR"
                                                        thousandsSeparator=","
                                                        decimalSeparator="."
                                                        fluid
                                                    />

                                                    <livewire:input-number
                                                        label="Compare at price"
                                                        name="comparePrice"
                                                        wire:model.defer="comparePrice"
                                                        value="{{ $product->price ?? old('price') }}"
                                                        inputId="price-input"
                                                        required
                                                        placeholder=""
                                                        disabled="{{ false }}"
                                                        prefix="€"
                                                        suffix="EUR"
                                                        thousandsSeparator=","
                                                        decimalSeparator="."
                                                        fluid
                                                    />

                                                    <livewire:input-text 
                                                        label="Slug"
                                                        name="slug"
                                                        wire:model.defer="slug"
                                                        required="{{ false }}"
                                                        disabled={{ true }}
                                                    />
                                                </div>
                                            </x-slot>
                                        </x-card>

                                    <div style="--col-span-default: 1 / -1;" class="col-[--col-span-default]">
                                        <section x-data="{
                                            isCollapsed: false,
                                        }"
                                            class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
                                            id="data.pricing" data-has-alpine-state="true">
                                            <header class="flex flex-col gap-3 px-6 py-4">
                                                <div class="flex items-center gap-3">


                                                    <div class="grid flex-1 gap-y-1">
                                                        <h3
                                                            class="heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                                            Pricing
                                                        </h3>



                                                    </div>







                                                </div>

                                            </header>

                                            <div
                                                class="content-ctn border-t border-gray-200 dark:border-white/10">
                                                <div class="content p-6">
                                                    <div style="2: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                                                        class="grid grid-cols-[2] lg:grid-cols-[--cols-lg] gap-6">

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.price.Filament\Forms\Components\TextInput">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.price">


                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                Price<!--[if BLOCK]><![endif]--><sup
                                                                                    class="text-danger-600 dark:text-danger-400 font-medium">*</sup>

                                                                            </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">
                                                                        <div
                                                                            class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">

                                                                            <div class="min-w-0 flex-1">
                                                                                <input
                                                                                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                                                                    id="data.price" inputmode="decimal"
                                                                                    required="required" step="any"
                                                                                    type="number"
                                                                                    wire:model="data.price">
                                                                            </div>

                                                                        </div>





                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.old_price.Filament\Forms\Components\TextInput">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.old_price">


                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                Compare at
                                                                                price<!--[if BLOCK]><![endif]--><sup
                                                                                    class="text-danger-600 dark:text-danger-400 font-medium">*</sup>

                                                                            </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">
                                                                        <div
                                                                            class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">

                                                                            <div class="min-w-0 flex-1">
                                                                                <input
                                                                                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                                                                    id="data.old_price"
                                                                                    inputmode="decimal"
                                                                                    required="required" step="any"
                                                                                    type="number"
                                                                                    wire:model="data.old_price">
                                                                            </div>

                                                                        </div>





                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.cost.Filament\Forms\Components\TextInput">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.cost">


                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                Cost per item<!--[if BLOCK]><![endif]--><sup
                                                                                    class="text-danger-600 dark:text-danger-400 font-medium">*</sup>

                                                                            </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">
                                                                        <div
                                                                            class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">

                                                                            <div class="min-w-0 flex-1">
                                                                                <input
                                                                                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                                                                    id="data.cost" inputmode="decimal"
                                                                                    required="required" step="any"
                                                                                    type="number" wire:model="data.cost">
                                                                            </div>

                                                                        </div>




                                                                        <div
                                                                            class="fi-fo-field-wrp-helper-text break-words text-sm text-gray-500">
                                                                            Customers won't see this price.
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>


                                    </div>

                                    <div style="--col-span-default: 1 / -1;" class="col-[--col-span-default]">
                                        <section x-data="{
                                            isCollapsed: false,
                                        }"
                                            class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
                                            id="data.inventory" data-has-alpine-state="true">
                                            <header class="flex flex-col gap-3 px-6 py-4">
                                                <div class="flex items-center gap-3">


                                                    <div class="grid flex-1 gap-y-1">
                                                        <h3
                                                            class="heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                                            Inventory
                                                        </h3>



                                                    </div>







                                                </div>

                                            </header>

                                            <div
                                                class="content-ctn border-t border-gray-200 dark:border-white/10">
                                                <div class="content p-6">
                                                    <div style="2: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                                                        class="grid grid-cols-[2] lg:grid-cols-[--cols-lg] gap-6">

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.sku.Filament\Forms\Components\TextInput">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.sku">


                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                SKU (Stock Keeping
                                                                                Unit)<!--[if BLOCK]><![endif]--><sup
                                                                                    class="text-danger-600 dark:text-danger-400 font-medium">*</sup>

                                                                            </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">
                                                                        <div
                                                                            class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">

                                                                            <div class="min-w-0 flex-1">
                                                                                <input
                                                                                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                                                                    id="data.sku" maxlength="255"
                                                                                    required="required" type="text"
                                                                                    wire:model="data.sku">
                                                                            </div>

                                                                        </div>





                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.barcode.Filament\Forms\Components\TextInput">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.barcode">


                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                Barcode (ISBN, UPC, GTIN,
                                                                                etc.)<!--[if BLOCK]><![endif]--><sup
                                                                                    class="text-danger-600 dark:text-danger-400 font-medium">*</sup>

                                                                            </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">
                                                                        <div
                                                                            class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">

                                                                            <div class="min-w-0 flex-1">
                                                                                <input
                                                                                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                                                                    id="data.barcode" maxlength="255"
                                                                                    required="required" type="text"
                                                                                    wire:model="data.barcode">
                                                                            </div>

                                                                        </div>





                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.qty.Filament\Forms\Components\TextInput">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.qty">


                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                Quantity<!--[if BLOCK]><![endif]--><sup
                                                                                    class="text-danger-600 dark:text-danger-400 font-medium">*</sup>

                                                                            </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">
                                                                        <div
                                                                            class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">

                                                                            <div class="min-w-0 flex-1">
                                                                                <input
                                                                                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                                                                    id="data.qty" inputmode="decimal"
                                                                                    required="required" step="any"
                                                                                    type="number" wire:model="data.qty">
                                                                            </div>

                                                                        </div>





                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.security_stock.Filament\Forms\Components\TextInput">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.security_stock">


                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                Security
                                                                                stock<!--[if BLOCK]><![endif]--><sup
                                                                                    class="text-danger-600 dark:text-danger-400 font-medium">*</sup>

                                                                            </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">
                                                                        <div
                                                                            class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">

                                                                            <div class="min-w-0 flex-1">
                                                                                <input
                                                                                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                                                                    id="data.security_stock"
                                                                                    inputmode="decimal"
                                                                                    required="required" step="any"
                                                                                    type="number"
                                                                                    wire:model="data.security_stock">
                                                                            </div>

                                                                        </div>




                                                                        <div
                                                                            class="fi-fo-field-wrp-helper-text break-words text-sm text-gray-500">
                                                                            The safety stock is the limit stock for your
                                                                            products which alerts you if the product stock
                                                                            will soon be out of stock.
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>


                                    </div>

                                    <div style="--col-span-default: 1 / -1;" class="col-[--col-span-default]">
                                        <section x-data="{
                                            isCollapsed: false,
                                        }"
                                            class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
                                            id="data.shipping" data-has-alpine-state="true">
                                            <header class="flex flex-col gap-3 px-6 py-4">
                                                <div class="flex items-center gap-3">


                                                    <div class="grid flex-1 gap-y-1">
                                                        <h3
                                                            class="heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                                            Shipping
                                                        </h3>



                                                    </div>







                                                </div>

                                            </header>

                                            <div
                                                class="content-ctn border-t border-gray-200 dark:border-white/10">
                                                <div class="content p-6">
                                                    <div style="2: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                                                        class="grid grid-cols-[2] lg:grid-cols-[--cols-lg] gap-6">

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.backorder.Filament\Forms\Components\Checkbox">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.backorder">
                                                                            <input type="checkbox"
                                                                                class="fi-checkbox-input rounded border-none bg-white shadow-sm ring-1 transition duration-75 checked:ring-0 focus:ring-2 focus:ring-offset-0 disabled:pointer-events-none disabled:bg-gray-50 disabled:text-gray-50 disabled:checked:bg-current disabled:checked:text-gray-400 dark:bg-white/5 dark:disabled:bg-transparent dark:disabled:checked:bg-gray-600 text-primary-600 ring-gray-950/10 focus:ring-primary-600 checked:focus:ring-primary-500/50 dark:text-primary-500 dark:ring-white/20 dark:checked:bg-primary-500 dark:focus:ring-primary-500 dark:checked:focus:ring-primary-400/50 dark:disabled:ring-white/10"
                                                                                id="data.backorder"
                                                                                wire:loading.attr="disabled"
                                                                                wire:model="data.backorder">

                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                This product can be
                                                                                returned<!--[if BLOCK]><![endif]--> </span>


                                                                        </label>



                                                                    </div>


                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.requires_shipping.Filament\Forms\Components\Checkbox">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.requires_shipping">
                                                                            <input type="checkbox"
                                                                                class="fi-checkbox-input rounded border-none bg-white shadow-sm ring-1 transition duration-75 checked:ring-0 focus:ring-2 focus:ring-offset-0 disabled:pointer-events-none disabled:bg-gray-50 disabled:text-gray-50 disabled:checked:bg-current disabled:checked:text-gray-400 dark:bg-white/5 dark:disabled:bg-transparent dark:disabled:checked:bg-gray-600 text-primary-600 ring-gray-950/10 focus:ring-primary-600 checked:focus:ring-primary-500/50 dark:text-primary-500 dark:ring-white/20 dark:checked:bg-primary-500 dark:focus:ring-primary-500 dark:checked:focus:ring-primary-400/50 dark:disabled:ring-white/10"
                                                                                id="data.requires_shipping"
                                                                                wire:loading.attr="disabled"
                                                                                wire:model="data.requires_shipping">

                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                This product will be
                                                                                shipped<!--[if BLOCK]><![endif]--> </span>


                                                                        </label>



                                                                    </div>


                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>


                                    </div>
                                </div>

                            </div>


                        </div>

                        <div style="--col-span-default: span 1 / span 1; --col-span-lg: span 1 / span 1;"
                            class="col-[--col-span-default] lg:col-[--col-span-lg]">
                            <div>
                                <div style="2: repeat(1, minmax(0, 1fr));" class="grid grid-cols-[2] gap-6">

                                    <div style="--col-span-default: 1 / -1;" class="col-[--col-span-default]">
                                        <section x-data="{
                                            isCollapsed: false,
                                        }"
                                            class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
                                            id="data.status" data-has-alpine-state="true">
                                            <header class="flex flex-col gap-3 px-6 py-4">
                                                <div class="flex items-center gap-3">


                                                    <div class="grid flex-1 gap-y-1">
                                                        <h3
                                                            class="heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                                            Status
                                                        </h3>



                                                    </div>







                                                </div>

                                            </header>

                                            <div
                                                class="content-ctn border-t border-gray-200 dark:border-white/10">
                                                <div class="content p-6">
                                                    <div style="2: repeat(1, minmax(0, 1fr));"
                                                        class="grid grid-cols-[2] gap-6">

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.is_visible.Filament\Forms\Components\Toggle">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.is_visible">
                                                                            <button x-data="{
                                                                                state: $wire.$entangle('data.is_visible', false),
                                                                            }"
                                                                                x-bind:aria-checked="state?.toString()"
                                                                                x-on:click="state = ! state"
                                                                                x-bind:class="state
                                                                                    ?
                                                                                    'fi-color-custom bg-custom-600 fi-color-primary' :
                                                                                    'bg-gray-200 dark:bg-gray-700 fi-color-gray'"
                                                                                x-bind:style="state
                                                                                    ?
                                                                                    '--c-600:var(--primary-600)' :
                                                                                    '--c-600:var(--gray-600)'"
                                                                                class="fi-fo-toggle relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent outline-none transition-colors duration-200 ease-in-out disabled:pointer-events-none disabled:opacity-70 fi-color-custom bg-custom-600 fi-color-primary"
                                                                                aria-checked="true" id="data.is_visible"
                                                                                role="switch" type="button"
                                                                                wire:loading.attr="disabled"
                                                                                wire:target="data.is_visible"
                                                                                style="--c-600:var(--primary-600)"
                                                                                data-has-alpine-state="true">
                                                                                <span
                                                                                    class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-5 rtl:-translate-x-5"
                                                                                    x-bind:class="{
                                                                                        'translate-x-5 rtl:-translate-x-5': state,
                                                                                        'translate-x-0': !state,
                                                                                    }">
                                                                                    <span
                                                                                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-0 ease-out duration-100"
                                                                                        aria-hidden="true"
                                                                                        x-bind:class="{
                                                                                            'opacity-0 ease-out duration-100': state,
                                                                                            'opacity-100 ease-in duration-200':
                                                                                                !state,
                                                                                        }">

                                                                                    </span>

                                                                                    <span
                                                                                        class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-100 ease-in duration-200"
                                                                                        aria-hidden="true"
                                                                                        x-bind:class="{
                                                                                            'opacity-100 ease-in duration-200': state,
                                                                                            'opacity-0 ease-out duration-100':
                                                                                                !state,
                                                                                        }">

                                                                                    </span>
                                                                                </span>
                                                                            </button>

                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                Visible<!--[if BLOCK]><![endif]--> </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">




                                                                        <div
                                                                            class="fi-fo-field-wrp-helper-text break-words text-sm text-gray-500">
                                                                            This product will be hidden from all sales
                                                                            channels.
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.published_at.Filament\Forms\Components\DatePicker">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.published_at">


                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                Availability<!--[if BLOCK]><![endif]--><sup
                                                                                    class="text-danger-600 dark:text-danger-400 font-medium">*</sup>

                                                                            </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">
                                                                        <div
                                                                            class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500">

                                                                            <div class="min-w-0 flex-1">
                                                                                <input
                                                                                    class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                                                                    id="data.published_at"
                                                                                    required="required" type="date"
                                                                                    wire:model="data.published_at">

                                                                            </div>

                                                                        </div>





                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>


                                    </div>

                                    <div style="--col-span-default: 1 / -1;" class="col-[--col-span-default]">
                                        <section x-data="{
                                            isCollapsed: false,
                                        }"
                                            class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
                                            id="data.associations" data-has-alpine-state="true">
                                            <header class="flex flex-col gap-3 px-6 py-4">
                                                <div class="flex items-center gap-3">


                                                    <div class="grid flex-1 gap-y-1">
                                                        <h3
                                                            class="heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                                            Associations
                                                        </h3>



                                                    </div>







                                                </div>

                                            </header>

                                            <div
                                                class="content-ctn border-t border-gray-200 dark:border-white/10">
                                                <div class="content p-6">
                                                    <div style="2: repeat(1, minmax(0, 1fr));"
                                                        class="grid grid-cols-[2] gap-6">

                                                        <div style="--col-span-default: span 1 / span 1;"
                                                            class="col-[--col-span-default]"
                                                            wire:key="iI0z018800nvBETsmJoz.data.shop_brand_id.Filament\Forms\Components\Select">
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.shop_brand_id">


                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                Brand<!--[if BLOCK]><![endif]--> </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">
                                                                        <div
                                                                            class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select">

                                                                            <div class="min-w-0 flex-1">
                                                                                <div class="hidden"></div>
                                                                                <div>
                                                                                    <div class="choices"
                                                                                        data-type="select-one"
                                                                                        tabindex="0" role="combobox"
                                                                                        aria-autocomplete="list"
                                                                                        aria-haspopup="true"
                                                                                        aria-expanded="false">
                                                                                        <div class="choices__inner"><select
                                                                                                x-ref="input"
                                                                                                class="h-9 w-full rounded-lg border-none bg-transparent !bg-none choices__input"
                                                                                                id="data.shop_brand_id"
                                                                                                hidden=""
                                                                                                tabindex="-1"
                                                                                                data-choice="active"></select>
                                                                                            <div
                                                                                                class="choices__list choices__list--single">
                                                                                                <div
                                                                                                    class="choices__placeholder choices__item">
                                                                                                    Select an option</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="choices__list choices__list--dropdown"
                                                                                            aria-expanded="false"><input
                                                                                                type="search"
                                                                                                name="search_terms"
                                                                                                class="choices__input choices__input--cloned"
                                                                                                autocomplete="off"
                                                                                                autocapitalize="off"
                                                                                                spellcheck="false"
                                                                                                role="textbox"
                                                                                                aria-autocomplete="list"
                                                                                                aria-label="Select an option"
                                                                                                placeholder="Start typing to search...">
                                                                                            <div class="choices__list"
                                                                                                role="listbox">
                                                                                                <div
                                                                                                    class="choices__item choices__item--choice has-no-choices">
                                                                                                    Start typing to
                                                                                                    search...</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>




                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div>
                                                            <div data-field-wrapper="" class="fi-fo-field-wrp">

                                                                <div class="grid gap-y-2">
                                                                    <div
                                                                        class="flex items-center gap-x-3 justify-between ">
                                                                        <label
                                                                            class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                                                            for="data.categories">


                                                                            <span
                                                                                class="text-sm font-medium leading-6 text-gray-950 dark:text-white">

                                                                                Categories<!--[if BLOCK]><![endif]--><sup
                                                                                    class="text-danger-600 dark:text-danger-400 font-medium">*</sup>

                                                                            </span>


                                                                        </label>



                                                                    </div>


                                                                    <div class="grid auto-cols-fr gap-y-2">
                                                                        <div
                                                                            class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select">

                                                                            <div class="min-w-0 flex-1">
                                                                                <div class="hidden"></div>
                                                                                <div>
                                                                                    <div class="choices"
                                                                                        data-type="select-multiple"
                                                                                        role="combobox"
                                                                                        aria-autocomplete="list"
                                                                                        aria-haspopup="true"
                                                                                        aria-expanded="false">
                                                                                        <div class="choices__inner"><select
                                                                                                x-ref="input"
                                                                                                class="h-9 w-full rounded-lg border-none bg-transparent !bg-none choices__input"
                                                                                                id="data.categories"
                                                                                                multiple="multiple"
                                                                                                hidden=""
                                                                                                tabindex="-1"
                                                                                                data-choice="active"></select>
                                                                                            <div
                                                                                                class="choices__list choices__list--multiple">
                                                                                            </div><input type="search"
                                                                                                name="search_terms"
                                                                                                class="choices__input choices__input--cloned"
                                                                                                autocomplete="off"
                                                                                                autocapitalize="off"
                                                                                                spellcheck="false"
                                                                                                role="textbox"
                                                                                                aria-autocomplete="list"
                                                                                                aria-label="Select an option"
                                                                                                placeholder="Select an option"
                                                                                                style="min-width: 17ch; width: 1ch;">
                                                                                        </div>
                                                                                        <div class="choices__list choices__list--dropdown"
                                                                                            aria-expanded="false">
                                                                                            <div class="choices__list"
                                                                                                aria-multiselectable="true"
                                                                                                role="listbox">
                                                                                                <div
                                                                                                    class="choices__item choices__item--choice has-no-choices">
                                                                                                    Start typing to
                                                                                                    search...</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>




                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>


                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>


                    <div class="fi-form-actions">
                        <div class="fi-ac gap-3 flex flex-wrap items-center justify-start">

                            <button>

                                <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    class="animate-spin fi-btn-icon transition duration-75 h-5 w-5 text-white"
                                    wire:loading.delay.default="" wire:target="create">
                                    <path clip-rule="evenodd"
                                        d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                        fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                        fill="currentColor"></path>
                                </svg>


                                <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    class="animate-spin fi-btn-icon transition duration-75 h-5 w-5 text-white"
                                    x-show="isProcessing" style="display: none;">
                                    <path clip-rule="evenodd"
                                        d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                        fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                        fill="currentColor"></path>
                                </svg>


                                <span x-show="! isProcessing" class="fi-btn-label">
                                    Create
                                </span>

                                <span x-show="isProcessing" x-text="processingMessage" class="fi-btn-label"
                                    style="display: none;"></span>


                            </button>



                            <button x-data="{}" x-bind:id="$id('key-bindings')"
                                x-mousetrap.global.mod-shift-s="document.getElementById($el.id).click()" style=";"
                                class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg  fi-btn-color-gray fi-color-gray fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20 [input:checked+&amp;]:bg-gray-400 [input:checked+&amp;]:text-white [input:checked+&amp;]:ring-0 [input:checked+&amp;]:hover:bg-gray-300 dark:[input:checked+&amp;]:bg-gray-600 dark:[input:checked+&amp;]:hover:bg-gray-500 fi-ac-action fi-ac-btn-action"
                                type="button" wire:loading.attr="disabled" wire:click="createAnother"
                                id="key-bindings-2" data-has-alpine-state="true">

                                <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    class="animate-spin fi-btn-icon transition duration-75 h-5 w-5 text-gray-400 dark:text-gray-500"
                                    wire:loading.delay.default="" wire:target="createAnother">
                                    <path clip-rule="evenodd"
                                        d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                        fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"
                                        fill="currentColor"></path>
                                </svg>



                                <span class="fi-btn-label">
                                    Create &amp; create another
                                </span>



                            </button>



                            <button style=";"
                                class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg  fi-btn-color-gray fi-color-gray fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20 [input:checked+&amp;]:bg-gray-400 [input:checked+&amp;]:text-white [input:checked+&amp;]:ring-0 [input:checked+&amp;]:hover:bg-gray-300 dark:[input:checked+&amp;]:bg-gray-600 dark:[input:checked+&amp;]:hover:bg-gray-500 fi-ac-action fi-ac-btn-action"
                                type="button" wire:loading.attr="disabled"
                                x-on:click="document.referrer ? window.history.back() : (window.location.href = 'https:\/\/demo.filamentphp.com\/shop\/products\/products')">



                                <span class="fi-btn-label">
                                    Cancel
                                </span>



                            </button>



                        </div>
                    </div>
                </form>







            </div>

        </div>

    </section>
@endsection
