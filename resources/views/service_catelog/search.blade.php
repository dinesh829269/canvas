@extends('layouts.dashboard')
@extends('layouts.dashboardsidebar')

@section('content')


<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Service Catalogue 
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="">Service Manager</li>
            <li class=""> Services</li>
            <li class="active">Service Catalogue </li>
        </ol>
    </section>

    <div class="col-md-12">
        @if(Session::has('flash_message'))
           <div class="alert alert-success well-sm">{{ Session::get('flash_message') }}<i class='fa fa-times fa-fw pull-right' onclick="$(this).parent('div').hide()"></i></div>
        @endif
        <div>
           <button class="btn btn-danger pull-right" type="button" onclick="window.location.href='{{ url('admin/service_catelog/status/pending') }}'">Back</button>
        </div>        
    </div>

  
    <div class="well-sm">
        <div class="clearfix"></div>
    </div>
    
    <div class="well-sm">
       {{ Form::open(array('url' => 'admin/service_catelog_search', 'method'=>'GET', 'id'=>'search_form', 'class'=>'col-md-3 pull-right')) }}
       <div class="input-group">
         <input type="text" name="search" value="{{$search}}" class="form-control" placeholder="Search..." >
         <span class="input-group-addon" id="basic-addon2" onclick="$('#search_form').submit()"> <i class="fa fa-search"></i> Search</span>
       </div>       
       {{ Form::close() }}
       
    </div>

    <div class="col-md-12">

        
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
                        <th>Image</th> 
                        <th>status</th>
                         <th>Actions</th>
                    
                    </tr>
                </thead>
                <tbody>
                    {{-- */$x=0;/* --}}
                    @foreach($service_catelog as $key=>$item)
                    {{-- */$x++;/* --}}
                    <tr>                        
                        <td>{{ ($key+1) }}</td>
                        
                        <td><a href="{{ url('admin/service_catelog', $item->id) }}">{{ $item->name }}</a></td>
                        
                        <td>@if($item->parent_category) {{ $item->parent_category->name }} @endif</td>
                        
                        <?php
                        $a = $item->image;
                        $break = str_replace('/service_catalog', '/service_catalog/thumbnail', $a)
                        ?>
                        <td>   <?php if ($a) { ?><img src="<?php echo $break; ?>" style="
    height: 30px;" /><?php } ?></td>
                        
                        <td>
                            {{ ucfirst($item->is_approved) }}
                            @if($item->is_approved =="approved")
                            <small> / {{ ucfirst($item->status) }}</small>
                            @endif
                        </td>
                        @if($item->is_approved)  <td>
                   

                         @can('approve.service_catalog')

                @if($item->is_approved =="approved" || $item->is_approved =="disapproved")    
                <a href="{{ url('admin/service_catelog/' . $item->id . '/pending') }}" class="btn btn-danger btn-xs">
                   Move to Pending
                </a>
                @endif
                @if($item->is_approved =="pending" || $item->is_approved =="disapproved")
                  <a href="{{ url('admin/service_catelog/' . $item->id . '/approve') }}" class="btn btn-success btn-xs">
                         Approve Record
                  </a>

                @endif
                @if($item->is_approved =="pending" || $item->is_approved =="approved")    
                <a href="{{ url('admin/service_catelog/' . $item->id . '/disapprove') }}" class="btn btn-success btn-xs">
                      Disapprove Record
                </a>
                @endif  

                @endcan
                           
                           
                           
                           
                           
                            @can('approve.service_catalog')
                            @if($item->is_approved =="approved")
                            @if($item->status =="deactive" || empty($item->status))
                            <a href="{{ url('admin/service_catelog/' . $item->id . '/active') }}">
                                <button type="button" class="btn btn-success btn-xs">Activate</button>
                            </a>                             
                            @endif
                            @if($item->status =="active" || empty($item->status))
                            <a href="{{ url('admin/service_catelog/' . $item->id . '/deactive') }}">
                                <button type="button" class="btn btn-warning btn-xs">Deactivate</button>
                            </a> 
                            @endif
                            @endif
                            @endcan
                            @can('edit.service_catalog')
                            @if($item->is_approved =="pending")
                            <a href="{{ url('admin/service_catelog/' . $item->id . '/edit') }}">
                                <button type="button" class="btn btn-primary btn-xs">Edit</button>
                            </a> 
                            @endif
                            @endcan  


                        </td> @endif
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
        
        

            
            
            
         <div class="row">
                <div class="col-md-6">
                @if(count($service_catelog) > 0 && isset($status))
                @can('approve.service_catalog')

                @if(isset($status_2))
                @if($status_2 =="active" )                
                <button type="button" class="btn btn-primary btn-sm" >
                    Deactivate
                </button>                
                @endif 
                @if($status_2 =="deactive")                
                <button type="button" class="btn btn-primary btn-sm" onclick="make_multi_activate()">
                    Activate
                </button>                
                @endif 
                @endif

                @if($status =="approved" || $status =="disapproved")               
                <button type="button" class="btn btn-danger btn-sm" onclick="make_pending()">
                    Pending
                </button>                
                @endif
                @if($status =="pending" || $status =="disapproved")

                <button type="button" class="btn btn-success btn-sm" onclick="make_approve()">
                    Approve
                </button>

                @endif
                @if($status =="pending" || $status =="approved")                
                <button type="button" class="btn btn-warning btn-sm" onclick="make_disapprove()">
                    Disapprove
                </button>                
                @endif  

                @endcan
                @endif
                
                
                <br/>
                  <div>

                Total No of Records : {{ count($service_catelog) }}
               

            </div>
            </div>
           
          
                

            </div>


            <div class="clearfix">&nbsp;</div>
       
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            </div>
            <strong>Copyright &copy; 2016-2017 Whimbl Software.</strong> All rights reserved.
        </footer>
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



<script>
    function get_filter($status) {
        window.location.href = "{{ url('admin/service_catelog/status') }}/" + $status;
    }

    function get_filter_2($status) {
        window.location.href = "{{ url('admin/service_catelog/status/approved') }}/" + $status;
    }

    function make_pending()
    {
        $("#multi_action").val('pending');
        $("#table_form").submit();
    }

    function make_approve()
    {
        $("#multi_action").val('approve');
        $("#table_form").submit();
    }

    function make_disapprove()
    {
        $("#multi_action").val('disapprove');
        $("#table_form").submit();
    }

    function make_multi_activate()
    {
        $("#multi_action").val('active');
        $("#table_form").submit();
    }

    function make_multi_deactivate()
    {
        $("#multi_action").val('deactive');
        $("#table_form").submit();
    }

    function import_master($master) {
        // alert('succs');
        window.location.href = "{{ url('/admin/import') }}/" + $master;
    }

    function multi_check() {
        if ($(".checkbox_multi").is(':checked')) {
            // Code in the case checkbox is checked.
            $(".checkbox_single").prop("checked", true);
        } else {
            // Code in the case checkbox is NOT checked.
            $(".checkbox_single").prop("checked", false);
        }

    }
</script>

@endsection
