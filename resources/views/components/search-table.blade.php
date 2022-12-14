<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
<tr>
    <th scope="col" class="px-6">
        <div class="flex items-center">
            <input wire:model="searchName" type="text" placeholder="Filter user by name"
                   class="w-full rounded-lg shadow">
    </th>
    <th scope="col" class="px-6">
    <input wire:model="searchEmail" type="text" placeholder="Filter user by email"
           class="w-full rounded-lg shadow">
    </th>

    <th scope="col" class="py-3 px-6">
        <span class="sr-only"></span>
    </th>
    <th scope="col" class="py-3 px-6">
        <span class="sr-only"></span>
    </th>
    <th scope="col" class="py-3 px-6">
        <span class="sr-only"></span>
    </th>
</tr>
</thead>
