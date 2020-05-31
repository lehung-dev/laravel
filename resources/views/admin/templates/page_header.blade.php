@php
    $titlePage = 'Quản lý '. ucfirst($controllerName);

    $buttonActionPage = sprintf(' <a href="%s" class="btn btn-success"><i class="fa fa-reply"></i> Quay về</a>', route($controllerName));
    if($pageIndex == true)
    {
        $buttonActionPage = sprintf(' <a href="%s" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>', route($controllerName.'/form'));
    }

@endphp
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>{{ $titlePage }}</h3>
    </div>
    <div class="zvn-add-new pull-right"> {!! $buttonActionPage !!}</div>
</div>