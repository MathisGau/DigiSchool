<x-app-layout>
    <div class="flex flex-row justify-around">
        <form method="POST" action="{{ route('register') }}" class="flex-1 px-20">
            @csrf
            <div class="text-lg font-bold">
                <h1 class="text-white text-5xl m-10">Evaluation</h1>
            </div>

            <!-- Nom de l'Evaluation -->
            <div class="mt-3">
                <x-input-label for="evaluation" :value="__('Titre')" />
                <x-text-input id="evaluation" class="block mt-1 w-full" type="text" name="evaluation" :value="old('evaluation')"
                    required autofocus autocomplete="evaluation" />
                <x-input-error :messages="$errors->get('evaluation')" class="mt-2" />
            </div>

            <!-- Coefficients -->
            <div class="mt-3">
                <x-input-label for="Coefficient" :value="__('Coefficient')" />
                <select id="coefficient" name="oefficient"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:focus:ring-offset-gray-900 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="1">1</option>
                    <option value="0,5">0,5</option>
                    <option value="1,5">1,5</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                </select>
                <x-input-error :messages="$errors->get('Coefficient')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-3">
                <x-secondary-button>
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-primary-button class="ms-4">
                    {{ __('Enregistrer') }}
                </x-primary-button>
            </div>
        </form>


        <form method="POST" action="{{ route('register') }}" class="flex-1 px-20">
            @csrf
            <div class="text-lg font-bold">
                <h1 class="text-white text-5xl m-10">Notes</h1>
            </div>
            <!-- Elève -->
            <div class="">
                <x-input-label for="id_user" :value="__('Elève')" />
                <select id="id_user" name="id_user"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:focus:ring-offset-gray-900 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="0">-- Selectionner un élève --</option>
                    <option value="1">Mathis Gauthrot</option>
                    <option value="2">Timm Busi</option>
                    <option value="3">Aurélien Druon</option>
                    <option value="3">Emilien Ridard</option>
                    <option value="3">Ismael Charni</option>
                    <option value="3">Quan Luu</option>
                </select>
                <x-input-error :messages="$errors->get('id_user')" class="mt-2" />
            </div>

            <!-- Evaluation -->
            <div class="mt-3">
                <x-input-label for="evaluation" :value="__('Evaluation')" />
                <select id="evaluation" name="evaluation"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:focus:ring-offset-gray-900 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="1">Eval n°1</option>
                    <option value="2">Eval n°2</option>
                </select>
                <x-input-error :messages="$errors->get('evaluation')" class="mt-2" />
            </div>

            <!-- Notes -->
            <div class="mt-3">
                <x-input-label for="note" :value="__('Note')" />
                <x-text-input id="note" class="block mt-1 w-full" type="text" name="note" :value="old('note')"
                    required autofocus autocomplete="note" />
                <x-input-error :messages="$errors->get('note')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-3">
                <x-input-label for="description" :value="__('Déscription')" />
                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                    :value="old('description')" required autofocus autocomplete="description" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-3">
                <x-secondary-button>
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-primary-button class="ms-4">
                    {{ __('Enregistrer') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
