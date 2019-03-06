
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bank Payment Invoice | Protech IT Zone</title>

</head>
<body>

<div class="container" id="masterContent" style="max-width: 900px;width: 100%;overflow:hidden;">
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="float:left;position:relative;padding: 0 7.5px">
            <h3 style="text-align: center;margin-bottom: 0;font-size: 18px;font-weight: bolder;"> <span> Bank Payment Invoice </span></h3>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID #: <span style="font-size: 16px;">{{ $bnkPmnts->id }}</span> </h3>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($bnkPmnts->date)) }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Account Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkPmnts->acntName }}</p>
        </div>
        {{--<div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">--}}
            {{--<h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Account Number: </h3>--}}
            {{--<p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkPmnts->acnt_nbr }}</p>--}}
        {{--</div>--}}
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Amount: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkPmnts->amount }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Bank Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkPmnts->bnkName }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Cheque Number: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkPmnts->chqe_no }}</p>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Bank Reference: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $bnkPmnts->bnkRefer }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Clearance Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($bnkPmnts->clrance_date)) }}</p>
        </div>
    </div>
    <div style="clear:both"></div>

    <div class="row" style="max-width: 900px;width:100%;padding: 0 0px">
        <div style="width: 100%;float:left;position:relative;">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ strip_tags($bnkPmnts->detail) }}</p>
        </div>
        <div style="clear:both"></div>
    </div>

</div>

</body>
</html>