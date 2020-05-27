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
            $name = $item['name'];
            $description = $item['description'];
            $link = $item['link'];
            $thumb = asset('admin/img/'.$item->thumb);
            $created = Template::showItemHistory($item['created_by'], $item['created']);
            $modified = Template::showItemHistory($item['modified_by'], $item['modified']);
            @endphp
            <tr class="even pointer">
                <td class="">{{$key + 1}}</td>
                <td width="40%">
                    <p><strong>Name :</strong> {{ $name }}</p>
                    <p><strong>Description :</strong> {{ $description }}</p>
                    <p><strong>Link :</strong> {{ $link }}</p>
                    <p>
                        <img src="{{ $thumb }}" alt="{{ $name }}" width="500">
                    </p>
                </td>
                <td><a href="/change-status-active/1" type="button" class="btn btn-round btn-success">Active</a></td>
                <td>{!! $created !!}</td>
                <td>{!! $modified !!}</td>
                <td class="last">
                    <div class="zvn-box-btn-filter"><a href="/form/1" type="button" class="btn btn-icon btn-success"
                            data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                            <i class="fa fa-pencil"></i>
                        </a><a href="/delete/1" type="button" class="btn btn-icon btn-danger btn-delete"
                            data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            @include('admin.templates.list_empty', ['col' => '6'])
            @endif
        </tbody>
    </table>
</div>