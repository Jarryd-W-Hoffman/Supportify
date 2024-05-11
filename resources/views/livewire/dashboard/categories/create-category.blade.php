<section>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create Category') }}
            </h3>
        </div>
        <x-button wire:click="showCreateModal" wire:loading.attr="disabled">
            {{ __('Create Category') }}
        </x-button>
    </div>

    <!-- Create Category Modal -->
    <x-dialog-modal wire:model.live="createModal">
        <x-slot name="title">
            {{ __('Create Category') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Please enter the text below to create a new category. Your category name should accurately reflect the content or purpose it represents, helping categorise tickets effectively within your organisation.') }}

            <div>
                <x-label for="name" value="{{ __('Name') }}" class="mt-4" />
                <x-input 
                    id="name" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="name" 
                    wire:model="name" 
                    required 
                    autofocus 
                />
            </div>
            <div>
                <x-label for="description" value="{{ __('Description') }}" class="mt-4" />
                <x-textarea 
                    id="description" 
                    class="block mt-1 w-full" 
                    name="description" 
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
                    wire:model="randomColor" 
                    :value="$randomColor"
                    required 
                    autofocus 
                />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeCreateModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('Create Category') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</section>
    