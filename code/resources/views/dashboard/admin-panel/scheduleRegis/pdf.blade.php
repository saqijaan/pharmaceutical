
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Schedule Detail | Protech IT Zone</title>

</head>
<body>

<div class="container" id="masterContent" style="max-width: 900px;width: 100%;overflow:hidden;">
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> ID: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->id }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Date: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ date('d-m-Y', strtotime($scheduls->date)) }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Doctor Name: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->doctor }}</p>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row" style="max-width: 900px;width:100%;padding: 0 -7.5px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Gift: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->gift }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Sample: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->sample }}</p>
        </div>
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Brochure: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->brochure }}</p>
        </div>
    </div>
    <div style="clear:both"></div>

    <div class="row" style="max-width: 900px;width:100%;padding: 0 0px">
        <div style="width: 31.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> City: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->city }}</p>
        </div>
        <div style="width: 65.3%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Address: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->address }}</p>
        </div>
        <div style="clear:both"></div>
        <div style="width: 98%;float:left;position:relative;padding: 0 7.5px">
            <h3 style="margin-bottom: 0;font-size: 14px;font-weight: bolder;"> Detail: </h3>
            <p style="border: 1px solid #ccc;padding: 5px 5px;"> {{ $scheduls->detail }}</p>
        </div>
        <div style="clear:both"></div>
    </div>
</div>

</body>
</html>