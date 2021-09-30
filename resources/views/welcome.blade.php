<x-guest-layout>
    <div class="bg-white shadow overflow-hidden sm:rounded-md">

        <ul role="list" class="divide-y divide-gray-200">
            @foreach ($batches as $batch)
                <x-batch :batch="$batch" />
            @endforeach
        </ul>
    </div>

</x-guest-layout>
