<div class="x_content">
    <div class="row">
        <div class="col-md-6">
            @php
            $numItemperPage = $items->perPage();
            $total = $items->total();
            $numpages = $items->lastPage();
            @endphp
            <span class="label label-info label-pagination">{{ $numItemperPage }} item per page</span>
            <span class="label label-danger label-pagination">{{ $total }} items</span>
            <span class="label label-success label-pagination">{{ $numpages }} pages</span>
        </div>
        <div class="col-md-6">
            {{-- {{ $items->links() }} Dạng mặc định của Laravel --}}
            {{ $items->links('admin.templates.pagination_zvn') }}
        </div>
    </div>
</div>