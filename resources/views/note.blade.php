<x-app-layout>
    <div class="flex flex-row h-full justify-around">
        @if (Auth::user()->userType === 2)
            <form method="POST" action="{{ route('notes') }}" class="flex-1 px-44">
                @csrf

                <div class="mt-8 flex flex-row justify-between">
                    <div class="w-3/6 mr-2">
                        <x-input-label for="title" :value="__('Titre de l\'évaluation')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="w-1/6 mx-2">
                        <x-input-label for="coefficient" :value="__('Coefficient')" />
                        <x-text-input id="coefficient" class="block mt-1 w-full" type="number" min="0"
                            max="20" step="0.5" name="coefficient" :value="old('coefficient')" required />
                        <x-input-error :messages="$errors->get('coefficient')" class="mt-2" />
                    </div>

                    <div class="flex flex-col justify-center mb-4 w-2/6">
                        <x-input-label for="coefficient" :value="__('Modifier une Evaluation')" />
                        <select id="evaluationSelect" name="evaluationSelect"
                            class="block w-full mt-1 bg-gray-800 text-gray-100 border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500">
                            <option value="">Aucune</option>
                            @foreach ($evaluations as $evaluation)
                                <option value="{{ $evaluation->id }}">{{ $evaluation->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

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
            <script>
                function fillEvaluationData() {
                    var selectElement = document.getElementById('evaluationSelect');
                    var evaluationId = selectElement.value;

                    if (evaluationId) {
                        var evaluationData = {!! json_encode($evaluations) !!}.find(evaluation => evaluation.id == evaluationId);

                        document.getElementById('title').value = evaluationData.title;
                        document.getElementById('coefficient').value = evaluationData.coeff;

                        @foreach ($students as $student)
                            document.getElementById('note{{ $student->id }}').value = evaluationData.notes.find(note => note
                                .user_id == {{ $student->id }})?.mark || '';
                            document.getElementById('description{{ $student->id }}').value = evaluationData.notes.find(note =>
                                note.user_id == {{ $student->id }})?.description || '';
                        @endforeach
                    } else {
                        document.getElementById('title').value = '';
                        document.getElementById('coefficient').value = '';

                        @foreach ($students as $student)
                            document.getElementById('note{{ $student->id }}').value = '';
                            document.getElementById('description{{ $student->id }}').value = '';
                        @endforeach
                    }
                }

                document.getElementById('evaluationSelect').addEventListener('change', fillEvaluationData);
                fillEvaluationData();
            </script>
        @elseif (Auth::user()->userType === 1)
            <div class="min-w-screen h-full flex items-center justify-center">
                <div class="w-full">
                    <div class="shadow-md rounded my-6">
                        {{-- <div class="text-white">{{ $notes }}</div> --}}
                        <div class="flex justify-end mb-4 gap-4">
                            <div>
                                <x-input-label for="coefficient" :value="__('Ordre')" />
                                <select id="markFilter" onchange="filterByOrdre()"
                                    class="block mt-1 bg-gray-800 text-gray-100 border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500">
                                    <option value="0">Aucun</option>
                                    <option value="1">Croissant</option>
                                    <option value="2">Décroissant</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="coefficient" :value="__('Matière')" />
                                <select id="subjectFilter" onchange="filterBySubject()"
                                    class="block mt-1 bg-gray-800 text-gray-100 border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500">
                                    <option value="">Toutes les matières</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subjectName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <table class="w-full divide-y divide-gray-200 rounded-lg bg-gray-800">
                            <thead class="">
                                <tr class="font medium text-xs text-left text-gray-100">
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">
                                        Coeff.
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
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{-- {{ $note->evaluations->subject->subjectName }} --}}
                                            {{ $note->evaluations->subject }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $note->evaluations->title }}
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            {{ $note->evaluations->coeff }}
                                        </td>
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
                <script>
                    function filterBySubject() {
                        var selectedSubject = document.getElementById('subjectFilter').value;
                        var rows = document.querySelectorAll('.text-gray-300');
                        rows.forEach(row => {
                            row.style.display = '';
                            var subject = row.querySelector('td:first-child').innerText;
                            if (selectedSubject === '' || subject === selectedSubject) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    }

                    function filterByOrdre() {
                        var sortOrder = document.getElementById('markFilter').value;
                        var rows = Array.from(document.querySelectorAll('.text-gray-300'));
                        rows.sort((a, b) => {
                            var valueA = parseFloat(a.querySelector('td:nth-child(4)').innerText);
                            var valueB = parseFloat(b.querySelector('td:nth-child(4)').innerText);

                            if (sortOrder == 1) {
                                return valueA - valueB;
                            } else if (sortOrder == 2) {
                                return valueB - valueA;
                            }
                            return 0;
                        });
                        var tableBody = document.querySelector('tbody');
                        while (tableBody.firstChild) {
                            tableBody.removeChild(tableBody.firstChild);
                        }
                        rows.forEach(row => tableBody.appendChild(row));
                    }
                </script>
        @endif
    </div>
</x-app-layout>
