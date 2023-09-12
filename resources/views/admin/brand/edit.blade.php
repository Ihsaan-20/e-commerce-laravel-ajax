@extends('admin.layouts.app')
@section('main')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Brand</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('brand.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
       <form action="" id="brandForm" name="brandForm">
        <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="brand_name">Name</label>
                            <input type="text" name="brand_name" id="brand_name" value="{{$brands->brand_name}}"  class="form-control" placeholder=" Brand ">	
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" readonly  value="{{$brands->slug}}" class="form-control" placeholder="Slug">
                            <p></p>	
                        </div>
                    </div>		
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option {{($brands->status == 'active' ? 'selected' : '')}} value="active">Active</option>
                                <option {{($brands->status == 'block' ? 'selected' : '')}} value="block">Block</option>
                            </select>
                        </div>
                    </div>
                   							
                </div>
            </div>							
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{route('brand.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
</div>

<script src="{{asset('admin-asset/plugins/jquery/jquery.min.js')}}"></script>

<script>
    $('#brandForm').submit(function(event){
        event.preventDefault();
        var element = $(this);

        $('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: '{{route("brand.update",$brands->id)}}',
            type: 'put',
            data: element.serializeArray(),
            dataType: 'json',
            success:function(response){
                $('button[type=submit]').prop('disabled', false);

                if(response['status'] == true){

                    window.location.href='{{route('brand.index')}}';

                    $('#brand_name').removeClass('is-invalid')
                            .siblings('p').removeClass('invalid-feedback').html('');
                    $('#slug').removeClass('is-invalid')
                        .siblings('p').removeClass('invalid-feedback').html('');
                }else{

                    if(response['notFound'] == true)
                    {
                        window.location.href='{{route('sub-category.index')}}';
                        return false;
                    }

                    var errors = response['errors'];
                    if (errors['brand_name'])
                        {
                            $('#brand_name').addClass('is-invalid')
                            .siblings('p').addClass('invalid-feedback')
                            .html(errors['brand_name']);
                        } else {
                            $('#brand_name').removeClass('is-invalid')
                            .siblings('p').removeClass('invalid-feedback').html('');
                        }

                    if (errors['slug']) {
                        $('#slug').addClass('is-invalid')
                        .siblings('p').addClass('invalid-feedback').html(errors['slug']);
                    } else {
                        $('#slug').removeClass('is-invalid')
                        .siblings('p').removeClass('invalid-feedback').html('');
                    }
                    
                }
                

            }, error: function(jqXHR, exception){
                console.log("Something went wrong");
            }
        });
       
    });//main document;

     // slug ajax;
     $('#brand_name').change(function(){
        element = $(this);
        $('button[type=submit]').prop('disabled', true);
            $.ajax({
            url: '{{route('getSlug')}}',
            type: 'get',
            data: { title:element.val() },
            dataType: 'json',
            success:function(response){
                console.log('success');
                $('button[type=submit]').prop('disabled', false);

                if(response['status'] == true){
                    $('#slug').val(response['slug']);
                }
            }
        });
    });


</script>
    

@endsection



