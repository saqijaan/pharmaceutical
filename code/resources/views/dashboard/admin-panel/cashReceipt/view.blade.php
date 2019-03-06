

<div class="container" id="masterContent">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;">ID #:  <span style="font-size: 16px;">{{ $cshRcpts->id }}</span> </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($cshRcpts->date)) }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cash Account: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $cshRcpts->cashAccount }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Received Cash From: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $cshRcpts->rcvdFrom }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $cshRcpts->amount }}</p>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ strip_tags($cshRcpts->detail) }}</p>
        </div>
    </div>
    <a class="btn btn-success" href="{{action('CashReceiptController@downloadPDF', $cshRcpts->id)}}" target="_blank">Get PDF/Print </a>
</div>
