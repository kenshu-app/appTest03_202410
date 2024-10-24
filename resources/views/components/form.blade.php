@props(['book'])

@csrf

<section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
        <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <div class="flex flex-wrap -m-2">
                <div class="p-2 w-full">
                    <div class="relative">
                        <x-input-label for="title" class="leading-7 text-sm text-gray-600" :value="__('title')" />
                        <x-text-input type="text" id="title" name="title"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            :value="old('title', $book->title)" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                </div>
                <div class="p-2 w-1/2">
                    <div class="relative">
                        <x-input-label for="author" class="leading-7 text-sm text-gray-600" :value="__('author')" />
                        <x-text-input type="text" id="author" name="author"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            :value="old('author', $book->author)" />
                        <x-input-error :messages="$errors->get('author')" class="mt-2" />
                    </div>
                </div>
                <div class="p-2 w-1/2">
                    <div class="relative">
                        <x-input-label for="publisher"
                            class="leading-7 text-sm text-gray-600" :value="__('publisher')" />
                        <x-text-input type="text" id="publisher" name="publisher"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            :value="old('publisher', $book->publisher)" />
                        <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                    </div>
                </div>
                <div class="p-2 w-full">
                    <div class="relative">
                        <x-input-label for="review" class="leading-7 text-sm text-gray-600" :value="__('review')" />
                        <textarea id="review" name="review"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('review', $book->review)}}</textarea>
                        <x-input-error :messages="$errors->get('review')" class="mt-2" />
                    </div>
                </div>
                <div class="p-2 w-full">
                    <x-primary-button
                        class="w-full flex justify-center mx-auto text-white bg-indigo-500 border-0 py-4 px-8 focus:outline-none hover:bg-indigo-600 rounded md:text-xl">{{ (!isset($book->id) ? __('create') : __('edit')) }}</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</section>
