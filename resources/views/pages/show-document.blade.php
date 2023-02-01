<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Document') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                <!-- Title -->
                <div>
                    <x-label for="title" :value="__('Title')" />

                    <x-show-data>{{$document->title}}</x-show-data>
                </div>

                <!-- Content -->
                <div class="mt-4">
                    <x-label for="content" :value="__('Content')" />

                    <x-show-data>{{$document->content}}</x-show-data>
                </div>

                <!-- Signing -->
                <div class="mt-4">
                    <x-label for="signing_type" :value="__('Signing')" />

                    <x-image :src="$document->signing_type == 'upload' ? $document->signing_image_url : $document->signing_manual" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('document-managements.index') }}">
                        {{ __('Back') }}
                    </a>
                    <x-button-link href="{{ route('document-managements.send-to-mail', $document->id) }}" class="ml-4">
                        {{ __('Send To Mail') }}
                    </x-button-link>
                    <x-button-link href="{{ route('document-managements.edit', $document->id) }}" class="ml-4">
                        {{ __('Edit') }}
                    </x-button-link>
                </div>
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
