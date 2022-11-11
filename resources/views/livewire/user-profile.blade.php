<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Users Profile') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 shadow-lg">
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
                                @if (session()->has('error'))
                                <div class="bg-red-400 border border-red-400 text-black px-4 py-3 rounded relative mb-2">
                                    {{ session('error') }}
                                </div>
                                @endif
                        </div>

                        <div id="hero" class="mb-6">
                            <div class="w-full">
                                <label for="hero-input" class="cursor-pointer">
                                    @if ($tmp_hero)
                                        <img class="object-cover w-full h-48 rounded-md " src="{{ $tmp_hero->temporaryUrl() }}">
                                    @else
                                        <img src="storage/hero/{{$hero}}" class="object-cover w-full h-48 rounded-md" alt="{{Str::substr($hero,11)}}"/>
                                    @endif
                                <input id="hero-input" type="file" wire:model="tmp_hero" hidden />
                                        @error('tmp_hero') <p class="bg-red-400 border border-red-400 text-black px-4 py-3 rounded relative mb-2">{{ $message }}</p> @enderror
                                </label>

                            </div>
                        </div>

                    <div class="flex flex-col md:flex-row md:space-x-8">
                        <div class="w-full md:w-80">
                            <label for="avatar-input" class="cursor-pointer">
                            @if ($tmp_avatar)
                                    <img class="object-cover w-80 h-48 rounded-md" src="{{ $tmp_avatar->temporaryUrl() }}">
                            @else
                                    <img src="storage/avatar/{{$avatar}}" class="object-cover w-80 h-48 rounded-md cursor-pointer" alt=" {{Str::substr($avatar,11)}}"/>
                            @endif

                                    <input id="avatar-input" type="file" wire:model="tmp_avatar" hidden />
                            @error('tmp_avatar') <p class="bg-red-400 border border-red-400 text-black px-4 py-3 rounded relative mb-2">{{ $message }}</p> @enderror
                                </label>

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
                            </div>

                        <div class="flex flex-row md:flex-row md:space-x-8 space-y-8">
                            <div id="pic01" class="mb-6">
                             </div>

                            <div id="pic01" class="mb-6">
                                <label for="pic01-input" class="cursor-pointer">
                                @if ($tmp_pic01)
                                    <img class="object-cover rounded-md cursor-pointer" src="{{ $tmp_pic01->temporaryUrl() }}">
                                @else
                                    <img src="storage/picture/{{$pic01}}" class="object-cover rounded-md" alt="{{Str::substr($pic01,11)}}"/>
                                @endif
                                    <input id="pic01-input" type="file" wire:model="tmp_pic01" hidden />
                                    @error('tmp_pic01') <p class="bg-red-400 border border-red-400 text-black px-4 py-3 rounded relative mb-2">{{ $message }}</p> @enderror
                                </label>
                            </div>

                            <div id="pic02" class="mb-6">
                                <label for="pic02-input" class="cursor-pointer">
                                        @if ($tmp_pic02)
                                            <img class="object-cover rounded-md cursor-pointer" src="{{ $tmp_pic02->temporaryUrl() }}">
                                        @else
                                            <img src="storage/picture/{{$pic02}}" class="object-cover rounded-md" alt="{{Str::substr($pic02,11)}}"/>
                                        @endif
                                    <input id="pic02-input" type="file" wire:model="tmp_pic02" hidden />
                                            @error('tmp_pic02') <p class="bg-red-400 border border-red-400 text-black px-4 py-3 rounded relative mb-2">{{ $message }}</p> @enderror
                                    </label>
                            </div>

                            <div id="pic03" class="mb-6">
                                <label for="pic03-input" class="cursor-pointer">
                                        @if ($tmp_pic03)
                                            <img class="object-cover rounded-md cursor-pointer" src="{{ $tmp_pic03->temporaryUrl() }}">
                                        @else
                                            <img src="storage/picture/{{$pic03}}" class="object-cover rounded-md" alt="{{Str::substr($pic03,11)}}"/>
                                        @endif
                                    <input id="pic03-input" type="file" wire:model="tmp_pic03" hidden />
                                            @error('tmp_pic03') <p class="bg-red-400 border border-red-400 text-black px-4 py-3 rounded relative mb-2">{{ $message }}</p> @enderror
                                    </label>
                                </div>
                            </div>

                            <x-primary-button type="submit">
                                Save
                            </x-primary-button>
                    </form>

                    <!-- Body -->
                </div>
            </div>
        </div>
    </div>
</div>
