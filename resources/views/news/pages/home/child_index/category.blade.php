@if (isset($list_category_is_home) &&  !empty($list_category_is_home))
    @foreach ($list_category_is_home as $item)
        @php
            var_dump($item);
        @endphp
        @if ($item['display'] == 'list')
            @include('news.pages.home.child_index.category_list')
        @elseif ($item['display'] == 'grid')
            @include('news.pages.home.child_index.category_gird')
        @endif
    @endforeach
@endif