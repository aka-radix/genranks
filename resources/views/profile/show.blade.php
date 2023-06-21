<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="pb-8 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <div class="w-full h-[250px]">
                    <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg"
                        class="w-full h-full rounded-tl-lg rounded-tr-lg">
                </div>
                <div class="flex flex-col items-center -mt-20">
                    <img src="https://vojislavd.com/ta-template-demo/assets/img/profile.jpg"
                        class="w-40 border-4 border-white rounded-full dark:border-gray-800">
                    <div class="flex items-center mt-2 space-x-2">
                        <p class="text-2xl dark:text-white">Mart</p>
                    </div>
                    <p class="text-gray-700 dark:text-white">{{ $user->rank }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->elo }}</p>
                </div>
            </div>


            <div class="flex flex-col my-4 space-y-4 2xl:flex-row 2xl:space-y-0 2xl:space-x-4">
                <div class="flex flex-col w-full 2xl:w-1/3">
                    <div class="flex-1 p-8 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white">Personal Info</h4>
                        <ul class="mt-2 text-gray-700 dark:text-white">
                            <li class="flex py-2 border-y dark:border-gray-600">
                                <span class="w-24 font-bold">Nickname:</span>
                                <span class="text-gray-700 dark:text-white">Poke</span>
                            </li>
                            <li class="flex py-2 border-b dark:border-gray-600">
                                <span class="w-24 font-bold">Joined:</span>
                                <span class="text-gray-700 dark:text-white">10 Jan 2022 (25 days ago)</span>
                            </li>
                            <li class="flex py-2 border-b dark:border-gray-600">
                                <span class="w-24 font-bold">Last seen:</span>
                                <span class="text-gray-700 dark:text-white">24 Jul, 1991</span>
                            </li>
                            <li class="flex items-center py-2 space-x-2 border-b dark:border-gray-600">
                                <span class="w-24 font-bold">Elsewhere:</span>
                                <a href="#" title="Facebook">
                                    <svg class="w-5 h-5 fill-current" id="Layer_1" data-name="Layer 1"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 506.86 506.86">
                                        <path class="dark:text-white"
                                            d="M506.86,253.43C506.86,113.46,393.39,0,253.43,0S0,113.46,0,253.43C0,379.92,92.68,484.77,213.83,503.78V326.69H149.48V253.43h64.35V197.6c0-63.52,37.84-98.6,95.72-98.6,27.73,0,56.73,5,56.73,5v62.36H334.33c-31.49,0-41.3,19.54-41.3,39.58v47.54h70.28l-11.23,73.26H293V503.78C414.18,484.77,506.86,379.92,506.86,253.43Z">
                                        </path>
                                        <path class="dark:text-white"
                                            d="M352.08,326.69l11.23-73.26H293V205.89c0-20,9.81-39.58,41.3-39.58h31.95V104s-29-5-56.73-5c-57.88,0-95.72,35.08-95.72,98.6v55.83H149.48v73.26h64.35V503.78a256.11,256.11,0,0,0,79.2,0V326.69Z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="#" title="Twitter">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 333333 333333" shape-rendering="geometricPrecision"
                                        text-rendering="geometricPrecision" image-rendering="optimizeQuality"
                                        fill-rule="evenodd" clip-rule="evenodd">
                                        <path
                                            d="M166667 0c92048 0 166667 74619 166667 166667s-74619 166667-166667 166667S0 258715 0 166667 74619 0 166667 0zm90493 110539c-6654 2976-13822 4953-21307 5835 7669-4593 13533-11870 16333-20535-7168 4239-15133 7348-23574 9011-6787-7211-16426-11694-27105-11694-20504 0-37104 16610-37104 37101 0 2893 320 5722 949 8450-30852-1564-58204-16333-76513-38806-3285 5666-5022 12109-5022 18661v4c0 12866 6532 24246 16500 30882-6083-180-11804-1876-16828-4626v464c0 17993 12789 33007 29783 36400-3113 845-6400 1313-9786 1313-2398 0-4709-247-7007-665 4746 14736 18448 25478 34673 25791-12722 9967-28700 15902-46120 15902-3006 0-5935-184-8860-534 16466 10565 35972 16684 56928 16684 68271 0 105636-56577 105636-105632 0-1630-36-3209-104-4806 7251-5187 13538-11733 18514-19185l17-17-3 2z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="#" title="LinkedIn">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 333333 333333" shape-rendering="geometricPrecision"
                                        text-rendering="geometricPrecision" image-rendering="optimizeQuality"
                                        fill-rule="evenodd" clip-rule="evenodd">
                                        <path
                                            d="M166667 0c92048 0 166667 74619 166667 166667s-74619 166667-166667 166667S0 258715 0 166667 74619 0 166667 0zm-18220 138885h28897v14814l418 1c4024-7220 13865-14814 28538-14814 30514-1 36157 18989 36157 43691v50320l-30136 1v-44607c0-10634-221-24322-15670-24322-15691 0-18096 11575-18096 23548v45382h-30109v-94013zm-20892-26114c0 8650-7020 15670-15670 15670s-15672-7020-15672-15670 7022-15670 15672-15670 15670 7020 15670 15670zm-31342 26114h31342v94013H96213v-94013z"
                                            fill="#0077b5"></path>
                                    </svg>
                                </a>
                                <a href="#" title="Github">
                                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" width="0"
                                        height="0" shape-rendering="geometricPrecision"
                                        text-rendering="geometricPrecision" image-rendering="optimizeQuality"
                                        fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 640 640">
                                        <path
                                            d="M319.988 7.973C143.293 7.973 0 151.242 0 327.96c0 141.392 91.678 261.298 218.826 303.63 16.004 2.964 21.886-6.957 21.886-15.414 0-7.63-.319-32.835-.449-59.552-89.032 19.359-107.8-37.772-107.8-37.772-14.552-36.993-35.529-46.831-35.529-46.831-29.032-19.879 2.209-19.442 2.209-19.442 32.126 2.245 49.04 32.954 49.04 32.954 28.56 48.922 74.883 34.76 93.131 26.598 2.882-20.681 11.15-34.807 20.315-42.803-71.08-8.067-145.797-35.516-145.797-158.14 0-34.926 12.52-63.485 32.965-85.88-3.33-8.078-14.291-40.606 3.083-84.674 0 0 26.87-8.61 88.029 32.8 25.512-7.075 52.878-10.642 80.056-10.76 27.2.118 54.614 3.673 80.162 10.76 61.076-41.386 87.922-32.8 87.922-32.8 17.398 44.08 6.485 76.631 3.154 84.675 20.516 22.394 32.93 50.953 32.93 85.879 0 122.907-74.883 149.93-146.117 157.856 11.481 9.921 21.733 29.398 21.733 59.233 0 42.792-.366 77.28-.366 87.804 0 8.516 5.764 18.473 21.992 15.354 127.057-42.318 218.711-162.238 218.711-303.63C639.965 151.242 496.672 7.973 319.988 7.973z"
                                            fill="#000000"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>



                    <div class="flex-1 p-8 mt-4 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white">Activity log</h4>
                        <div class="relative px-4">
                            <div
                                class="absolute h-full border border-dashed border-opacity-20 border-secondary dark:border-white">
                            </div>

                            <!-- start::Timeline item -->
                            <div class="flex items-center w-full my-6 -ml-1.5">
                                <div class="z-10 w-1/12">
                                    <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                                </div>
                                <div class="w-11/12">
                                    <p class="text-sm dark:text-white">Profile information changed.</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">3 min ago</p>
                                </div>
                            </div>
                            <!-- end::Timeline item -->

                            <!-- start::Timeline item -->
                            <div class="flex items-center w-full my-6 -ml-1.5">
                                <div class="z-10 w-1/12">
                                    <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                                </div>
                                <div class="w-11/12">
                                    <p class="text-sm dark:text-white">
                                        Linked their <a href="#"
                                            class="font-bold text-blue-600 dark:text-blue-400">Facebook</a>.
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">15 min ago</p>
                                </div>
                            </div>
                            <!-- end::Timeline item -->

                            <!-- start::Timeline item -->
                            <div class="flex items-center w-full my-6 -ml-1.5">
                                <div class="z-10 w-1/12">
                                    <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                                </div>
                                <div class="w-11/12">
                                    <p class="text-sm dark:text-white">
                                        Played game <a href="#"
                                            class="font-bold text-blue-600 dark:text-blue-400">#4563</a> and won (27).
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">57 min ago</p>
                                </div>
                            </div>
                            <!-- end::Timeline item -->

                            <!-- start::Timeline item -->
                            <div class="flex items-center w-full my-6 -ml-1.5">
                                <div class="z-10 w-1/12">
                                    <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                                </div>
                                <div class="w-11/12">
                                    <p class="text-sm dark:text-white">
                                        Played game <a href="#"
                                            class="font-bold text-blue-600 dark:text-blue-400">#4561</a> and lost (11).
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">57 min ago</p>
                                </div>
                            </div>
                            <!-- end::Timeline item -->

                            <!-- start::Timeline item -->
                            <div class="flex items-center w-full my-6 -ml-1.5">
                                <div class="z-10 w-1/12">
                                    <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                                </div>
                                <div class="w-11/12">
                                    <p class="text-sm dark:text-white">Got profile approved.</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">2 hours ago</p>
                                </div>
                            </div>
                            <!-- end::Timeline item -->
                        </div>
                    </div>
                </div>



                <div class="flex flex-col w-full 2xl:w-2/3">

                    <div class="flex-1 p-8 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white">About</h4>
                        <p class="mt-2 text-gray-700 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur
                            adipisicing
                            elit. Nesciunt voluptates obcaecati numquam error et ut fugiat asperiores. Sunt
                            nulla ad incidunt laboriosam, laudantium est unde natus cum numquam, neque
                            facere. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, magni odio
                            magnam commodi sunt ipsum eum! Voluptas eveniet aperiam at maxime, iste id dicta
                            autem odio laudantium eligendi commodi distinctio!</p>
                    </div>


                    <div class="flex-1 p-8 mt-4 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white">Statistics</h4>

                        <div class="grid grid-cols-1 gap-8 mt-4 lg:grid-cols-3">
                            <div
                                class="px-6 py-6 bg-gray-100 border border-gray-300 rounded-lg shadow-xl dark:bg-gray-700 dark:border-gray-600">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">Games
                                        Played</span>
                                    <span
                                        class="px-2 py-1 text-xs text-gray-500 transition duration-200 bg-gray-200 rounded-lg cursor-default dark:text-gray-400 dark:bg-gray-500 hover:bg-gray-500 hover:text-gray-200">7
                                        days</span>
                                </div>
                                <div class="flex items-center justify-between mt-6">
                                    <div>
                                        <svg class="w-12 h-12 p-2.5 bg-indigo-400 bg-opacity-20 rounded-full text-indigo-600 dark:text-indigo-400 border border-indigo-600 dark:border-indigo-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex items-end">
                                            <span
                                                class="text-2xl font-bold text-gray-900 2xl:text-3xl dark:text-white">8,141</span>
                                            <div class="flex items-center mb-1 ml-2">
                                                <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                </svg>
                                                <span
                                                    class="font-bold text-sm text-gray-500 dark:text-gray-400 ml-0.5">3%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-6 bg-gray-100 border border-gray-300 rounded-lg shadow-xl dark:bg-gray-700 dark:border-gray-600">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-bold text-green-600 dark:text-green-400">Win
                                        Percentage</span>
                                    <span
                                        class="px-2 py-1 text-xs text-gray-500 transition duration-200 bg-gray-200 rounded-lg cursor-default dark:text-gray-400 dark:bg-gray-500 hover:bg-gray-500 hover:text-gray-200">7
                                        days</span>
                                </div>
                                <div class="flex items-center justify-between mt-6">
                                    <div>
                                        <svg class="w-12 h-12 p-2.5 bg-green-400 bg-opacity-20 rounded-full text-green-600 dark:text-green-400 border border-green-600 dark:border-green-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex items-end">
                                            <span
                                                class="text-2xl font-bold text-gray-900 2xl:text-3xl dark:text-white">42%</span>
                                            <div class="flex items-center mb-1 ml-2">
                                                <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                </svg>
                                                <span
                                                    class="font-bold text-sm text-gray-500 dark:text-gray-400 ml-0.5">2%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-6 bg-gray-100 border border-gray-300 rounded-lg shadow-xl dark:bg-gray-700 dark:border-gray-600">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-bold text-blue-600 dark:text-blue-400">Elo Change</span>
                                    <span
                                        class="px-2 py-1 text-xs text-gray-500 transition duration-200 bg-gray-200 rounded-lg cursor-default dark:text-gray-400 dark:bg-gray-500 hover:bg-gray-500 hover:text-gray-200">7
                                        days</span>
                                </div>
                                <div class="flex items-center justify-between mt-6">
                                    <div>
                                        <svg class="w-12 h-12 p-2.5 bg-blue-400 bg-opacity-20 rounded-full text-blue-600 dark:text-blue-400 border border-blue-600 dark:border-blue-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex items-end">
                                            <span
                                                class="text-2xl font-bold text-gray-900 2xl:text-3xl dark:text-white">54</span>
                                            <div class="flex items-center mb-1 ml-2">
                                                <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                </svg>
                                                <span
                                                    class="font-bold text-sm text-gray-500 dark:text-gray-400 ml-0.5">7%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>


            <div class="p-8 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white">Games Played (532)</h4>
                </div>
                <div
                    class="grid grid-cols-2 gap-8 mt-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8">
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection1.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Diane Aguilar</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">UI/UX Design at Upwork</p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection2.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Frances Mather</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Software Engineer at Facebook
                        </p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection3.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Carlos Friedrich</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Front-End Developer at Tailwind
                            CSS
                        </p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection4.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Donna Serrano</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">System Engineer at Tesla</p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection5.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Randall Tabron</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Software Developer at Upwork
                        </p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection6.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">John McCleary</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Software Engineer at Laravel
                        </p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection7.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Amanda Noble</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Graphic Designer at Tailwind
                            CSS</p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection8.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Christine Drew</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Senior Android Developer at
                            Google</p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection9.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Lucas Bell</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Creative Writer at Upwork</p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection10.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Debra Herring</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Co-Founder at Alpine.js</p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection11.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Benjamin Farrior</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Software Engineer Lead at
                            Microsoft
                        </p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection12.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Maria Heal</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Linux System Administrator at
                            Twitter
                        </p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection13.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Edward Ice</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Customer Support at Instagram
                        </p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection14.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Jeffery Silver</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Software Engineer at Twitter
                        </p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection15.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Jennifer Schultz</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Project Manager at Google</p>
                    </a>
                    <a href="#"
                        class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                        <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection16.jpg"
                            class="w-16 rounded-full">
                        <p class="mt-1 text-sm font-bold text-center">Joseph Marlatt</p>
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Team Lead at Facebook</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
