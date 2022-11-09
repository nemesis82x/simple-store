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


                    <!-- Body -->
                    <form wire:submit.prevent="save">
                        @csrf
                        <div>
                            @if (session()->has('message'))
                                <div class="bg-blue-100 border border-blue-400 text-black px-4 py-3 rounded relative mb-2">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>

                    <div class="flex flex-col md:flex-row md:space-x-8">
                        <div class="w-full md:w-80">
{{--                            <img class="w-full rounded" src="https://picsum.photos/200" alt="Extra large avatar" >--}}


                            @if ($tmp_avatar)
                                <img class="object-cover w-80 h-48 rounded-md" src="{{ $tmp_avatar->temporaryUrl() }}">
                            @else
                                <img class="object-cover w-80 h-48 rounded-md" src="{{ $avatar }}">
                            @endif
                            <input type="file" wire:model="tmp_avatar" class="bg-yellow-500" >
                            @error('avatar') <span class="error">{{ $message }}</span> @enderror

                        </div>
                        <div class="flex flex-col mt-4 md:mt-0 md:w-80">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="name" id="name" wire:model="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Full Name</label>
                            </div>
                        </div>
                        <div class="flex flex-col mt-4 md:mt-0 md:w-80">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="email" name="email" id="email" wire:model="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                            </div>
                            <input type="text" wire:model="role">

                            Hero
                            <input type="text" wire:model="hero">
                            Pic01
                            <input type="text" wire:model="pic01">
                            Pic02
                            <input type="text" wire:model="pic02">
                            Pic03
                            <input type="text" wire:model="pic03">
                        </div>
                    </div>
                        <div>
                            <x-primary-button wire:click="save" type="submit">
                                Save
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Body -->
                </div>
            </div>
        </div>
    </div>
</div>
