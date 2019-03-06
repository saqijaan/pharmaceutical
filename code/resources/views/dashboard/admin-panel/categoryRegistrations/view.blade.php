

<div class="container" id="masterContent">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID #: <span style="font-size: 16px;">{{ $cates->id }}</span>  </h3>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Category Name: <span style="font-size: 16px;font-weight: normal;">{{ $cates->name }}</span>  </h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <hr style="margin: 5px 0px 0px;" />
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> <span style="font-size: 16px;">Detail:</span> </h3>
            <div style="text-indent: 10px;"> {!! $cates->detail !!}</div>
        </div>
        <div class="clearfix"></div>

    </div>
    <hr style="margin: 5px 0px 15px;" />
</div>
