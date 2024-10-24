<x-app-layout>
    <x-slot name="header">
        {{ __('like') . __('index') }}
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                @if (count($books) == 0)
                    <div class="flex items-center justify-center w-full absolute inset-0">
                        <h2 class="tracking-widest text-center w-full text-3xl title-font font-light text-gray-600 mb-1">
                            {{ __('nolike') }}
                        </h2>
                    </div>
                @else
                        <div class="w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 border-r border-gray-50 rounded-tl rounded-bl">{{ __('publisher') }}</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 border-r border-gray-50">{{ __('title') }}</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 border-r border-gray-50">{{ __('review') }}</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 border-r border-gray-50">{{ __('author') }}</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 text-center rounded-tr rounded-br">{{ __('delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border-t-2 border-gray-200 px-4 py-6 text-xs text-gray-600">{{ $book->publisher }}</td>
                                        <td class="border-t-2 border-gray-200 px-4 py-6 text-lg font-bold">{{ $book->title }}</td>
                                        <td class="border-t-2 border-gray-200 px-4 py-6 text-sm">{{ $book->review }}</td>
                                        <td class="border-t-2 border-gray-200 px-4 py-6 text-xs text-gray-600">{{ $book->author }}</td>
                                        <td class="border-t-2 border-gray-200">
                                            <form action="{{ route('likes.destroy') }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                <button
                                                    class="flex items-center text-white bg-indigo-500 border-0 py-2 px-4 mx-auto focus:outline-none hover:bg-indigo-600 rounded">{{ __('like') . __('delete') }}
                                                    <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
