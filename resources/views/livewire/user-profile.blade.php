<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Users Profile') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div>
                    <div>
                        @if (session()->has('message'))
                            <div class="bg-blue-100 border border-blue-400 text-black px-4 py-3 rounded relative mb-2">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>

                    <!-- Body -->
                    <form>
                    <div class="flex flex-row space-x-8">
                        <div>
                            <img class="w-36 h-36 rounded" src="https://picsum.photos/200" alt="Extra large avatar">
                        </div>
                        <div class="flex flex-col">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <input wire:model="pippo" type="text">
                            <input wire:model="pippo" type="text">
                        </div>
                    </div>
                    </form>

                    <!-- Body -->
                </div>
            </div>
        </div>
    </div>
</div>
