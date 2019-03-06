
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quiz Detail | Protech IT Zone</title>

</head>
<body>

<div class="container" id="masterContent" style="max-width: 900px;width: 100%;overflow:hidden;">
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="float:left;position:relative;padding: 0 7.5px">
            <h3 style="text-align: center;margin-bottom: 0;font-size: 18px;font-weight: bolder;"> Quiz Detail </span></h3>
        </div>
    </div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID #: <span style="font-size: 16px;">{{ $quizs->id }}</span> </h3>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($quizs->date)) }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Start Time: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $quizs->start_time }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> End Time: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $quizs->end_time }}</p>
        </div>
    </div>
    <div style="clear:both"></div>

    <div class="row" style="max-width: 900px;width:100%;padding: 0 0px">
        <div style="width: 98%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> <span style="font-size: 16px;">Question:</span> {{ strip_tags($quizs->question) }} </h3>
            <div style="text-indent: 15px;">

            </div>
        </div>
        <div style="clear:both"></div>
        <hr>
        <div style="clear:both"></div>
    @foreach( $ans as $key=>$an )
            <div style="width: 98%;float:left;position:relative;padding: 0 7.5px">
                <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;">  Answer {{ $key }} by <span style="font-size: 16px;">{{$an->employeName }}</span>: </h3>
                <div style="text-indent: 15px;">
                    {!! $an->answer !!}
                </div>
            </div>
            <div style="clear:both"></div>
        @endforeach
        <div style="clear:both"></div>
    </div>
</div>

</body>
</html>