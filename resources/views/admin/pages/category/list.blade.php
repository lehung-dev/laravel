@php
use App\Helpers\Template as Template;
use App\Helpers\Highlight as Highlight;
@endphp

<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
        <thead>
            <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">Name</th>
                <th class="column-title">Trạng thái</th>
                <th class="column-title">Danh sách bài viết</th>
                <th class="column-title">Kiểu hiển thị</th>
                <th class="column-title">Tạo mới</th>
                <th class="column-title">Chỉnh sửa</th>
                <th class="column-title">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @if (count($items) > 0)
            @foreach ($items as $key => $item)
            @php
                $id                 = $item['id'];
                $name               = Highlight::show($item['name'], $params['search'], 'name');
                $created            = Template::showItemHistory($item['created_by'], $item['created']);
                $modified           = Template::showItemHistory($item['modified_by'], $item['modified']);
                $btn_status         = Template::showItemStatus($controllerName, $id, $item['status']);
                $btn_ishome         = Template::showItemIsHome($controllerName, $id, $item['is_home']);
                $display            = Template::showItemSelect($controllerName, $id, $item['display']);
                $class_row          = (($key + 1) % 2 == 0) ? 'even' : 'odd';
                $buttonAction       = Template::showButtonAction($controllerName, $id, ['info']);
            @endphp
            <tr class="{{ $class_row }} pointer">
                <td class="">{{$id}}</td>
                <td width="40%">
                    {!! $name !!}
                </td>
                <td>{!! $btn_status !!}</td>
                <td>{!! $btn_ishome !!}</td>
                <td>{!! $display !!}</td>
                <td>{!! $created !!}</td>
                <td>{!! $modified !!}</td>
                <td class="last">{!! $buttonAction !!}</td>
            </tr>
            @endforeach
            @else
            @include('admin.templates.list_empty', ['col' => '6'])
            @endif
        </tbody>
    </table>
</div>