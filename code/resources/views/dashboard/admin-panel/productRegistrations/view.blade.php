
<div class="container" id="masterContent">
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID #: <span style="font-size: 16px;">{{ $product->id }}</span>  </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->name }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cost Price: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->cost_price }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Sale Price: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->slae_price }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Reorder Level: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->reorder_level }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Unit: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->unit }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Box: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->box }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Barcode: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->barcode }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Vait: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->vait }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Company Discount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->company_discount }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Hole Sale Price: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->holesale_price }}</p>
        </div>

        @foreach( $cates as $cate )
            @if( $cate->id == $product->cate_id )
            <div class="col-md-4 col-sm-6 col-xs-12">
                <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Category Name: </h3>
                <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $cate->name }}</p>
            </div>
            @endif
        @endforeach
        @foreach( $brands as $brand )
            @if( $brand->id == $product->brand_id )
            <div class="col-md-4 col-sm-6 col-xs-12">
                <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Brand Name: </h3>
                <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $brand->name }}</p>
            </div>
            @endif
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->detail }}</p>
        </div>
    </div>
    <a class="btn btn-success" href="{{action('ProductRegistrationController@downloadPDF', $product->id)}}" target="_blank">Get PDF/Print </a>
</div>
