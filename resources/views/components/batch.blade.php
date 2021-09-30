@props(['batch'])

<li>
    <a href="#" class="block hover:bg-gray-50">
        <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-indigo-600 truncate">
                    {{ $batch->name }} ({{ $batch->progress() }}%)
                </p>
                <div class="ml-2 flex-shrink-0 flex">

                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                        {{ $attributes->class([
    'bg-green-100 text-green-800' => $batch->finished(),
    'bg-yellow-100 text-yellow-800' => ! $batch->finished(),
    'bg-red-100 text-red-800' => $batch->cancelled(),
]) }}>

                        @if (! $batch->finished()) In Progress
                        @elseif ($batch->finished()) Finished
                        @elseif($batch->cancelled()) Cancelled
                        @endif
                    </p>
                </div>
            </div>
            <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">
                    <p class="flex items-center text-sm text-gray-500">
                        <!-- Heroicon name: solid/users -->
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                        Total Jobs: {{ $batch->totalJobs }}
                    </p>
                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                        <!-- Heroicon name: solid/location-marker -->
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        Pending Jobs: {{ $batch->pendingJobs }}
                    </p>
					<p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                        <!-- Heroicon name: solid/location-marker -->
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        Processed Jobs: {{ $batch->processedJobs() }}
                    </p>
                </div>
            </div>
        </div>
    </a>
</li>
