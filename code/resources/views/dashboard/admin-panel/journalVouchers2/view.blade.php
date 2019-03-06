

<div class="container" id="masterContent">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;">ID #:  <span style="font-size: 16px;">{{ $jrnlVchrs->id }}</span> </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($jrnlVchrs->created_at)) }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Account Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->acntName }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Dr: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->dr }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cr: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->cr }}</p>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Bank Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->bnkName }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cheque Number: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->chqe_no }}</p>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Bank Reference: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $jrnlVchrs->bnkRefer }}</p>
        </div>
    </div>

    <div class="clearfix"></div>

    <a class="btn btn-success" href="{{action('JournalVouchersController@downloadPDF', $jrnlVchrs->id)}}" target="_blank">Get PDF/Print </a>
</div>
