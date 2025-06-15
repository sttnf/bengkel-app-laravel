@props([
    'title',
    'value',
    'icon',
    'color' => 'indigo',
    'trend' => null,
    'trendValue' => null,
    'subtitle' => null
])

<div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-md transition-shadow duration-200">
    <div class="p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-{{ $color }}-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-{{ $color }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $icon !!}
                    </svg>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">{{ $title }}</dt>
                    <dd class="text-2xl font-bold text-gray-900">{{ $value }}</dd>
                    @if($subtitle)
                        <dd class="text-sm text-gray-600">{{ $subtitle }}</dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
    
    @if($trend || $trendValue)
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
            <div class="flex items-center justify-between text-sm">
                @if($trendValue)
                    <div class="flex items-center">
                        @if($trend === 'up')
                            <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17l9.2-9.2M17 17V7H7"></path>
                            </svg>
                            <span class="text-green-600 font-medium">+{{ $trendValue }}%</span>
                        @elseif($trend === 'down')
                            <svg class="w-4 h-4 text-red-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 7l-9.2 9.2M7 7v10h10"></path>
                            </svg>
                            <span class="text-red-600 font-medium">{{ $trendValue }}%</span>
                        @else
                            <span class="text-gray-600 font-medium">{{ $trendValue }}%</span>
                        @endif
                        <span class="text-gray-500 ml-1">vs last month</span>
                    </div>
                @endif
                
                {{ $slot }}
            </div>
        </div>
    @endif
</div>
