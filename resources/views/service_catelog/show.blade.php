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
           Menu
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""> Menu</li>
            
        </ol>
    </section>

     <div class="col-md-12">
    <div class="col-md-6 row pull-right">

           

           
           
            <a href="{{ url('/admin/service_catelog/') }}" class="btn btn-primary pull-right btn-sm">Back to Menu </a>
           
        </div>
        </div>

  
        <div class="col-md-12">

        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                
                         
                    
                <tbody>
                    <tr>
                    <td>Name</td>
                        <td> {{ $service_catelog->name }}</td>
                        </tr>
                        <tr>
                        <td>Description</td>
                        <td>{{ $service_catelog->description }}</td>
                        </tr>
                        <tr>
                        <td>Parent</td>
                        <td>@if($service_catelog->parent_category) {{ $service_catelog->parent_category->name }} @endif </td>
                        </tr>
                </tbody>    
            </table>
        </div>

    </div>

    </div>
</div>
   
   </section>
@endsection