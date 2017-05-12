@extends('layouts.dashboard')
@extends('layouts.dashboardsidebar')

@section('content')


<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Service Catalogue 
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="">Service Manager</li>
            <li class=""> Services</li>
            <li class="active">Service Catalogue </li>
        </ol>
        @if(Session::has('edit_errors'))
            <div class="alert alert-danger well-sm">{{ Session::get('edit_errors') }}<i class='fa fa-times fa-fw pull-right' onclick="$(this).parent('div').hide()"></i></div>
            @endif
            
            
            
            
            
    </section>

    <div class="col-md-12">



        {!! Form::model($service_catelog, [
        'method' => 'PATCH',
        'url' => ['admin/service_catelog', $service_catelog->id],
        'class' => 'form-horizontal','enctype'=>'multipart/form-data'
        ]) !!}

        <div class="form-group  col-md-4 {{ $errors->has('name') ? 'has-error' : ''}}">
            <div class="col-md-12">{!! Form::label('name', 'Name: ') !!} <span style="color:#f00">*</span>

                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group  col-md-4 {{ $errors->has('description') ? 'has-error' : ''}}">
            <div class="col-md-12">  {!! Form::label('description', 'Description: ') !!} 

                {!! Form::text('description', null, ['class' => 'form-control']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group  col-md-4 {{ $errors->has('') ? 'has-error' : ''}}">
            {!! Form::label('root_category', 'Is root Category: ', ['class' => 'col-md-12   text-left']) !!}
            <div class="col-md-12">
                @if($service_catelog->parent_id)
                {{-- */ $rootcategory=2;  /* --}}
                @else
                {{-- */ $rootcategory=1;  /* --}}
                @endif
                {!! Form::select('root_category',$root_category, $rootcategory, ['class' => 'form-control']) !!}
                {!! $errors->first('', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group  col-md-4 {{ $errors->has('parent_id') ? 'has-error' : ''}}" id="parent_category"  @if(!empty($service_catelog->parent_id)) style="display: none;" @endif>
             {!! Form::label('parent_id', 'Select Parent Node', ['class' => 'col-md-12   text-left']) !!}
             <div class="col-md-12">
                <select name="parent_id" class="form-control" >
                    @foreach($servicecatalog_all as $item)
                    <option value="{{$item->id}}"@if($service_catelog->parent_id == $item->id) selected @endif>{{$item->name}}</option>
                    @endforeach
                </select>

                <!--{!!  Form::select('name',$service_catelog, array('class'=>'form-control')); !!}-->

                {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        
        
        <div class="form-group  col-md-4 {{ $errors->has('parent_id') ? 'has-error' : ''}}">
            {!! Form::label('color', 'Select Color', ['class' => 'col-md-12   text-left']) !!}
            <div class="col-md-12">
               
               <select name="color" class="form-control" >
                   
                   <option value="">Select Color</option>
                   <option value="Purple" @if($service_catelog->color == 'Purple') selected="selected" @endif>Purple</option>
                   <option value="Red" @if($service_catelog->color == 'Red') selected="selected" @endif>Red</option>
                   <option value="Orange" @if($service_catelog->color == 'Orange') selected="selected" @endif>Orange</option>
                   <option value="Yellow" @if($service_catelog->color == 'Yellow') selected="selected" @endif>Yellow</option>
                   <option value="Blue" @if($service_catelog->color == 'Blue') selected="selected" @endif>Blue</option>
                    
                </select>
                <!--{!!  Form::select('name',$service_catelog, array('class'=>'form-control')); !!}-->
                {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        

        
        
        
        
        
        <div class="form-group  col-md-4 {{ $errors->has('image') ? 'has-error' : ''}}">
            {!! Form::label('image', 'Image:', ['class' => 'col-md-12   text-left']) !!}
            <div class="col-md-12">

                <?php
                $a = $service_catelog->image;

                $break = str_replace('/service_catalog', '/service_catalog/thumbnail', $a)

//echo $break;
                ?>

                <?php if ($a) { ?><img src="<?php echo $break; ?>" /><?php } ?>
                {!!  Form::file('image',null, array('class'=>'form-control')); !!}

                {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        
        
        
        
        
        
        <div class="col-sm-12">
                   <br/>        <br/>
 <div class="col-sm-2"><b>Company :</b></div>


            <div class="col-sm-9 boxedLayout">
                @if(count($company) > 0)
                @foreach($company as $this_company)
                <div class="col-sm-4">
                <label>
                    @if(isset($service_ccpa_mapping_arr['company_mapping']))
                    @if(in_array($this_company->id , $service_ccpa_mapping_arr['company_mapping']))
                    {!! Form::checkbox('company_id[]', $this_company->id, true) !!}
                    @else
                    {!! Form::checkbox('company_id[]', $this_company->id) !!}
                    @endif
                    @else
                    {!! Form::checkbox('company_id[]', $this_company->id) !!}
                    @endif
                    {{ $this_company->company_name }}
                </label>
                </div>
                @endforeach
                @endif
                {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-sm-12">
        <br/>
       <div class="col-sm-2"><b>Project :</b></div>
  
            
           
           
            <div class="col-sm-9 boxedLayout">
                @if(count($projects) > 0)
                @foreach($projects as $this_project)
                 <div class="col-sm-4">
                <label>
                    @if(isset($service_ccpa_mapping_arr['project_mapping']))
                    @if(in_array($this_project->id , $service_ccpa_mapping_arr['project_mapping']))
                    {!! Form::checkbox('project_id[]', $this_project->id, true) !!}
                    @else
                    {!! Form::checkbox('project_id[]', $this_project->id) !!}
                    @endif
                    @else
                    {!! Form::checkbox('project_id[]', $this_project->id) !!}
                    @endif
                    {{ $this_project->project }}
                </label>
                </div>
                @endforeach
                @endif
                {!! $errors->first('project_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-sm-12">

                <br/>


       <div class="col-sm-2"><b>Customer Type :</b></div>


          <div class="col-sm-9 boxedLayout">
          
                @if(count($customer_type) > 0)
                @foreach($customer_type as $this_customer_type)
                         <div class="col-sm-4">
                <label>
                    @if(isset($service_ccpa_mapping_arr['customer_type_mapping']))
                    @if(in_array($this_customer_type->id , $service_ccpa_mapping_arr['customer_type_mapping']))
                    {!! Form::checkbox('customer_type_id[]', $this_customer_type->id, true) !!}
                    @else
                    {!! Form::checkbox('customer_type_id[]', $this_customer_type->id) !!}
                    @endif
                    @else
                    {!! Form::checkbox('customer_type_id[]', $this_customer_type->id) !!}
                    @endif
                    {{ $this_customer_type->type_name }}
                    </label>
                </div>
                @endforeach
                @endif
                {!! $errors->first('customer_type_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-sm-12">
        

        <br/>


       <div class="col-sm-2"><b>Asset Type :</b></div>


            <div class="col-sm-9 boxedLayout">
            
                @if(count($asset_type) > 0)
                @foreach($asset_type as $this_asset_type)
                 <div class="col-sm-4">
                <label>
                    @if(isset($service_ccpa_mapping_arr['asset_type_mapping']))
                    @if(in_array($this_asset_type->id , $service_ccpa_mapping_arr['asset_type_mapping']))
                    {!! Form::checkbox('asset_type_id[]', $this_asset_type->id, true) !!}
                    @else
                    {!! Form::checkbox('asset_type_id[]', $this_asset_type->id) !!}
                    @endif
                    @else
                    {!! Form::checkbox('asset_type_id[]', $this_asset_type->id) !!}
                    @endif
                    {{ $this_asset_type->asset_type }}
                </label>
                </div>
                @endforeach
                @endif
                {!! $errors->first('asset_type_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        
        
        
        
        
        
        
        
        
        


        <div class="col-md-12">
            <div class="col-sm-offset-3 col-sm-3" style="margin-left:0px;">

                <a href="{{ url('admin/service_catelog/status/pending') }}" class="btn btn-danger pull-center btn-sm">Cancel</a>

                {!! Form::submit('Update',  ['class' => 'btn btn-primary pull-left btn-sm']) !!}
            </div>
        </div>
        {!! Form::close() !!}

<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script type="text/javascript"> 
       $(document).ready(function() {      
         $(".form-horizontal").validate({             
        rules: {

          
            name: {
                required : true,
            }
            }
  
      }); }); 



    </script> 

        <script>
            $(document).ready(function () {
                $('#root_category').change(function () {
                    customer_types();
                });
            });

            $(window).load(function () {
                customer_types();
            })

            // chageScript

            function customer_types() {
                var selOptn = $('#root_category :selected').text();
                console.log(selOptn);
                if (selOptn == 'No') {
                    console.log("1");
                    $('#parent_category').show();

                } else {
                    console.log("2");
                    $('#parent_category').hide();

                }
            }
        </script>

        @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

    </div>
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2016-2017 Whimbl Software.</strong> All rights reserved.
</footer>

<!-- ./wrapper -->

<script>
    function get_filter($status) {
        window.location.href = "{{ url('tax/tax/status') }}/" + $status;
    }
</script>

@endsection