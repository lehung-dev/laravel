@php
use App\Helpers\Template as Template;
@endphp

<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
        <thead>
            <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">Slider info</th>
                <th class="column-title">Trạng thái</th>
                <th class="column-title">Tạo mới</th>
                <th class="column-title">Chỉnh sửa</th>
                <th class="column-title">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @if (count($items) > 0)
            @foreach ($items as $key => $item)
            @php
            $id = $item['id'];
            $name = $item['name'];
            $description = $item['description'];
            $link = $item['link'];
            $thumb = Template::showItemThumb($controllerName, $item['thumb'], $item['name']);
            $created = Template::showItemHistory($item['created_by'], $item['created']);
            $modified = Template::showItemHistory($item['modified_by'], $item['modified']);
            $btn_status = Template::showItemStatus($controllerName, $id, $item['status']);
            $class_row = (($key + 1) % 2 == 0) ? 'even' : 'odd';
            $buttonAction = Template::showButtonAction($controllerName, $id, ['info']);
            @endphp
            <tr class="{{ $class_row }} pointer">
                <td class="">{{$key + 1}}</td>
                <td width="40%">
                    <p><strong>Name :</strong> {{ $name }}</p>
                    <p><strong>Description :</strong> {{ $description }}</p>
                    <p><strong>Link :</strong> {{ $link }}</p>
                    <p>{!! $thumb !!}</p>
                </td>
                <td>{!! $btn_status !!}</td>
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