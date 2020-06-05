@if (isset($list_category_is_home) &&  !empty($list_category_is_home))
    @foreach ($list_category_is_home as $item)
        @if ($item['display'] == 'list')
            @include('news.pages.home.child_index.category_list')
        @elseif ($item['display'] == 'grid')
            @include('news.pages.home.child_index.category_grid')
        @endif
    @endforeach
@endif