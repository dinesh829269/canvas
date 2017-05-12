

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

        <div class="col-md-6 row pull-right">
            <button class="btn btn-primary pull-right btn-sm" onclick="import_master('service_catalog')">Import</button>
            @if(count($service_catelog) > 0)
            <a href="{{ url('admin/export/service_catelog') }}" class="btn btn-success pull-right btn-sm">Export to Excel</a>
            @endif

            
            <a href="{{ url('admin/service_catelog/create') }}" class="btn btn-primary pull-right btn-sm">
                Add New Service Catalogue 
            </a>
            
        </div>
    </div>

  
    <div class="well-sm">
        <div class="clearfix"></div>
    </div>
    
    <div class="well-sm">
       {{ Form::open(array('url' => 'admin/service_catelog_search', 'method'=>'GET', 'id'=>'search_form', 'class'=>'col-md-3 pull-right')) }}
       <div class="input-group">
         <input type="text" name="search" value="" class="form-control" placeholder="Search..." >
         <span class="input-group-addon" id="basic-addon2" onclick="$('#search_form').submit()"> <i class="fa fa-search"></i> Search</span>
       </div>       
       {{ Form::close() }}
       
    </div>

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
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- */$x=0;/* --}}
                    @foreach($service_catelog as $item)
                    {{-- */$x++;/* --}}
                    <tr>                        
                        <td>{{ ($service_catelog->currentPage()*$service_catelog->perPage())+$x-$service_catelog->perPage() }}</td>
                        
                        <td><a href="{{ url('admin/service_catelog', $item->id) }}">{{ $item->name }}</a></td>
                        
                        <td>@if($item->parent_category) {{ $item->parent_category->name }} @endif</td>
                        
                        <?php
                        $a = $item->image;
                        $break = str_replace('/service_catalog', '/service_catalog/thumbnail', $a)
                        ?>
                        <td>   <?php if ($a) { ?><img src="<?php echo $break; ?>" style="
    height: 30px;" /><?php } ?></td>
                        
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


