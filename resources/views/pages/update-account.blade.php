<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" enctype="multipart/form-data" action="{{ route('update-account') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />

                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ? old('name') : Auth::user()->name" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email') ? old('email') : Auth::user()->email" required />
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-label for="phone_number" :value="__('Phone')" />

                        <x-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number" :value="old('phone_number') ? old('phone_number') : Auth::user()->phone_number" required />
                    </div>

                    <!-- Company Name -->
                    <div class="mt-4">
                        <x-label for="company_name" :value="__('Company')" />

                        <x-input id="company_name" class="block mt-1 w-full" type="tel" name="company_name" :value="old('company_name') ? old('company_name') : Auth::user()->company_name" required />
                    </div>

                    <!-- Division Name -->
                    <div class="mt-4">
                        <x-label for="division_name" :value="__('Divisi')" />

                        <x-input id="division_name" class="block mt-1 w-full" type="text" name="division_name" :value="old('division_name') ? old('division_name') : Auth::user()->division_name" required />
                    </div>

                    <!-- Profile Picture -->
                    <div class="mt-4">
                        <x-label for="profile_picture" :value="__('Profile Picture')" />

                        <x-input id="profile_picture" class="block mt-1 w-full" type="file" name="profile_picture" accept="image/png, image/gif, image/jpeg" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('account') }}">
                            {{ __('Cancel') }}
                        </a>

                        <x-button class="ml-4">
                            {{ __('Submit') }}
                        </x-button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
