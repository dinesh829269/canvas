@extends('canvas::backend.layout')

@section('title')
    <title>{{ \Canvas\Models\Settings::blogTitle() }} | Help</title>
@stop

@section('content')

<section id="main">
@include('canvas::backend.shared.partials.sidebar-navigation')
<section id="content">
            <div class="container">

<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New Menu 
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""> Create Menu</li>            
        </ol>
        
         @if(Session::has('add_errors'))
            <div class="alert alert-danger well-sm">{{ Session::get('add_errors') }}<i class='fa fa-times fa-fw pull-right' onclick="$(this).parent('div').hide()"></i></div>
         @endif
    </section>

    <div class="col-md-12">


        {!! Form::open(['url' => 'admin/service_catelog', 'class' => 'form-horizontal','enctype'=>'multipart/form-data']) !!}

        <div class="form-group  col-md-4 {{ $errors->has('name') ? 'has-error' : ''}}">
            <div class="col-md-12"> {!! Form::label('name', 'Name: ') !!} <span style="color:#f00">*</span>

                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required','maxlength'=>'30']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        
        <div class="clearfix"></div>
        
        
        <div class="form-group  col-md-4 {{ $errors->has('description') ? 'has-error' : ''}}">
            <div class="col-md-12"> {!! Form::label('description', 'Description: ') !!}  

                {!! Form::text('description', null, ['class' => 'form-control']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="form-group  col-md-4 {{ $errors->has('parent_id') ? 'has-error' : ''}}" id="parent_category" >
            {!! Form::label('parent_id', 'Select Parent Node', ['class' => 'col-md-12   text-left']) !!}
            <div class="col-md-12">
                <select name="parent_id" class="form-control" >
                    <option value="">No Parent </option>
                    @foreach($service_catelog as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                <!--{!!  Form::select('name',$service_catelog, array('class'=>'form-control')); !!}-->
                {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        
        <div class="clearfix"></div>
{{--
        <div class="form-group  col-md-4 {{ $errors->has('image') ? 'has-error' : ''}}">
            {!! Form::label('image', 'Image:', ['class' => 'col-md-12   text-left','id'=>'image']) !!}
            <div class="col-md-12">
                {!!  Form::file('image',null, array('class'=>'form-control')); !!}
                {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        --}}
        
       
       
        
        <div class="col-md-12">
            <div class="col-sm-3" style="margin-left:0px;">
                <button type="submit" value="Create" class="btn btn-primary btn-sm waves-effect"> Create</button>     
                <a href="{{ url('admin/service_catelog/') }}" class="btn btn-danger btn-sm">Cancel</a>
                           
            </div>
        </div>

        {!! Form::close() !!}
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript"> 
       $(document).ready(function() {      
         $(".form-horizontal").validate({             
        rules: {

             
            name: {
                required : true
            },
             }
  
        
      });

       }); 



    </script> 
        <style type="text/css">
            .error {
                color: red;
            }
        </style>

        
        @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

    </div>
</div>
</div>
</div>

@endsection