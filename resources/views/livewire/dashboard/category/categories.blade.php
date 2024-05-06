<div>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-12">
        <div class="md:col-span-1 flex justify-between items-center p-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Categories
            </h3>
            <x-button 
                class="flex items-center gap-2"
                wire:click="showModal" 
                wire:loading.attr="disabled"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>      
                {{ __('Create Category') }}
            </x-button>
        </div>
    </div>
    <div class="overflow-hidden mb-12">
        @foreach ($categories as $category)
            <div 
                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                
            >
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $category->name }}
                </h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">
                    {{ $category->description }}
                </p>
            </div>
        @endforeach
    </div>
    <!-- Delete User Confirmation Modal -->
    <x-dialog-modal wire:model.live="isModalOpen">
        <x-slot name="title">
            {{ __('Create Category') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Please fill out the form below to create a new category. Your category should accurately reflect the content or purpose it represents, helping classify items effectively within your organisation.') }}

            <div class="mt-4">
                <x-label for="name" value="{{ __('Category') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="name" required autofocus/>
            </div>

            <div class="mt-4">
                <x-label for="description" value="{{ __('Description') }}" />
                <x-textarea id="description" class="block mt-1 w-full" type="text" wire:model="description" name="description" required />
            </div>

            <div class="mt-4">
                <x-label for="colour" value="{{ __('Colour') }}" />
                <x-input id="colour" class="block mt-1 w-full" type="color" name="colour" wire:model="colour" required autofocus/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('isModalOpen')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="createCategory" wire:loading.attr="disabled">
                {{ __('Create Category') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>



{{-- <div>
    <x-label for="email" value="{{ __('Email') }}" />
    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
</div>

<div class="mt-4">
    <x-label for="password" value="{{ __('Password') }}" />
    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
</div> --}}