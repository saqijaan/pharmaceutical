

<div class="container" id="masterContent">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->id }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($scheduls->date)) }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Doctor Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->doctor }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Gift: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->gift }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Sample: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->sample }}</p>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Brochure: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->brochure }}</p>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> City: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->city }}</p>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Address: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->address }}</p>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->detail }}</p>
        </div>
    </div>
    <a class="btn btn-success" href="{{action('SchedleController@downloadPDF', $scheduls->id)}}" target="_blank">Get PDF/Print </a>
</div>
