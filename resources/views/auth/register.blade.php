<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- User Type -->
        <div class="">
            <x-input-label for="userType" :value="__('User Type')" />
            <select id="userType" name="userType"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:focus:ring-offset-gray-900 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 rounded-md shadow-sm">
                <option value="1">Élève</option>
                <option value="2">Professeur</option>
            </select>
            <x-input-error :messages="$errors->get('userType')" class="mt-2" />
        </div>

        <!-- Subject (caché par défaut) -->
        <div class="mt-3 hidden" id="subjectSelect">
            <x-input-label for="subject" :value="__('Subject')" />
            <select id="subject" name="subject"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:focus:ring-offset-gray-900 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 rounded-md shadow-sm">
                <option value="">Sélectionnez une matière</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subjectName }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-3">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-3">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var userTypeSelect = document.getElementById('userType');
            var subjectSelect = document.getElementById('subjectSelect');

            userTypeSelect.addEventListener('change', function() {
                if (userTypeSelect.value === '2') {
                    subjectSelect.classList.remove('hidden');
                } else {
                    subjectSelect.classList.add('hidden');
                }
            });
        });
    </script>
</x-guest-layout>
