@props(['links'])

<div class="flex items-center justify-between mb-2">
    <h2 class="text-3xl font-bold dark:text-white">{{ end($links)['text'] }}</h2>
    <ol class="flex items-center whitespace-nowrap">
        @foreach ($links as $link)
        <li class="inline-flex items-center">
            <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-hidden focus:text-blue-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500" href="{{ $link['url'] }}">
                {{ $link['text'] }}
            </a>
            @if (!$loop->last)
            <svg class="shrink-0 mx-2 size-4 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
            @endif
        </li>
        @endforeach
    </ol>
</div>