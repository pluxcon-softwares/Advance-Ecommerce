@extends('admin.layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 mt-3">
            <div class="card card-default">
                <form action="{{ url('admin/product/update/'.$product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-header">
                        <div class="card-title">Update Product</div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Select Category</label>
                                        <select name="category_id" id="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                                            <option value="">Select Section</option>
                                            @foreach ($categories as $section)
                                                <optgroup label="{{ $section->name }} Section"></optgroup>
                                                @foreach ($section->categories as $category)
                                                    <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>&nbsp;&nbsp;&raquo;{{ $category->category_name }}</option>
                                                    @foreach ($category->subcategories as $subcategory)
                                                        <option value="{{ $subcategory->id }}" @if($subcategory->id == $product->category_id) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&raquo;{{ $subcategory->category_name }}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @if($errors->has('category_id'))
                                        <span style="display: block; font-size:12px; color:red;">{{ $errors->first('category_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input type="text" name="product_name" value="{{ $product->product_name }}" id="product_name" class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" placeholder="Enter Product Name">
                                    @if($errors->has('product_name'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('product_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Product Price</label>
                                    <input type="text" name="product_price" value="{{ $product->product_price }}" id="product_price" class="form-control {{ $errors->has('product_price') ? 'is-invalid' : '' }}" placeholder="Enter Product Price">
                                    @if($errors->has('product_price'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('product_price') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Product Discount (%)</label>
                                    <input type="text" name="product_discount" value="{{ $product->product_discount }}" id="product_discount" class="form-control {{ $errors->has('product_discount') ? 'is-invalid' : '' }}" placeholder="Enter Product Disount">
                                    @if($errors->has('product_discount'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('product_discount') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Product Featured</label>
                                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ ($product->is_featured) ? 'checked' : '' }}>
                                </div>

                                <div class="form-group">
                                    <label for="">Product Description</label>
                                    <textarea name="product_description" id="product_description" cols="" rows="3" class="form-control" placeholder="Enter Product Description">{{ $product->product_description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Meta Title</label>
                                    <textarea name="meta_title" id="meta_title" cols="" rows="3" class="form-control" placeholder="Enter Meta Title">{{ $product->meta_title }}</textarea>
                                </div>
                            </div>

                            <!-- /. Left Form Elements -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Product Brand</label>
                                        <select name="brand_id" id="brand_id" class="form-control {{ $errors->has('brand_id') ? 'is-invalid' : '' }}">
                                            <option value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" @if(isset($product->brand->id) && ($brand->id == $product->brand->id)) selected @endif>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('brand_id'))
                                        <span style="display: block; font-size:12px; color:red;">{{ $errors->first('brand_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Product Code</label>
                                    <input type="text" name="product_code" value="{{ $product->product_code }}" id="product_code" class="form-control {{ $errors->has('product_code') ? 'is-invalid' : '' }}" placeholder="Enter Product Code">
                                    @if($errors->has('product_code'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('product_code') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Product Weight</label>
                                    <input type="text" name="product_weight" value="{{ $product->product_weight }}" id="product_weight" class="form-control {{ $errors->has('product_weight') ? 'is-invalid' : '' }}" placeholder="Enter Product Weight">
                                    @if($errors->has('product_weight'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('product_weight') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Product Main Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="product_main_image" class="custom-file-input {{ $errors->has('product_main_image') ? 'is-invalid' : '' }}" id="">
                                        <label class="custom-file-label" for="">Choose file</label>
                                    </div>
                                    @if($errors->has('product_main_image'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('product_main_image') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Product Video</label>
                                    <div class="custom-file">
                                        <input type="file" name="product_video" class="custom-file-input {{ $errors->has('product_video') ? 'is-invalid' : '' }}" id="">
                                        <label class="custom-file-label" for="">Choose file</label>
                                    </div>
                                    @if($errors->has('product_video'))
                                    <span style="display: block; font-size:12px; color:red;">{{ $errors->first('product_video') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" cols="" rows="3" class="form-control" placeholder="Enter Meta Description">{{ $product->meta_description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Meta Keywords</label>
                                    <textarea name="meta_keywords" id="meta_keywords" cols="" rows="3" class="form-control" placeholder="Enter Meta Keywords">{{ $product->meta_keywords }}</textarea>
                                </div>

                            </div>
                            <!-- /. Left Form Elements -->

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary fa-pull-right">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script src="{{ asset('js/admin/product.js') }}"></script>
    @if (Session::has('flash_success'))
        <script>
            $(function(){
                swal.fire({
                    title: 'Success!',
                    text: "{{ Session::get('flash_success') }}",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
    @endif
@endsection
