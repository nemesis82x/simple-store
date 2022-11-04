@php use Illuminate\Support\Facades\Route;use Livewire\ComponentConcerns\RendersLivewireComponents;use Livewire\Request; @endphp
    <!-- drawer init and toggle -->
<div class="text-center">
    <button data-drawer-target="drawer-body-scrolling" data-drawer-show="drawer-body-scrolling"
            data-drawer-body-scrolling="true" type="button"
            class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg  hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open admin menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"></path>
        </svg>
        <span
            class=" mx-2 uppercase text-xl"> Menu </span>
    </button>
</div>
