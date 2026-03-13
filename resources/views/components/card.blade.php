@props([
    'title' => null,
    'titleSize' => '2xl', 
])

<div class="px-5 py-4 w-full flex justify-center">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-md p-6">
        @if (!empty($title))
            <h1 class="font-bold text-gray-800 mb-3 text-{{ $titleSize }}">
                {{ $title }}
            </h1>
        @endif
        {{ $slot }}
    </div>
</div>