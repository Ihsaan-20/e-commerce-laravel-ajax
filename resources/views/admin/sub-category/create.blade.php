@extends('admin.layouts.app')
@section('main')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Sub Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('sub-category.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
       <form action="" id="subCategoryForm" name="subCategoryForm">
        <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sub_cate_name">Name</label>
                            <input type="text" name="sub_cate_name" id="sub_cate_name" class="form-control" placeholder=" Sub Category ">	
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" readonly class="form-control" placeholder="Slug">
                            <p></p>	
                        </div>
                    </div>		
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category</option>
                                @if ($category->isNotEmpty())
                                    @foreach ($category as $key => $cate)
                                        <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="block">block</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Show</label>
                            <select class="form-select form-control" name="show" id="show">
                                <option  value="yes" >Yes</option>
                                <option  value="no" selected>No</option>
                            </select>
                        </div>
                    </div>
                   							
                </div>
            </div>							
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="#" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
</div>

<script src="{{asset('admin-asset/plugins/jquery/jquery.min.js')}}"></script>

<script>
    $('#subCategoryForm').submit(function(event){
        event.preventDefault();
        var element = $(this);

        $('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: '{{route('sub-category.store')}}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success:function(response){
                $('button[type=submit]').prop('disabled', false);

                if(response['status'] == true){

                    window.location.href='{{route('sub-category.index')}}';

                    $('#category_name').removeClass('is-invalid')
                            .siblings('p').removeClass('invalid-feedback').html('');
                    $('#slug').removeClass('is-invalid')
                        .siblings('p').removeClass('invalid-feedback').html('');
                }else{

                    if(response['notFound'] == true)
                    {
                        window.location.href='{{route('sub-category.index')}}';
                    }

                    var errors = response['errors'];
                    if (errors['sub_cate_name'])
                        {
                            $('#sub_cate_name').addClass('is-invalid')
                            .siblings('p').addClass('invalid-feedback')
                            .html(errors['sub_cate_name']);
                        } else {
                            $('#sub_cate_name').removeClass('is-invalid')
                            .siblings('p').removeClass('invalid-feedback').html('');
                        }

                    if (errors['slug']) {
                        $('#slug').addClass('is-invalid')
                        .siblings('p').addClass('invalid-feedback').html(errors['slug']);
                    } else {
                        $('#slug').removeClass('is-invalid')
                        .siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if (errors['category']) {
                        $('#category').addClass('is-invalid')
                        .siblings('p').addClass('invalid-feedback').html(errors['category']);
                    } else {
                        $('#category').removeClass('is-invalid')
                        .siblings('p').removeClass('invalid-feedback').html('');
                    }
                    
                }
                

            }, error: function(jqXHR, exception){
                console.log("Something went wrong");
            }
        });
       
    });//main document;

     // slug ajax;
     $('#sub_cate_name').change(function(){
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



