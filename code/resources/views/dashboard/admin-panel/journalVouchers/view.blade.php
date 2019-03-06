

<div class="container" id="masterContent">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;">ID #:  <span style="font-size: 16px;">{{ $jrnlVchrs->id }}</span> </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($jrnlVchrs->date)) }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Account Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->acnt_nme }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Account Number: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->acnt_nbr }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->amount }}</p>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Bank Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->bankName }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cheque Number: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->chqe_no }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Bank Reference: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->bankName }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Clearance Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($jrnlVchrs->clrance_date)) }}</p>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ strip_tags($jrnlVchrs->detail) }}</p>
        </div>
    </div>
    <a class="btn btn-success" href="{{action('GeneralReceiptPaymentController@downloadPDF', $jrnlVchrs->id)}}" target="_blank">Get PDF/Print </a>
</div>
