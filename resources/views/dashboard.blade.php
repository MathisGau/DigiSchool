<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-screen flex items-center justify-center">
        <div class="p-6 dark:bg-gray-800 rounded-lg">
            <p class="text-white">{{ __('Bienvenue ') }}{{ Auth::user()->name }}{{ __(' !') }}</p>
        </div>
    </div>
</x-app-layout>
