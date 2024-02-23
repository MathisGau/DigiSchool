<x-app-layout>
    <div class="h-screen flex flex-row items-center justify-center gap-12 py-20">
        <div class="flex justify-center">
            <div class="flex justify-center p-6 dark:bg-gray-800 rounded-lg w-max">
                <p class="text-white text-m whitespace-nowrap">
                    {{ __('Bienvenue ') }}{{ Auth::user()->name }}{{ __(' !') }}
                </p>
            </div>
        </div>

        <div id="separator_y" class="border border-white w-auto h-full"></div>

        <div
            class="h-80 flex flex-col items-center text-white dark:bg-gray-800 rounded-lg w-max p-6 overflow-y-scroll overflow-x-hidden custom-scrollbar-style">
            {{ $notifications->where('is_read', 0)->count() > 0 ? __('Vous avez ') . $notifications->where('is_read', 0)->count() . __(' nouvelle' . ($notifications->where('is_read', 0)->count() > 1 ? 's' : '')) . __(' notification' . ($notifications->where('is_read', 0)->count() > 1 ? 's' : '')) : __('Vous n\'avez pas de nouvelle notification') }}
            <div id="separator_x" class="border border-white w-full h-auto my-5"></div>
            <ul class="gap-6 mt-2">
                @foreach ($notifications as $notification)
                    <form id="markAsReadForm_{{ $notification->id }}" action="{{ route('dashboard') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                        <li class="bg-gray-900 mb-4 cursor-pointer rounded-lg p-5 border-t-{{ $notification->is_read ? '0' : '4' }} border-blue-900"
                            onclick="document.getElementById('markAsReadForm_{{ $notification->id }}').submit()">
                            {{ $notification->content }}
                        </li>
                    </form>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>

<style>
    .custom-scrollbar-style::-webkit-scrollbar {
        width: 10px;
    }

    .custom-scrollbar-style::-webkit-scrollbar-thumb {
        background-color: #4f4f4f;
        border-radius: 5px;
    }

    .custom-scrollbar-style::-webkit-scrollbar-track {
        background-color: #333;
        border-radius: 5px;
    }
</style>
