<x-app-layout>
    <x-slot name="header">
        {{ __('book') . __('show') }}
    </x-slot>

    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $book->publisher }}</h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{ $book->title }}</h1>
                    {{-- タブの切り替え --}}
                    <div class="flex mb-4 tab-list" aria-labelledby="tablist-label">
                        <a id="tab1" aria-controls="tab-panel1" aria-selected="true"
                            class="tab -active js-tab flex-grow border-b-2 border-gray-300 py-2 text-lg text-center px-1">{{ __('review') }}</a>
                        <a id="tab2" aria-controls="tab-panel2" aria-selected="false" tabindex="-1"
                            class="tab js-tab flex-grow border-b-2 border-gray-300 py-2 text-lg text-center px-1">{{ __('like') }}</a>
                        <a id="tab3" aria-controls="tab-panel3" aria-selected="false" tabindex="-1"
                            class="tab js-tab flex-grow border-b-2 border-gray-300 py-2 text-lg text-center px-1">{{ __('image') }}</a>
                    </div>
                    {{-- 切り替えパネル --}}
                    <div id="tab-panel1" class="tab-panel js-tab-panel -active" tabindex="0" aria-labelledby="tab1">
                        <p class="leading-relaxed mb-4">{!! nl2br(e($book->review)) !!}</p>
                        <div class="flex border-t border-gray-200 py-2">
                            <span class="text-gray-500">{{ __('add-name') }}</span>
                            <span class="ml-auto text-gray-900">{{ $book->user->name }}</span>
                        </div>
                        <div class="flex border-t border-gray-200 py-2">
                            <span class="text-gray-500">{{ __('add-id') }}</span>
                            <span class="ml-auto text-gray-900">{{ $book->id }}</span>
                        </div>
                        <div class="flex border-t border-b mb-6 border-gray-200 py-2">
                            <span class="text-gray-500">{{ __('add-created') }}</span>
                            <span
                                class="ml-auto text-gray-900">{{ (new DateTime($book->created_at))->format('Y年m月d日') }}</span>
                        </div>
                    </div>
                    <div id="tab-panel2" class="tab-panel js-tab-panel h-auto" tabindex="0" aria-labelledby="tab2">
                        {{-- 書籍の登録IDとログインIDが同じ(自身が登録した書籍) --}}
                        @if ($book->user_id == Auth::id())
                            <div class="p-4 w-full">
                                <div
                                    class="h-full px-6 pt-12 pb-2 rounded-lg border-2 border-gray-400 flex flex-col relative overflow-hidden">
                                    <span
                                        class="bg-gray-400 text-white px-3 py-3 tracking-widest text-xs absolute right-0 top-0 rounded-bl">{{ __('like') }}</span>
                                    <h1
                                        class="text-2xl text-gray-600 font-light flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span>{{ __('mylike') }}</span>
                                    </h1>
                                </div>
                            </div>
                            {{-- 書籍の登録IDとログインIDが異なる(他者が登録した書籍) --}}
                        @else
                            <div class="p-4 w-full">
                                <div
                                    class="h-full p-6 rounded-lg border-2 border-indigo-500 flex flex-col relative overflow-hidden">
                                    <span
                                        class="bg-indigo-500 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl">{{ __('like') }}</span>
                                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium">
                                        {{ $book->publisher }}</h2>
                                    <h1
                                        class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                                        <span>{{ $book->title }}</span>
                                        <span class="text-lg ml-2 font-normal text-gray-500">{{ $book->author }}</span>
                                    </h1>
                                    <p class="flex items-center text-gray-600 mb-2">
                                        <span
                                            class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3"
                                                viewBox="0 0 24 24">
                                                <path d="M20 6L9 17l-5-5"></path>
                                            </svg>
                                        </span>{{ __('addlike') }}
                                    </p>
                                    {{-- お気に入りが追加済みかを確認(trueは登録済みであれば) --}}
                                    @if (Auth::user()->isLike($book->id))
                                        <form action="{{ route('likes.destroy') }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                            <button
                                                class="flex items-center mt-3 text-white bg-indigo-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-indigo-600 rounded">{{ __('like') . __('delete') }}
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                        {{-- 登録済みでなければ追加ボタンを表示 --}}
                                    @else
                                        <form action="{{ route('likes.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                            <button
                                                class="flex items-center mt-auto text-white bg-indigo-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-indigo-600 rounded">{{ __('like') . __('create') }}
                                                <svg fill="white" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    <p class="text-xs text-gray-500 mt-3">{{ __('navlike') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="tab-panel3" class="tab-panel js-tab-panel h-auto" tabindex="0" aria-labelledby="tab3">
                        タブパネル3の内容</div>
                    <div class="flex">
                        <a href="{{ route('books.index') }}"
                            class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 12H5M12 19l-7-7 7-7" />
                            </svg>{{ __('book') . __('index') . __('back') }}
                        </a>
                        <a href="{{ route('books.edit', $book->id) }}"
                            class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">{{ __('edit') }}</a>
                        <a href="" onclick="deleteBook()"
                            class="flex ml-2 text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">{{ __('delete') }}</a>
                        <form action="{{ route('books.destroy', $book) }}" method="post" id="delete-form">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </div>
                <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                    src="https://dummyimage.com/400x400">
            </div>
        </div>
    </section>
</x-app-layout>

<script>
    // 削除確認用のダイアログ表示
    const deleteBook = () => {
        event.preventDefault()
        confirm('本当に削除しますか？') ? document.querySelector('#delete-form').submit() : ''
    }

    // タブの切り替え処理
    const tabs = document.querySelectorAll('.js-tab')

    function tabSwitch() {
        let tabsArray = Array.prototype.slice.call(tabs);
        let index = tabsArray.indexOf(this);
        const resetTab = function() {
            document.querySelector('.js-tab.-active').classList.remove('-active');
            document.querySelector('.js-tab[aria-selected=true]').removeAttribute('aria-selected');
            document.querySelectorAll('.js-tab').forEach((elm) => {
                elm.tabIndex = -1;
            });
            document.querySelector('.js-tab-panel.-active').classList.remove('-active');
        }
        const setTab = function(tab, tabpanel) {
            tab.classList.add('-active');
            tab.tabIndex = 0;
            tab.setAttribute('aria-selected', true);
            tabpanel.classList.add('-active');
        }
        if (event.type == 'keyup') {
            if (event.key === 'ArrowRight') {
                if (tabsArray[index + 1]) {
                    tabsArray[index + 1].focus();
                    resetTab();
                    setTab(tabsArray[index + 1], document.querySelectorAll('.js-tab-panel')[index + 1]);
                } else {
                    tabsArray[0].focus();
                    resetTab();
                    setTab(tabsArray[0], document.querySelectorAll('.js-tab-panel')[0]);
                };
            };
            if (event.key === 'ArrowLeft') {
                if (tabsArray[index - 1]) {
                    tabsArray[index - 1].focus();
                    resetTab();
                    setTab(tabsArray[index - 1], document.querySelectorAll('.js-tab-panel')[index - 1])
                } else {
                    let lastTab = tabsArray.pop();
                    lastTab.focus();
                    resetTab();
                    setTab(lastTab, Array.prototype.slice.call(document.querySelectorAll('.js-tab-panel')).pop());
                };
            };
        }
        if (event.type == 'click') {
            resetTab();
            setTab(this, document.querySelectorAll('.js-tab-panel')[index]);
        }
    };

    tabs.forEach((tab) => {
        tab.addEventListener('click', tabSwitch);
        tab.addEventListener('keyup', tabSwitch);
    });
</script>

<style>
    .tab {
        cursor: pointer;
        flex: 1;
    }

    .tab.-active {
        color: white;
        background-color: rgb(99 102 241);
    }

    .tab-panel {
        display: none;
    }

    .tab-panel.-active {
        display: block;
    }
</style>
