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
                        <div class="w-full">
                            <div class="grid grid-cols-2 justify-between gap-8 ">
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                                <div>
                                    <input type="text" class="w-96">
                                </div>
                        </div>
                        </div>



                    </div>
                        <div>
                            </div>

                        <div class="flex flex-row md:flex-row space-y-8 gap-8">
                            <div id="none" class="mb-6">
                             </div>

                            <div id="pic01" class="mb-6">
                                <label for="pic01-input" class="cursor-pointer">
                                @if ($tmp_pic01)
                                    <img class="object-cover rounded-md cursor-pointer" src="{{ $tmp_pic01->temporaryUrl() }}">
                                @else
                                    <img src="storage/picture/{{$pic01}}" class="object-cover rounded-md h-48 w-96" alt="{{Str::substr($pic01,11)}}"/>
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
                                            <img src="storage/picture/{{$pic02}}" class="object-cover rounded-md h-48 w-96" alt="{{Str::substr($pic02,11)}}"/>
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
                                            <img src="storage/picture/{{$pic03}}" class="object-cover rounded-md h-48 w-96" alt="{{Str::substr($pic03,11)}}"/>
                                        @endif
                                    <input id="pic03-input" type="file" wire:model="tmp_pic03" hidden />
                                            @error('tmp_pic03') <p class="bg-red-400 border border-red-400 text-black px-4 py-3 rounded relative mb-2">{{ $message }}</p> @enderror
                                    </label>
                                </div>
                            <div id="none" class="mb-6">
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
