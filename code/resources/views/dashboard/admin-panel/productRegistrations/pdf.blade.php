
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product Detail | Protech IT Zone</title>
</head>
<body>

<div class="container" id="masterContent" style="max-width: 900px;width: 100%;overflow:hidden;">
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID #: <span style="font-size: 16px;">{{ $product->id }}</span> </h3>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->name }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cost Price: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->cost_price }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Sale Price: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->slae_price }}</p>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Reorder Level: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->reorder_level }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Unit: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->unit }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Box: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->box }}</p>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Barcode: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->barcode }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Vait: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->vait }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Company Discount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->company_discount }}</p>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Hole Sale Price: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->holesale_price }}</p>
        </div>
        @foreach( $cates as $cate )
            @if( $cate->id == $product->cate_id )
            <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
                <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Category Name: </h3>
                <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $cate->name }}</p>
            </div>
            @endif
        @endforeach
        @foreach( $brands as $brand )
            @if( $brand->id == $product->brand_id )
            <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
                <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Brand Name: </h3>
                <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $brand->name }}</p>
            </div>
            @endif
        @endforeach
    </div>
    <div style="clear:both"></div>


    <div class="row" style="max-width: 900px;width:100%;padding: 0 0px">
        <div style="width: 100%;float:left;position:relative;">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $product->detail }}</p>
        </div>
        <div style="clear:both"></div>
    </div>
</div>

</body>
</html>