<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome Customer</title>
    <link rel="icon" type="image/png" href="/Assets/css/images/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/Assets/css/C_index.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
</head> 
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top nav-top"> 
        <img src="/Assets/css/images/BaniLogo.png" class="logon">
		<a class="navbar-brand nav-title ml2" href="#"> Bani <b class="word"> E-Market</b></a>  
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">             
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top nav-under">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link nav-link-text" href="{{url('AddOrder/create')}}">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-link-text" href="{{URL('SetOrder/create/'.session('Active'))}}">Orders</a>
                </li>
                <li>
                    <form class="form-inline" method="get" action="{{url('search')}}">
                        <input class="form-control" type="search" name="query" placeholder="Product/Category" aria-label="Search">
                        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </li>
                <li class="nav-item dropdown">
                    <a style="margin-right: 10%" class="nav-link dropdown-toggle nav-link-text " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{session('Active')}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right text-left" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{URL('AddCustomer/'.session('Active'))}}">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('logout')}}">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <center>
    <div class="container-fluid banner-img">
        <div id="MyCarousel" class="carousel slide" data-ride="carousel">
            
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
        
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="/Assets/css/images/Banner2.jpg" class="d-block img-fluid" alt="Banner">
                </div>
                <div class="carousel-item">
                <img src="/Assets/css/images/Banner1.jpg" class="d-block img-fluid" alt="Banner">
                </div>
                <div class="carousel-item">
                <img src="/Assets/css/images/Banner.jpg" class="d-block img-fluid" alt="Banner">
                </div>
            </div>
           
            <a class="carousel-control-prev" href="#MyCarousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#MyCarousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
</center>
    <div class="container mon-log">
         @foreach($product->chunk(4) as $row)
         <div class="row tbody">
             @foreach($product as $row)
             <div class="col-md-3">
                 <div class="ibox">
                     <div class="ibox-content product-box">
                         <div class="product-imitation">
                             <img class="img-product" src="/Assets/ProductImage/{{$row->product_image}}">
                         </div>
                            <div class="product-desc">
                                <span class="product-price">P {{$row->product_price}}/Kilo</span>
                                <small class="text-muted">{{$row->Category}}</small><br>
                                <small class="text-muted">Available: {{$row->product_qty}}</small>
                                <p class="product-name"><b>{{$row->product_name}}</b></p>
                                <p class="font-weight-normal">{{$row->product_details}}</p>
                                <div class="m-t text-left">
                                    <form class="form-inline" method="POST" action="{{url('AddOrder')}}">
                                        {{@csrf_field()}}
                                        <div class="form-group">
                                            <input type="hidden" name="Pname" value="{{$row->product_name}}">
                                            <input type="hidden" name="Pprice" value="{{$row->product_price}}">
                                            <input type="hidden" name="Pimage" value="{{$row->product_image}}">
                                            <input type="hidden" name="Psupplier" value="{{$row->supplierID}}">
                                            <input type="hidden" name="Pid" value="{{$row->id}}">
                                            <input type="hidden" name="Sid" value="{{$row->account_id}}">
                                            <input type="hidden" name="userid" value="{{session()->get('Active')}}">
                                            <input class="form-control" name="Qty" id="input_qty" type="text" placeholder="Qty" aria-label="Text">
                                            <button class="btn btn-outline-danger" type="submit"><span><i class="fa fa-shopping-cart"></i></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
@if (count($errors)>0)
    <script>
        $(document).ready(function () {
            $('#modalFilm').modal('show');
        });
    </script>
@endif

<div class="modal fade" id="modalFilm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h2>Some Error Occured</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Details:</h3>
                    <ul>
                    @foreach ($errors->all() as $error )
                        <li class="Cerror">{{$error}}</li>              
                    @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @if (Session::get('Fail'))
    <script>
        $(document).ready(function () {
            $('#modalFilmS').modal('show');
        });
    </script>
</div>@endif

<div class="modal fade" id="modalFilmS" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="exampleModalLongTitle">Failed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>{{Session::get('Fail')}}</h3>
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/Assets/animations.js"></script>
</html>