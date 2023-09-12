@extends('admin.layouts.app')
@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('admin.category.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="createForm" name="createForm"  enctype="multipart/form-data">
                {{-- @csrf --}}
                <div class="card">
                    <div class="card-body">				
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name">
                                    <p></p>	
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Slug</label>
                                    <input type="text" name="slug" id="slug" readonly class="form-control" placeholder="Category Slug">
                                    <p></p>	
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label>
                                    <select class="form-select form-control" name="status" id="status">
                                        <option value="active">Active</option>
                                        <option value="block">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Show</label>
                                    <select class="form-select form-control" name="show" id="show">
                                        <option  value="yes" >Yes</option>
                                        <option  value="no" selected>No</option>
                                    </select>
                                </div>
                            </div>										
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="hidden" name="image_id" id="image_id" value="">
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">    
                                            <br>Drop files here or click to upload.<br><br>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>			
                    </div>							
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{route('admin.category.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
{{-- Ajax--}}
<!-- jQuery -->
<script src="{{asset('admin-asset/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin-asset/plugins/dropzone/min/dropzone.min.js')}}"></script>

<script>
    $('#createForm').submit(function(event){
        event.preventDefault();
        var element = $(this);

        $('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: '{{route('admin.category.store')}}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success:function(response){
                $('button[type=submit]').prop('disabled', false);

                if(response['status'] == true){

                    window.location.href='{{route('admin.category.index')}}';

                    $('#category_name').removeClass('is-invalid')
                            .siblings('p').removeClass('invalid-feedback').html('');
                    $('#slug').removeClass('is-invalid')
                        .siblings('p').removeClass('invalid-feedback').html('');
                }else{

                    if(response['notFound'] == true)
                    {
                        window.location.href='{{route('admin.category.index')}}';
                    }

                    var errors = response['errors'];
                    if (errors['category_name'])
                        {
                            $('#category_name').addClass('is-invalid')
                            .siblings('p').addClass('invalid-feedback')
                            .html(errors['category_name']);
                        } else {
                            $('#category_name').removeClass('is-invalid')
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
     $('#category_name').change(function(){
        element = $(this);
        $('button[type=submit]').prop('disabled', true);


            $.ajax({
            url: '{{route('getSlug')}}',
            type: 'get',
            data: { title:element.val() },
            dataType: 'json',
            success:function(response){ 
                $('button[type=submit]').prop('disabled', false);

                if(response['status'] == true){
                    $('#slug').val(response['slug']);
                }
            }
        });
    });

    // DropZone
    Dropzone.autoDiscover = false;    
    const dropzone = $("#image").dropzone({ 
        init: function() {
            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
        },
        url:  "{{ route('temp-images.create') }}",
        maxFiles: 1,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, success: function(file, response){
            $("#image_id").val(response.image_id);
            // console.log(response)
        }
    });
</script>

@endsection



