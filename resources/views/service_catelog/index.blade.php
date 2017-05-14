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
            <li class="">Menu</li>
        </ol>
    </section>

    <div class="col-md-12">
 @if(Session::has('flash_message'))
        <div class="alert alert-success well-sm">{{ Session::get('flash_message') }}<i class='fa fa-times fa-fw pull-right' onclick="$(this).parent('div').hide()"></i></div>
        @endif 

        <div class="col-md-6 row pull-right">            
            <a href="{{ url('admin/service_catelog/create') }}" class="btn btn-primary pull-right btn-sm">
                Add New Menu 
            </a>
            
        </div>
    </div>

  
    <div class="well-sm">
        <div class="clearfix"></div>
    </div>
    {{--
    <div class="well-sm">
       {{ Form::open(array('url' => 'admin/service_catelog_search', 'method'=>'GET', 'id'=>'search_form', 'class'=>'col-md-3 pull-right')) }}
       <div class="input-group">
         <input type="text" name="search" value="" class="form-control" placeholder="Search..." >
         <span class="input-group-addon" id="basic-addon2" onclick="$('#search_form').submit()"> <i class="fa fa-search"></i> Search</span>
       </div>       
       {{ Form::close() }}
       
    </div>
    --}}

    <div class="col-md-12">

        {{ Form::open(array('url' => 'admin/service_catelog/multiaction/', 'id'=>'table_form')) }}
        <input type="hidden" name="multi_action" id="multi_action" value="" />
        <div class="table">
            <table class="table table-bordered table-striped table-hover">
                @if(count($service_catelog) == 0)
                <tr>
                    <th><center> No Record Found </center></th>
                </tr>
                @else
                <thead>
                    <tr>                        
                        <th>S.No. </th>
                        <th>Name</th>
                        <th>Parent</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($service_catelog as $key=>$item)
                    
                    <tr>                        
                        <td>{{ ($service_catelog->currentPage()*$service_catelog->perPage())+($key+1)-$service_catelog->perPage() }}</td>
                        
                        <td><a href="{{ url('admin/service_catelog', $item->id) }}">{{ $item->name }}</a></td>
                        
                        <td>@if($item->parent_category) {{ $item->parent_category->name }} @endif</td>
                        
                        
                        
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
        
        
         
            </div>
            </div>
           
           @if($service_catelog->render() !='')

                <div class="col-md-6 custumPagination">
                    <div class="pagination pull-right "> {!! $service_catelog->render() !!}
                    </div>
                </div>

                @endif
                {{ Form::close() }}


            </div>


            <div class="clearfix">&nbsp;</div>
       
    </div>
</div>

<style>
    .custumPagination .pagination > li:first-child > a, .custumPagination .pagination > li:first-child > span {
        font-size: 22px;
        padding-top: 1px;
    }
    .custumPagination .pagination > li:last-child > a, .custumPagination .pagination > li:last-child > span {
        font-size: 22px;
    }
    .custumPagination .pagination {
        margin: 0;
    }
</style>



@endsection