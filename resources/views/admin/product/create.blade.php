@extends('admin.layouts.app')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('product.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <form action="" name="productForm" id="productForm">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">								
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title<span class="text-danger">*</span> </label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                            <p class="error"></p>	
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="slug">Slug<span class="text-danger">*</span></label>
                                            <input type="text" name="slug" id="slug" readonly class="form-control" placeholder="Slug">
                                            <p class="error"></p>	
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="short_description">Short Description<span class="text-danger">*</span></label>
                                            <textarea name="short_description" id="short_description" cols="30" rows="10" class="summernote" placeholder="Short Description"></textarea>
                                            <p class="error"></p>
                                        </div>
                                    </div>  
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description<span class="text-danger">*</span></label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                            <p class="error"></p>
                                        </div>
                                    </div>   
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="shipping_return">Shipping & Return<span class="text-danger">*</span></label>
                                            <textarea name="shipping_return" id="shipping_return" cols="30" rows="10" class="summernote" placeholder="Shipping & Return"></textarea>
                                            <p class="error"></p>
                                        </div>
                                    </div>                                            
                                </div>
                            </div>	                                                                      
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Media</h2>								
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">    
                                        <br>Drop files here or click to upload.<br><br>                                            
                                    </div>
                                </div>
                            </div>	                                                                      
                        </div>
                        <div class="row" id="product-gallary"></div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>								
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Price<span class="text-danger">*</span></label>
                                            <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                            <p class="error"></p>	
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="compare_price">Compare at Price</label>
                                            <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                            <p class="error"></p>
                                            <p class="text-muted mt-3">
                                                To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                            </p>	
                                        </div>
                                    </div>                                            
                                </div>
                            </div>	                                                                      
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>								
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sku">SKU (Stock Keeping Unit)<span class="text-danger">*</span></label>
                                            <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">	
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="barcode">Barcode</label>
                                            <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                                        </div>
                                    </div>   
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="hidden" name="track_qty" value="no">
                                                <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" value="yes" checked>
                                                <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">
                                            <span id="error-msg" style="color:red"></span>
                                            <p class="error"></p>	
                                        </div>
                                    </div>                                         
                                </div>
                            </div>	                                                                      
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">	
                                <h2 class="h4 mb-3">Product status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="block">Block</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="card">
                            <div class="card-body">	
                                <h2 class="h4  mb-3">Product category</h2>
                                <div class="mb-3">
                                    <label for="category">Category<span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select category</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="sub_category">Sub category</label>
                                    <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="">Select sub category</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="card mb-3">
                            <div class="card-body">	
                                <h2 class="h4 mb-3">Product brand</h2>
                                <div class="mb-3">
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Select brand</option>
                                        @if ($brands->isNotEmpty())
                                            @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="card mb-3">
                            <div class="card-body">	
                                <h2 class="h4 mb-3">Featured product<span class="text-danger">*</span></h2>
                                <div class="mb-3">
                                    <select name="is_featured" id="is_featured" class="form-control">
                                        <option value="">Select featured status</option>
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>                                                
                                    </select>
                                    <p class="error"></p>
                                </div>
                            </div>
                        </div>                                 
                    </div>
                </div>
                
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="products.html" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>


<!-- /.content-wrapper -->
<script src="{{asset('admin-asset/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin-asset/plugins/dropzone/min/dropzone.min.js')}}"></script>


<script>
    $(document).ready(function() {
            $('#qty').on('input', function() {
                // Get the input value
                var inputValue = $(this).val();

                // Check if the value is less than 0
                if (parseInt(inputValue) < 0) {
                    // Display an error message
                    $('#error-msg').text("Value must be 0 or greater");
                    // Clear the input field
                    $(this).val('');
                } else {
                    // Clear the error message
                    $('#error-msg').text('');
                }
            });
        });
    // form data with ajax
    $('#productForm').submit(function(event){
        event.preventDefault();
        var formArray = $(this).serializeArray();

        $.ajax({
            url: '{{route("product.store")}}',
            type: 'post',
            data: formArray,
            dataType: 'json',
            success:function(response){
                // console.log(response);
                if(response['status'] == true)
                {
                    $('.error').removeClass('invalid-feedback').html('');
                    $('input[type="text"], input[type="number"], select').removeClass('is-invalid');

                    window.location.href = '{{route('product.index')}}';
                }
                else
                {
                    var errors = response['errors'];
                    // if(errors['title']){
                    //     $('#title').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['title']);
                    // }
                    // else{
                    //     $('#title').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    // }

                    //<p> tag class to remove message;
                    $('.error').removeClass('invalid-feedback').html('');
                    $('input[type="text"], input[type="number"], select').removeClass('is-invalid');
                    $.each(errors, function(key, value){
                        $(`#${key}`).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);
                    });

                    
                }//main if end here
            },
            error: function(){
                console.log('something went wrong!');
            }
        })

    });

    // add slug with ajax;
    $('#title').change(function(){
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

    // add subcategory with ajax
    $('#category').change(function(){
        var category_id = $(this).val();
        $('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: '{{ route('product-sub-category.index')}}',
            type: 'get',
            data: {category_id:category_id},
            dataType: 'json',
            success: function(response){
                $('button[type=submit]').prop('disabled', false);

                // console.log(response);
                // $('#sub_category').find('option').not(':first').remove();
                // $.each(response['subCategories'], function(key,item){
                //     $('#sub_category').append(`<option ='${item.id}'>${item.sub_cate_name}</option>`);
                // });
                $('#sub_category').find('option').not(':first').remove();
                $.each(response['subCategories'], function(key, item) {
                    $('#sub_category').append(`<option value="${item.id}">${item.sub_cate_name}</option>`);
                });

            },
            error: function(){
                console.log('something went wrong!');
            }
        })
    });

    // DropZone
    Dropzone.autoDiscover = false;    
    const dropzone = $("#image").dropzone({ 
        url:  "{{ route('temp-images.create') }}",
        maxFiles: 10,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, success: function(file, response){
            // $("#image_id").val(response.image_id);
            // console.log(response)

            var html = `
                        <div class="col-md-3" id="image-row-${response.image_id}">
                            <div class="card p-1">
                                <input type="hidden" name="image_array[]" value="${response.image_id}">
                                <img class="card-img-top" src="${response.image_path}" alt="product-image">
                                <div class="card-body">
                                    <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
            `;
            $('#product-gallary').append(html);
        },
        complete: function (file) {
            this.removeFile(file);
        }
    });
// Remove image row 
function deleteImage(id){
    $('#image-row-'+id).remove();
}
</script>

@endsection