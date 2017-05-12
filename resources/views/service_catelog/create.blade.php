

<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create New Service Catalogue 
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="">Service Manager</li>
            <li class=""> Services</li>
            <li class="active">Services Catalogue</li>
        </ol>
        
         @if(Session::has('add_errors'))
            <div class="alert alert-danger well-sm">{{ Session::get('add_errors') }}<i class='fa fa-times fa-fw pull-right' onclick="$(this).parent('div').hide()"></i></div>
         @endif
    </section>

    <div class="col-md-12">


        {!! Form::open(['url' => 'service_catelog', 'class' => 'form-horizontal','enctype'=>'multipart/form-data']) !!}

        <div class="form-group  col-md-4 {{ $errors->has('name') ? 'has-error' : ''}}">
            <div class="col-md-12"> {!! Form::label('name', 'Name: ') !!} <span style="color:#f00">*</span>

                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required','maxlength'=>'30']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        
        
        
        
        <div class="form-group  col-md-4 {{ $errors->has('description') ? 'has-error' : ''}}">
            <div class="col-md-12"> {!! Form::label('description', 'Description: ') !!}  

                {!! Form::text('description', null, ['class' => 'form-control']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group  col-md-4 {{ $errors->has('') ? 'has-error' : ''}}">
            {!! Form::label('root_category', 'Is root Category: ', ['class' => 'col-md-12   text-left']) !!}
            <div class="col-md-12">
                {!! Form::select('root_category',$root_category, null, ['class' => 'form-control']) !!}
                {!! $errors->first('', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="form-group  col-md-4 {{ $errors->has('parent_id') ? 'has-error' : ''}}" id="parent_category"  style="display: none;">
            {!! Form::label('parent_id', 'Select Parent Node', ['class' => 'col-md-12   text-left']) !!}
            <div class="col-md-12">
                <select name="parent_id" class="form-control" >
                    @foreach($service_catelog as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                <!--{!!  Form::select('name',$service_catelog, array('class'=>'form-control')); !!}-->
                {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        
        <div class="form-group  col-md-4 {{ $errors->has('image') ? 'has-error' : ''}}">
            {!! Form::label('image', 'Image:', ['class' => 'col-md-12   text-left','id'=>'image']) !!}
            <div class="col-md-12">
                {!!  Form::file('image',null, array('class'=>'form-control')); !!}
                {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        
       
       
        
        <div class="col-md-12">
            <div class="col-sm-3" style="margin-left:0px;">
                <a href="{{ url('admin/service_catelog/status/pending') }}" class="btn btn-danger pull-center btn-sm">Cancel</a>
                {!! Form::submit('Create', ['class' => 'btn btn-primary pull-left btn-sm']) !!}
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
            image: {
               // required : true,
              //extension: "png|jpg"
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

        <script>


            $('#root_category').change(function () {
                var selOptn = $('#root_category :selected').text();
                console.log(selOptn);
                if (selOptn == 'No') {
                    console.log("1");
                    $('#parent_category').show();

                } else {
                    console.log("2");
                    $('#parent_category').hide();

                }
            });

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

