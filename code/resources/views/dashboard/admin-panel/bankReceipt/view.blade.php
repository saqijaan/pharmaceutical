

<div class="container" id="masterContent">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;">ID #:  <span style="font-size: 16px;">{{ $bnkRcpts->id }}</span> </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($bnkRcpts->date)) }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Account Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkRcpts->acntName }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkRcpts->amount }}</p>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Bank Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkRcpts->bnkName }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cheque Number: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkRcpts->chqe_no }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Bank Reference: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkRcpts->bnkRefer }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Clearance Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($bnkRcpts->clrance_date)) }}</p>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ strip_tags($bnkRcpts->detail) }}</p>
        </div>
    </div>
    <a class="btn btn-success" href="{{action('BankReceiptController@downloadPDF', $bnkRcpts->id)}}" target="_blank">Get PDF/Print </a>
</div>
