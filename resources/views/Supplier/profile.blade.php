<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier Profile</title>
    <link rel="icon" type="image/png" href="/Assets/css/images/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/Assets/css/S_profile.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top nav-top">
        <img src="/Assets/css/images/BaniLogo.png" class="logon">
        <a class="navbar-brand nav-title ml2" href="#"> Bani <b> E-Market</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

            </ul>
        </div>
    </nav>

    <div class="container mon-log">
        <div class="container">
            <div class="card bg-danger border-danger bg-light mb-3">
                <div class="card-header">
                    <a href="{{URL('SupplierHome')}}" class="btn btn-danger btn-back">Back</a>
                    <a href="{{action('AddingSupplierController@edit',$supplierprofile->account_id)}}" class="btn btn-warning btn-out">Edit Profile</a>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5">
                                <img class="img-prof" src="/Assets/css/images/pro.gif">
                            </div>
                            <div class="col-sm-5">
                                <h1>{{$supplierprofile->Supplier_Name}} ({{$supplierprofile->account_id}})</h1>
                                <h3>{{$supplierprofile->email}}</h3><br>
                                <h4>{{$supplierprofile->Supplier_Address}}</h4>
                                <h4>{{$supplierprofile->Supplier_Contact}}</h4>
                                <h4>{{$supplierprofile->Gender}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="Assets/animations.js"></script>
</html>