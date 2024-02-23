<x-app-layout>
    <div class="overflow-x-auto px-24">
        <div class="min-w-screen flex mt-8 justify-center">
            @if (Auth::user()->userType === 2)
                <div class="w-full">
                    <div class="flex flex-row justify-center gap-4">
                        <div class="flex items-center mb-4">
                            <input type="radio" id="displayTable" name="displayOption" value="table" checked
                                class="sr-only peer">
                            <label for="displayTable"
                                class="relative flex items-center cursor-pointer px-3 py-2 rounded-md bg-gray-800 text-gray-500 hover:bg-gray-700 transition-colors duration-300 peer-checked:bg-gray-700 peer-checked:text-white peer-checked:text-white">
                                <span class="">Tableau</span>
                            </label>
                        </div>
                        <div class="flex items-center mb-4">
                            <input type="radio" id="displayGraph" name="displayOption" value="graph"
                                class="sr-only peer">
                            <label for="displayGraph"
                                class="relative flex items-center cursor-pointer px-3 py-2 rounded-md bg-gray-800 text-gray-500 hover:bg-gray-700 transition-colors duration-300 peer-checked:bg-gray-700 peer-checked:text-white peer-checked:text-white">
                                <span class="">Graphique</span>
                            </label>
                        </div>
                    </div>
                    <div id="tableContent" class="rounded my-4">
                        <div class="flex justify-end mb-4 gap-4">
                            <div>
                                <x-input-label for="coefficient" :value="__('Moyenne')" />
                                <select id="markFilterMoyenne" onchange="filterByMoyenne()"
                                    class="block mt-1 bg-gray-800 text-gray-100 border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 cursor-pointer hover:bg-gray-600 transition duration-300 ease-in-out">
                                    <option value="0">Aucun</option>
                                    <option value="1">Croissant</option>
                                    <option value="2">Décroissant</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="coefficient" :value="__('Date')" />
                                <select id="markFilterDate" onchange="filterByDate()"
                                    class="block mt-1 bg-gray-800 text-gray-100 border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 cursor-pointer hover:bg-gray-600 transition duration-300 ease-in-out">
                                    <option value="0">Aucun</option>
                                    <option value="1">Croissant</option>
                                    <option value="2">Décroissant</option>
                                </select>
                            </div>

                        </div>
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg bg-gray-800 shadow-md">
                            <thead>
                                <tr class="font medium text-xs text-left text-gray-100">
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Evaluation
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Coeff.</th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Min.</th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Moy.</th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Max.</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($evaluations as $evaluation)
                                    <tr class="text-gray-300">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $evaluation->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $evaluation->coeff }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($evaluation->created_at)->locale('fr')->isoFormat('D MMMM YYYY') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $stats[$evaluation->id]['min'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ number_format($stats[$evaluation->id]['avg'], 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $stats[$evaluation->id]['max'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="graphContent" class="hidden mt-8">
                    </div>
                </div>
                <script>
                    function filterByMoyenne() {
                        var sortOrder = document.getElementById('markFilterMoyenne').value;
                        var rows = Array.from(document.querySelectorAll('.text-gray-300'));
                        rows.sort((a, b) => {
                            var valueA = parseFloat(a.querySelector('td:nth-child(5)').innerText);
                            var valueB = parseFloat(b.querySelector('td:nth-child(5)').innerText);

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

                    function filterByDate() {
                        var sortOrder = document.getElementById('markFilterDate').value;
                        var rows = Array.from(document.querySelectorAll('.text-gray-300'));
                        rows.sort((a, b) => {
                            var valueA = new Date(a.querySelector('td:nth-child(3)').innerText);
                            var valueB = new Date(b.querySelector('td:nth-child(3)').innerText);

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
            @elseif (Auth::user()->userType === 1)
                <!-- Contenu pour les élèves -->
                <div class="w-full">
                    <div class="flex flex-row justify-center gap-4">
                        <div class="flex items-center mb-4">
                            <input type="radio" id="displayTable" name="displayOption" value="table" checked
                                class="sr-only peer">
                            <label for="displayTable"
                                class="relative flex items-center cursor-pointer px-3 py-2 rounded-md bg-gray-800 text-gray-500 hover:bg-gray-700 transition-colors duration-300 peer-checked:bg-gray-700 peer-checked:text-white peer-checked:text-white">
                                <span class="">Bulletin</span>
                            </label>
                        </div>
                        <div class="flex items-center mb-4">
                            <input type="radio" id="displayGraph" name="displayOption" value="graph"
                                class="sr-only peer">
                            <label for="displayGraph"
                                class="relative flex items-center cursor-pointer px-3 py-2 rounded-md bg-gray-800 text-gray-500 hover:bg-gray-700 transition-colors duration-300 peer-checked:bg-gray-700 peer-checked:text-white peer-checked:text-white">
                                <span class="">Evolution</span>
                            </label>
                        </div>
                    </div>
                    <div id="tableContent" class="shadow-md rounded my-6">
                        {{-- <div>{{ $subjects }}</div> --}}
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg bg-gray-800">
                            <thead>
                                <tr class="font medium text-xs text-left text-gray-100">
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Matière</th>
                                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Moyenne</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($bulletin as $subject => $average)
                                    <tr class="text-gray-300">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $subject }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $average }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="graphContent" class="hidden mt-8">
                        <!-- Contenu du graphique -->
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const displayTable = document.getElementById('displayTable');
        const displayGraph = document.getElementById('displayGraph');
        const tableContent = document.getElementById('tableContent');
        const graphContent = document.getElementById('graphContent');

        function toggleView() {
            if (displayTable.checked) {
                tableContent.style.display = 'block';
                graphContent.style.display = 'none';
            } else if (displayGraph.checked) {
                tableContent.style.display = 'none';
                graphContent.style.display = 'block';
            }
        }

        toggleView();

        displayTable.addEventListener('change', toggleView);
        displayGraph.addEventListener('change', toggleView);
    });
</script>
