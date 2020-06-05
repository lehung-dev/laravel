@php
use App\Helpers\Template as Template;
    $xhtmlButtonStatus  = Template::showButtonStatus($controllerName, $itemsStatusCount, $params['filter']['status'],$params['search']);
    $xhtmlAreaSearch    = Template::showAreaSearch($controllerName , $params['search']);
@endphp
@extends('admin.main')
@section('content')
@include('admin.templates.page_header', ['pageIndex' => true]);

@if (session('notify'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {!! session('notify') !!}
    </div>      
@endif
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
                @include('admin.pages.category.list')
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