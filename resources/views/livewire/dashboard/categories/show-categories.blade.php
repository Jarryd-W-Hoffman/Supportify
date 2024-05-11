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
                </div>
                <div class="overflow-x-auto">
                    <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4"
                            @foreach ($categories as $category)
                                <div
                                    wire:key="{{ $category->id }}"
                                    x-data="{ showActions: false }"
                                    x-on:mouseenter="showActions = true"
                                    x-on:mouseleave="showActions = false"
                                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                                    style="border-left: 5px solid {{ $category->colour }};"
                                >
                                    <div 
                                    class="flex items-center justify-between">
                                        <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ $category->name }}
                                        </h5>
                                        <div class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                            <div
                                                x-cloak
                                                class="relative flex flex-col justify-between"
                                            >
                                                <div 
                                                    x-show="showActions"
                                                    class="flex justify-end gap-4 pt-2">
                                                    <div wire:click="showEditModal({{ $category }})">
                                                        <svg 
                                                            fill="none" 
                                                            viewBox="0 0 24 24" 
                                                            stroke-width="1.5" 
                                                            stroke="currentColor" 
                                                            class="w-5 h-5 hover:text-blue-500"
                                                        >
                                                            <path 
                                                                stroke-linecap="round" 
                                                                stroke-linejoin="round" 
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" 
                                                            />
                                                        </svg>
                                                    </div>
                                                    <div wire:click="showDeleteModal({{ $category }})">
                                                        <svg 
                                                            fill="none" 
                                                            viewBox="0 0 24 24" 
                                                            stroke-width="1.5" 
                                                            stroke="currentColor" 
                                                            class="w-5 h-5 hover:text-red-500"
                                                        >
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <p 
                                                    x-show="!showActions"
                
                                                >
                                                    {{ $category->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="font-normal mt-4 text-gray-700 dark:text-gray-400">
                                        {{ $category->description }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
                    {{ $categories->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
    </section>

        <!-- Create Category Modal -->
        <x-dialog-modal wire:model.live="editModal">
            <x-slot name="title">
                {{ __('Edit Category') }}
            </x-slot>
    
            <x-slot name="content">
                {{ __('Please enter the text below to create a new category. Your category name should accurately reflect the content or purpose it represents, helping categorise tickets effectively within your organisation.') }}
    
                <div>
                    <div class="flex justify-between items-center">
                        <x-label for="name" value="{{ __('Name') }}" class="mt-4" />
                        <x-input-error for="name" class="mt-4" />
                    </div>
                    <x-input 
                        id="name" 
                        class="block mt-1 w-full {{ $errors->has('name') ? 'border-red-500' : '' }}" 
                        type="text" 
                        name="name" 
                        value="{{ $name }}"
                        wire:model="name" 
                        required 
                        autofocus 
                    />
                    <div class="flex justify-end text-sm mt-1 text-gray-500 dark:text-gray-400">
                        <span x-text="name.length"></span> / 32
                    </div>
                </div>
                <div>
                    <x-label for="description" value="{{ __('Description') }}" class="mt-4" />
                    <x-textarea 
                        id="description" 
                        class="block mt-1 w-full" 
                        name="description" 
                        value="{{ $description }}"
                        wire:model="description" 
                        required 
                        autofocus 
                    />
                </div>
                <div>
                    <x-label for="colour" value="{{ __('Colour') }}" class="mt-4" />
                    <x-input 
                        id="colour" 
                        class="block mt-1 w-full" 
                        type="color" 
                        name="colour" 
                        value="{{ $colour }}"
                        wire:model="colour" 
                        required 
                        autofocus 
                    />
                </div>
            </x-slot>
    
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('editModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
    
                <x-button class="ms-3" wire:click="updateCategory({{ $id }})" wire:loading.attr="disabled">
                    {{ __('Edit Category') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>

        <!-- Create Category Modal -->
        <x-dialog-modal wire:model.live="deleteModal">
            <x-slot name="title">
                {{ __('Delete Category') }}
            </x-slot>
    
            <x-slot name="content">
                <p>
                    Are you sure you want to delete the <span class="font-bold italic">{{ $name }}</span> category? All past statistics associated with this category will be lost. This action cannot be undone.
                </p>
            </x-slot>
    
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('deleteModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
    
                <x-danger-button class="ms-3" wire:click="deleteCategory({{ $id }})" wire:loading.attr="disabled">
                    {{ __('Delete Category') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
</div>