<x-app-layout>
    <x-slot name="header">
        {{ __('book') . __('create') }}
    </x-slot>

    <form action="{{ route('books.store') }}" method="post">
        <x-form :book="$book"></x-form>
    </form>

</x-app-layout>
