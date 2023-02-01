<x-app-layout>
    <x-slot name="headerscripts">
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js" defer></script>
        <script src="{{ asset('js/document-management.js') }}" defer></script>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Document') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" enctype="multipart/form-data" action="{{ route('document-managements.update', $document->id) }}">
                    @method('PATCH')
                    @csrf

                    <!-- Title -->
                    <div>
                        <x-label for="title" :value="__('Title')" />

                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title') ? old('title') : $document->title" required autofocus />
                    </div>

                    <!-- Content -->
                    <div class="mt-4">
                        <x-label for="content" :value="__('Content')" />

                        <x-textarea id="content" class="block mt-1 w-full" name="content" required>{{ old('content') ? old('content') : $document->content }}</x-textarea>
                    </div>

                    <!-- Signing -->
                    <div class="mt-4">
                        <x-label for="signing_type" :value="__('Signing')" />
                        <div class="flex items-center mt-4">
                            <input id="default-radio-1" onclick="chooseSigningType('upload')" type="radio" {{ old('signing_type') == 'upload' || $document->signing_type == 'upload' ? 'checked' : ''}} value="upload" name="signing_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Upload</label>
                        </div>
                        <div class="flex items-center mt-1">
                            <input id="default-radio-2" onclick="chooseSigningType('manual')" type="radio" {{ old('signing_type') == 'manual' || $document->signing_type == 'manual' ? 'checked' : ''}} value="manual" name="signing_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Manual</label>
                        </div>

                        <div class="mt-4" id="signing_image_wrapper" {{ old('signing_type') == 'upload' || $document->signing_type == 'upload' ? 'style=display:block;' : 'style=display:none;'}} >
                            <x-input id="signing_image" :required="old('signing_type') == 'upload' || $document->signing_type == 'upload' ? true : false" class="block mt-1 w-full" type="file" name="signing_image" accept="image/png, image/gif, image/jpeg" />
                        </div>

                        <div class="mt-4" id="signing_manual_wrapper" {{ old('signing_type') == 'manual' || $document->signing_type == 'manual' ? 'style=display:block;' : 'style=display:none;'}} >
                            <p>Silahkan tulis tanda tangan anda disini.</p>
                            <canvas id="signing_manual_pad" style="border: 1px solid #000;" class="signing_manual_pad" width=400 height=200></canvas>
                            <button style="border: 1px solid #000; border-radius: 5px; padding: 5px; margin-top: 5px;" type="button" onclick="clearSignature()">Bersihkan</button>
                        </div>
                        <textarea name="signing_manual" id="signing_manual" cols="30" rows="10" style="display: none;">{{ old('content') ? old('content') : $document->signing_manual }}</textarea>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('account') }}">
                            {{ __('Cancel') }}
                        </a> --}}

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
