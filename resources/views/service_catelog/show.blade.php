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
    <div class="col-md-6 row pull-right">

           

           
           
            <a href="{{ url('/admin/service_catelog/status/pending') }}" class="btn btn-primary pull-right btn-sm">Back to Service Catalogue </a>
           
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
                        <tr>
                          <td>Image</td>
                          <?php
                $a = $service_catelog->image;

                $break = str_replace('/service_catalog', '/service_catalog/thumbnail', $a)

//echo $break;
                ?>
                        <td>   <?php if ($a) { ?><img src="<?php echo $break; ?>" style="
    height: 30px;" /><?php } ?></td>
                        
                        </tr>
                        <tr>
                        <td>Color</td>
                        <td> {{ $service_catelog->color }} </td>
                        </tr>
                        
                </tbody>    
            </table>
        </div>

    </div>

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