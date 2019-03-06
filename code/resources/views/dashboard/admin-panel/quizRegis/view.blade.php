

<div class="container" id="masterContent">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;">ID #:  <span style="font-size: 16px;">{{ $quizs->id }}</span> </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($quizs->date)) }}</p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Start Time: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $quizs->start_time }}</p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> End Time: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $quizs->end_time }}</p>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> <span style="font-size: 16px;">Question:</span> {{ strip_tags($quizs->question) }} </h3>
        </div>
        <div class="clearfix"></div>
        <hr style="margin: 5px 0px 0px;" />

        @foreach( $ans as $key=>$an )
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 7px;">
                <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;">  Answer {{ $key }} by <span style="font-size: 16px;">{{$an->employeName }}</span>: </h3>
                <div style="text-indent: 15px;">
                    {!! $an->answer !!}
                </div>
            </div>
        @endforeach
    </div>
    <hr style="margin: 5px 0px 10px;" />
    <a class="btn btn-success" href="{{action('QuizController@downloadPDF', $quizs->id)}}" target="_blank">Get PDF/Print </a>
</div>
