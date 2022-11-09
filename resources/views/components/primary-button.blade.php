<button {{ $attributes->merge(['type' => 'submit', 'class' => 'block w-full bg-blue-100 text-sm text-gray-500 rounded-md my-4 px-2 py-2']) }}>
    {{ $slot }}
</button>
