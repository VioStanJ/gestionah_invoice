@extends('layouts.admin')

@section('page-title')
    {{__('Category')}}
@endsection

@section('title')
{{__('Category')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="{{ route('category.create') }}" data-ajax-popup="true" data-title="{{__('Create New Category')}}" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fas fa-plus"></i> {{__('Create')}}
                </a>
            </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th> {{__('Category')}}</th>
                                <th> {{__('Type')}}</th>
                                <th> {{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="font-style">{{ $category->name }}</td>
                                    <td class="font-style">
                                        {{ __(\App\Models\category::$categoryType[$category->type]) }}
                                    </td>
                                    <td class="Action">
                                        <span>
                                            <a href="#" class="edit-icon" data-url="{{ route('category.edit',$category->id) }}" data-ajax-popup="true" data-title="{{__('Edit Product Category')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$category->id}}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $category->id],'id'=>'delete-form-'.$category->id]) !!}
                                                {!! Form::close() !!}
                                        </span>
                                    </td>
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
