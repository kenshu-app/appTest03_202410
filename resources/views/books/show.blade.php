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
                        タブパネル2の内容</div>
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
