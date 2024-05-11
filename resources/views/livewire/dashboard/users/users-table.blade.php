<div>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input 
                                wire:model.live.debounce.300ms="search"
                                type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" required="">
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">User Type :</label>
                            <select 
                                wire:model.live="filterRole"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">All</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                @include('livewire.includes.table-sort', [
                                    'column' => 'name', 
                                    'name' => 'Name'
                                ])
                                @include('livewire.includes.table-sort', [
                                    'column' => 'email', 
                                    'name' => 'Email'
                                ])
                                <th scope="col" class="px-4 py-3">
                                    <span>Role</span>
                                </th>
                                @include('livewire.includes.table-sort', [
                                    'column' => 'created_at', 
                                    'name' => 'Joined'
                                ])
                                @include('livewire.includes.table-sort', [
                                    'column' => 'updated_at', 
                                    'name' => 'Last update'
                                ])
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr wire:key="{{ $user->id }}" class="border-b dark:border-gray-700">
                                    <th 
                                        scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                    <div x-data="{photoPreview: null}" class="flex gap-2 items-center">
                                    <div class="mt-2" x-show="! photoPreview">
                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-full h-12 w-12 object-cover">
                                    </div>
                                    {{ $user->name }}
                                </div>
                                    </th>
                                    <td class="px-4 py-3">
                                        {{ $user->email }}
                                        {{ $user->email_verified_at ? '✅' : '' }}
                                    </td>
                                    <td class="px-4 py-3 {{ $user->roles->first()->name === 'admin' ? 'text-green-500' : '' }}">
                                        {{ $user->roles->first()->name }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $user->created_at->diffForHumans() }}    
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $user->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button 
                                            wire:click="showDeleteModal({{ $user }})"
                                            class="px-3 py-1 text-red-500"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                          </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select
                                wire:model.live="itemsPerPage"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            >
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $users->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
    </section>

    <x-confirmation-modal wire:model="deleteModal">
        <x-slot name="title">
            {{ __('Delete User Account') }}
        </x-slot>
    
        <x-slot name="content">
            {{ __('Are you sure you would like to delete') }} {{ $name }}?
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="closeDeleteModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
    
            <x-danger-button class="ms-3" wire:click="delete({{ $id }})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>