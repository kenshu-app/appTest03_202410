<x-app-layout>
    <x-slot name="header">
        {{ __('book') . __('edit') }}
    </x-slot>

    <form action="{{ route('books.update', $book->id) }}" method="post">

        @method('put')

        <x-form :book="$book"></x-form>
    </form>

</x-app-layout>
