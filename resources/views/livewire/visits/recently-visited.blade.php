@php
    use Carbon\Carbon;
@endphp

<div>
    @if(isset($visits) && count($visits) > 0)
        <div class="flex justify-start gap-4 items-center mb-4">
            <h1 class="text-2xl font-bold">Recently Visited</h1>
            <a href="/visit/create" wire:navigate class="bg-blue-500 text-white font-bold w-8 h-8 rounded-full flex items-center justify-center">
                +
            </a>
        </div>
    
        <div class="relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 flex-wrap">
            @if(!$showAll)
                <!-- Navigation Buttons -->
                <button wire:click="previousPage" wire:loading.attr="disabled" class="absolute left-[-40px] top-1/2 transform -translate-y-1/2 bg-gray-600/40 text-white p-3 rounded-full shadow-lg hover:bg-gray-700 transition-colors duration-300">
                    &lt;
                </button>
            @endif

            @foreach ($visits as $visit)
                @php
                    $c1 = $visit->country;
                    $c2 = auth()->user()->country;
                
                    $distance = calculateDistance($c1, $c2);
                @endphp
                <div class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden p-4 space-y-4 justify-between h-[200px]">
                    <div class="flex space-x-4">
                        <div>
                            <img src="https://hatscripts.github.io/circle-flags/flags/{{ strtolower($visit->country->iso2) }}.svg" alt="Country Logo" class="w-20 h-20 object-cover rounded-full border border-gray-300">
                        </div>
                        <div>
                            <a href="#" class="text-xl font-semibold text-gray-800 hover:underline cursor-pointer">{{ $visit->country->name }}</a>
                            <x-rating rating="{{ $visit->rating }}"/>
                            <p class="mt-2"><b>Date:</b> {{ Carbon::parse($visit->start_date)->format('d. M. Y') }} - 
                                {{ Carbon::parse($visit->end_date)->format('d. M. Y') }}</p>
                            <p><b>Distance from Home:</b> {{ $distance }} km</p>
                        </div>
                    </div>
                    <button wire:click="" class="py-2 px-4 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors duration-300">
                        View More
                    </button>
                </div>
            @endforeach 

            @if(!$showAll)
                <button wire:click="nextPage" wire:loading.attr="disabled" class="absolute right-[-40px] top-1/2 transform -translate-y-1/2 bg-gray-600/40 text-white p-3 rounded-full shadow-lg hover:bg-gray-700 transition-colors duration-300">
                    &gt;
                </button>
            @endif

            <x-loading />
        
        </div>
    
        <div class="flex justify-center mt-4">
            @if(!$showAll)
                <button wire:click="viewAll" class="py-2 px-6 shadow-md bg-white text-gray-600 rounded-full hover:bg-gray-50 transition-colors duration-300">
                    View All
                </button>
            @else
                <button wire:click="viewAll" class="fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50 py-2 px-6 shadow-md bg-gray-500 text-white rounded-full hover:bg-gray-600 transition-colors duration-300">
                    Show Less
                </button>
            @endif
        </div>

    @else
        <div class="flex flex-col justify-center items-center bg-white rounded-lg shadow-lg overflow-hidden p-4 h-[200px] gap-4">
            <p class="text-2xl text-center text-gray-500">Kick Off Your Journey: Log Your First Visit!</p>
            <a href="/visit/create" wire:navigate class="bg-blue-500 text-white font-bold w-10 h-10 rounded-full flex items-center justify-center">
                +
            </a>
        </div>
    @endif
</div>




