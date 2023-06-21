<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between py-4">
            <div class="flex justify-between flex-1 sm:hidden">

                <span>
                    @if ($paginator->onFirstPage())
                        <span
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default select-none dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700 hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 dark:active:bg-gray-900 active:text-gray-700 dark:active:text-gray-400">
                            {!! __('pagination.previous') !!}
                        </button>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700 hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 dark:active:bg-gray-900 active:text-gray-700 dark:active:text-gray-400">
                            {!! __('pagination.next') !!}
                        </button>
                    @else
                        <span
                            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default select-none dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </span>


            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm leading-5 text-gray-700 dark:text-gray-400">
                        <span>{!! __('Showing') !!}</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('to') !!}</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('of') !!}</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span>
                        <span>{!! __('results') !!}</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex rounded-md shadow-sm">
                        <span>
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 cursor-default dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700 rounded-l-md"
                                        aria-hidden="true">
                                        <x-icon icon="arrow-left" class="w-5 h-5" width="20" height="20" />
                                    </span>
                                </span>
                            @else
                                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                    rel="prev"
                                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out bg-white border border-gray-300 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded-l-md hover:text-gray-400 dark:hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 dark:active:bg-gray-900 active:text-gray-500 dark:active:text-gray-500"
                                    aria-label="{{ __('pagination.previous') }}">
                                    <x-icon icon="arrow-left" class="w-5 h-5" width="20" height="20" />
                                </button>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 bg-white border border-gray-300 cursor-default select-none dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span
                                        wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span
                                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 cursor-default select-none dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button type="button"
                                                wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700 hover:text-gray-500 dark:hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 dark:active:bg-gray-900 active:text-gray-700 dark:active:text-gray-400"
                                                aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span>
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                    dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                    rel="next"
                                    class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out bg-white border border-gray-300 dark:text-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded-r-md hover:text-gray-400 dark:hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 dark:active:bg-gray-900 active:text-gray-500 dark:active:text-gray-500"
                                    aria-label="{{ __('pagination.next') }}">
                                    <x-icon icon="arrow-right" class="w-5 h-5" width="20" height="20" />
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 cursor-default dark:text-gray-400 dark:bg-gray-800 dark:border-gray-700 rounded-r-md"
                                        aria-hidden="true">
                                        <x-icon icon="arrow-right" class="w-5 h-5" width="20" height="20" />
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
                </div>



            </div>
        </nav>
    @endif
</div>
