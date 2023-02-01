<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Document') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center mt-4">
                <a href="{{route('document-managements.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Add New
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="flex items-center" style="max-width: 600px;">
                        <div class="mr-2 ">
                            <x-input id="title" placeholder="Search by title" class="block mt-1 w-full" type="text" name="title" :value="request()->title" />
                        </div>
                        <div class="ml-2 ">
                            <x-button>
                                Search
                            </x-button>
                        </div>
                    </form>
                    <div class="overflow-x-auto relative mt-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6 sm:text-left">
                                        Title
                                    </th>
                                    <th scope="col" class="py-3 px-6 sm:text-left">
                                        Content
                                    </th>
                                    <th scope="col" class="py-3 px-6 sm:text-left">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($documents->count() > 0)
                                    @foreach ($documents as $document)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="py-4 px-6">
                                                {{$document->title}}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{$document->content}}
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center">
                                                    <div class="text-center mr-2">
                                                        <a class="underline" href="{{route('document-managements.show',$document->id)}}">Detail</a>
                                                    </div>
                                                    <div class="text-center ml-2">
                                                        <a class="underline" href="{{route('document-managements.edit',$document->id)}}">Edit</a>
                                                    </div>
                                                    <div class="text-center ml-2">
                                                        <form method="POST" action="{{route('document-managements.destroy',$document->id)}}">
                                                            @method('DELETE')
                                                            @csrf
                                
                                                            <a class="underline" href="{{route('document-managements.destroy',$document->id)}}" onclick="event.preventDefault();
                                                                this.closest('form').submit();">Delete</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="4" class="py-4 px-6 text-center">
                                        no data 
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="flex items-center mt-4">
                        {{$documents->appends(request()->all())->links()}}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>