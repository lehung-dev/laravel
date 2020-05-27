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
            @foreach ($items as $item)
            <tr class="even pointer">
                <td class="">1</td>
                <td width="10%">admin</td>
                <td><a href="/change-status-active/1" type="button" class="btn btn-round btn-success">Active</a></td>
                <td>
                    <p><i class="fa fa-user"></i> admin</p>
                    <p><i class="fa fa-clock-o"></i> 10/12/2014</p>
                </td>
                <td>
                    <p><i class="fa fa-user"></i> hailan</p>
                    <p><i class="fa fa-clock-o"></i> 10/12/2014</p>
                </td>
                <td class="last">
                    <div class="zvn-box-btn-filter"><a href="/form/1" type="button" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                            <i class="fa fa-pencil"></i>
                        </a><a href="/delete/1" type="button" class="btn btn-icon btn-danger btn-delete" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
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