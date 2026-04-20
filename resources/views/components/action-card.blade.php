@props(['title', 'desc', 'icon', 'link' => '#'])

<a href="{{ $link }}" {{ $attributes->merge(['class' => 'group p-6 bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all duration-300']) }}>
    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
        <span class="font-bold text-xs">{{ strtoupper(substr($icon, 0, 2)) }}</span> 
    </div>
    <h4 class="font-bold text-gray-800 text-lg">{{ $title }}</h4>
    <p class="text-sm text-gray-500 mt-2">{{ $desc }}</p>
    <div class="mt-4 flex items-center text-xs font-bold text-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity">
        Proceed <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
    </div>
</a>