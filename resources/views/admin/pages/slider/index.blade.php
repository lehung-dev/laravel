@php
use App\Helpers\Template as Template;
$xhtmlButtonStatus = Template::showButtonStatus($controllerName, $itemsStatusCount, $params['filter']['status']);
$xhtmlAreaSearch = Template::showAreaSearch($controllerName);
@endphp
@extends('admin.main')
@section('content')

<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>Danh sách User</h3>
    </div>
    <div class="zvn-add-new pull-right">
        <a href="/form" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Bộ lọc'])
            <div class="x_content">
                <div class="row">
                    <div class="col-md-6"> {!! $xhtmlButtonStatus !!} </div>
                    <div class="col-md-6"> {!! $xhtmlAreaSearch !!} </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--box-lists-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Danh sách'])
            <div class="x_content">
                @include('admin.pages.slider.list')
            </div>
        </div>
    </div>
</div>
<!--end-box-lists-->
@if (count($items) > 0)
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Phân trang'])
            @include('admin.templates.pagination')
        </div>
    </div>
</div>
@endif

@endsection