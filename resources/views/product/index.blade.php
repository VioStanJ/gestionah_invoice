@extends('layouts.admin')

@section('page-title')
    {{__('Unit')}}
@endsection

@section('title')
{{__('Unit')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('unit.create') }}" data-ajax-popup="true" data-title="{{__('Create New Unit')}}" class="btn btn-xs btn-white btn-icon-only width-auto">
                <i class="fas fa-plus"></i> {{__('Create')}}
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{ Form::open(array('route' => array('productservice'),'method' => 'GET','id'=>'product_service')) }}
                    <div class="row d-flex justify-content-end mt-2">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    {{ Form::label('category', __('Category'),['class'=>'text-type']) }}
                                    {{ Form::select('category', $categories,null, array('class' => 'form-control select2','required'=>'required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <a href="#" class="apply-btn" onclick="document.getElementById('product_service').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('apply')}}">
                                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                            </a>
                            <a href="{{route('productservice')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
                                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                            </a>

                        </div>
                    </div>
                    {{ Form::close() }}
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Sku')}}</th>
                                    <th>{{__('Sale Price')}}</th>
                                    <th>{{__('Purchase Price')}}</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Unit')}}</th>
                                    <th>{{__('Type')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $productService)
                                    <tr>
                                        <td  style="padding: 10px 5px 5px 5px!important;">
                                            <img src="{{asset($productService->image)}}" alt="{{ $productService->name}}" class="ti-imaj">
                                        </td>
                                        <td>{{ $productService->name}}</td>
                                        <td>{{ $productService->sku }}</td>
                                        <td>{{ $productService->ttc }}</td>
                                        <td>{{ $productService->price }}</td>
                                        <td style="color : {{!empty($productService->category)?$productService->category->color:''}}">{{ !empty($productService->category)?$productService->category->name:'' }}</td>
                                        <td>{{ !empty($productService->unit())?$productService->unit()->name:'' }}</td>
                                        <td>{{ $productService->is_service==1?__('Service'):__('Product') }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
