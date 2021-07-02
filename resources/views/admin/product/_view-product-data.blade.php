<div class="container-fluid">
    <div class="row">
        <div class="col-md-5" style="text-align: center; padding:20px;">
            @if(!empty($product->product_main_image))
                <img src="{{ asset('storage/product_images/large/'.$product->product_main_image) }}" alt="{{ $product->product_main_image }}" style="width: 80%" />
            @endif

            @if(empty($product->product_main_image))
                <img src="{{ asset('images/no_image.jpg') }}" alt="no image" style="width: 80%;" />
            @endif
        </div>

        <div class="col-md-7 p-20">
            <h5>{{ $product->product_name }}</h5>
            <hr>
            <h6><strong>Department:-</strong> {{ $product->section->name }}</h6>
            <h6><strong>Category:-</strong> {{ $product->category->category_name }}</h6>
            <h6><strong>Featured:-</strong> {{ ($product->is_featured) ? 'Yes' : 'No' }}</h6>
            <hr>
            <p>{{ ($product->product_description) ? $product->product_description : "N/A" }}</p>
            <hr>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4" style="background-color: #eee; padding: 20px;">
            <h5>Meta Title</h5>
            <p>{{ $product->meta_title }}</p>
        </div>

        <div class="col-md-4" style="background-color: #eee; padding: 20px;">
            <h5>Meta Description</h5>
            <p>{{ $product->meta_description }}</p>
        </div>

        <div class="col-md-4" style="background-color: #eee; padding: 20px;">
            <h5>Meta Keywords</h5>
            <p>{{ $product->meta_keywords }}</p>
        </div>
    </div>
</div>
