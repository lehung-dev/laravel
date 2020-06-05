@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template as Template;

$formInputAttr = 'form-control col-md-6 col-xs-12';
$formLabelAttr = 'control-label col-md-3 col-sm-3 col-xs-12';

$statusValue = [
        ''          => '--Select Status--', 
        'active'    => config('pvt.template.status.active.name'), 
        'inactive'  => config('pvt.template.status.inactive.name')
];
$inputHidden =  FormTemplate::hidden('id', (!empty($item['id'])) ? $item['id'] : null);

$elements = [
    [
        'label'     => FormTemplate::label('name', 'Name', ['class' => $formLabelAttr]),
        'element'   => FormTemplate::text('name', $item['name'] , ['class' => $formInputAttr])
    ],
   
    [
        'label'     => FormTemplate::label('status', 'Status', ['class' => $formLabelAttr]),
        'element'   => FormTemplate::select('status', $statusValue, $item['status'], ['class' => $formInputAttr])
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