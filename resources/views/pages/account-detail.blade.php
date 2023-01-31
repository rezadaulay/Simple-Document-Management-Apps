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
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />

                        <x-show-data>{{Auth::user()->name}}</x-show-data>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
                        
                        <x-show-data>{{Auth::user()->email}}</x-show-data>
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-label for="phone_number" :value="__('Phone')" />
                        
                        <x-show-data>{{Auth::user()->phone_number}}</x-show-data>
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-label for="company_name" :value="__('Company')" />
                        
                        <x-show-data>{{Auth::user()->company_name}}</x-show-data>
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-label for="division_name" :value="__('Divisi')" />
                        
                        <x-show-data>{{Auth::user()->division_name}}</x-show-data>
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-label for="profile_picture_url" :value="__('Profile Picture')" />
                        
                        <x-image :src="Auth::user()->profile_picture_url" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button-link href="{{ route('update-account-form') }}" class="ml-4">
                            {{ __('Edit') }}
                        </x-button-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
