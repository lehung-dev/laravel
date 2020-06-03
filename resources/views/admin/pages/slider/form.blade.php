@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template as Template;

$formInputClass = 'form-control col-md-6 col-xs-12';
$formLabelClass = 'control-label col-md-3 col-sm-3 col-xs-12';

$statusValue = [
        ''          => '--Select Status--', 
        'active'    => config('pvt.template.status.active.name'), 
        'inactive'  => config('pvt.template.status.inactive.name')
];
$inputHidden =  FormTemplate::hidden('id', (!empty($item['id'])) ? $item['id'] : null);
$inputHidden .= FormTemplate::hidden('thumb_current', (!empty($item['thumb'])) ? $item['thumb'] : null);

$elements = [
    [
        'label'     => FormTemplate::label('name', 'Name', ['class' => $formLabelClass]),
        'element'   => FormTemplate::text('name', $item['name'] , ['class' => $formInputClass])
    ],
    [
        'label'     => FormTemplate::label('description', 'Description', ['class' => $formLabelClass]),
        'element'   => FormTemplate::text('description', $item['description'] , ['class' => $formInputClass])
    ],
    [
        'label'     => FormTemplate::label('status', 'Status', ['class' => $formLabelClass]),
        'element'   => FormTemplate::select('status', $statusValue, $item['status'], ['class' => $formInputClass])
    ],
    [
        'label'     => FormTemplate::label('link', 'Link', ['class' => $formLabelClass]),
        'element'   => FormTemplate::text('link', $item['link'] , ['class' => $formInputClass])
    ],
    [
        'label'     => FormTemplate::label('thumb', 'Thumb', ['class' => $formLabelClass]),
        'element'   => FormTemplate::file('thumb', ['class' => $formInputClass]),
        'thumb'     => (!empty($item['id'])) ? Template::showItemThumb($controllerName, $item['thumb'], $item['name']) : null,
        'type'      => 'thumb'   
    ],
    [
        'element'   => $inputHidden . FormTemplate::submit('Save', ['class' => 'btn btn-success']),
        'type'      => 'btn-submit'   
    ],
]

@endphp
@extends('admin.main')
@section('content')

@include('admin.templates.page_header', ['pageIndex' => false]);
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title', ['title' => 'Form'])
            <div class="x_content">
                @include('admin.templates.error')
                <form method="POST" action="{{ route($controllerName.'/save') }}" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal form-label-left" id="main-form">
                    @csrf
                    {!! FormTemplate::show($elements); !!}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection