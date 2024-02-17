<x-app-layout>
    <div class="overflow-x-auto px-24">
        <div class="min-w-screen min-h-screen flex items-center justify-center">
            <div class="w-full">
                <div class="shadow-md rounded my-6">
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg bg-gray-800">
                        <thead>
                            <tr class="font medium text-xs text-left text-gray-100">
                                <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Evaluation</th>
                                <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Coeff.</th>
                                <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Min.</th>
                                <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Moy.</th>
                                <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Max.</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($notes as $note)
                                <tr class="text-gray-300 text-sm">
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
