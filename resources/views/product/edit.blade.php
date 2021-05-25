<div class="card bg-none card-box">
    {{ Form::model($product, array('route' => array('productservice.update', $product->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', __('Name'),['class'=>'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-address-card"></i></span>
                    {{ Form::text('name', null, array('class' => 'form-control','required'=>'required')) }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('sku', __('SKU'),['class'=>'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-key"></i></span>
                    {{ Form::text('sku', null, array('class' => 'form-control','required'=>'required')) }}
                </div>
            </div>
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description'),['class'=>'form-control-label']) }}
            {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']) !!}
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('ttc', __('Sale Price'),['class'=>'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-money-bill-alt"></i></span>
                    {{ Form::number('ttc', null, array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('price', __('Purchase Price'),['class'=>'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-money-bill-alt"></i></span>
                    {{ Form::number('price', null, array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
                </div>
            </div>
        </div>

        <div class="form-group  col-md-6">
            {{ Form::label('category_id', __('Category'),['class'=>'form-control-label']) }}
            {{ Form::select('category_id', $categories,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('unit_id', __('Unit'),['class'=>'form-control-label']) }}
            {{ Form::select('unit_id', $units,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="d-block form-control-label">{{__('Type')}}</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="customRadio5" name="type" value="product" @if($product->is_service==0) checked @endif onclick="hide_show(this)">
                            <label class="custom-control-label form-control-label" for="customRadio5">{{__('Product')}}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="customRadio6" name="type" value="service" @if($product->is_service==1) checked @endif   onclick="hide_show(this)">
                            <label class="custom-control-label form-control-label" for="customRadio6">{{__('Service')}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @if(!$customFields->isEmpty())
            <div class="col-md-6">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customFields.formBuilder')
                </div>
            </div>
        @endif --}}
        <div class="col-md-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
