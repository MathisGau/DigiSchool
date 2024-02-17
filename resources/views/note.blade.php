<x-app-layout>
    <div class="flex flex-row justify-around mt-2 mb-10">
        @if (Auth::user()->userType === 2)
            <form method="POST" action="{{ route('notes') }}" class="flex-1 px-44">
                @csrf

                <div class="mt-8 flex flex-row justify-between">
                    <!-- Titre de l'évaluation -->
                    <div class="w-1/2 mr-2">
                        <x-input-label for="title" :value="__('Titre de l\'évaluation')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Coefficient de l'évaluation -->
                    <div class="w-1/2 ml-2">
                        <x-input-label for="coefficient" :value="__('Coefficient')" />
                        <x-text-input id="coefficient" class="block mt-1 w-full" type="number" min="0"
                            max="20" step="0.5" name="coefficient" :value="old('coefficient')" required />
                        <x-input-error :messages="$errors->get('coefficient')" class="mt-2" />
                    </div>
                </div>

                <!-- Tableau des notes -->
                <div class="mt-8">
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg bg-gray-800">
                        <thead class="">
                            <tr class="font medium text-xs text-left text-gray-100">
                                <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                    Nom de l'élève
                                </th>
                                <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                    Note
                                </th>
                                <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                    Remarque
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($students as $student)
                                <tr class="text-gray-300">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm">{{ $student->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-text-input id="note{{ $student->id }}" class="block w-full" type="number"
                                            min="0" max="20" name="notes[{{ $student->id }}][note]"
                                            :value="old('notes.' . $student->id . '.note')" required />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-text-input id="description{{ $student->id }}" class="block w-full"
                                            type="text" name="notes[{{ $student->id }}][description]"
                                            :value="old('notes.' . $student->id . '.description')" required />
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-end mt-3 gap-4">
                    <!-- Bouton Annuler pour vider les champs -->
                    <div class="flex items-center justify-start mt-4">
                        <x-secondary-button type="reset">
                            {{ __('Annuler') }}
                        </x-secondary-button>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Enregistrer') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        @elseif (Auth::user()->userType === 1)
            <div class="min-w-screen min-h-screen flex items-center justify-center">
                <div class="w-full">
                    <div class="shadow-md rounded my-6">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg bg-gray-800">
                            <thead class="">
                                <tr class="font medium text-xs text-left text-gray-100">
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                        Coefficient
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                        Note
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                        Description
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($notes as $note)
                                    <tr class="text-gray-300 text-sm">
                                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $note->evaluation->subject }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $note->evaluation->title }}
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            {{ $note->evaluation->coefficient }}
                                        </td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $note->mark }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $note->description }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        @endif
    </div>
</x-app-layout>
