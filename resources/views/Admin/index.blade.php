
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome Admin</title>
    <link rel="icon" type="image/png" href="/Assets/css/images/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Assets/css/adminMenu.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
</head> 
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top nav-top"> 
        <img src="Assets/css/images/BaniLogo.png" class="logon">
		<a class="navbar-brand nav-title ml2" href="#"> Bani <b> E-Market</b></a>  
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
                <a class="nav-link nav-link-text" href="AdminHome">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-text" href="{{url('SalesView')}}">Sales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-text" href="{{url('AddProduct')}}">Products</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link-text" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Users
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{url('AddCustomer')}}">Customers</a>
                    <a class="dropdown-item" href="{{url('AddSupplier')}}">Suppliers</a>
                </div>
            </li>
             <li class="nav-item dropdown">
                    <a style="margin-right: 10%" class="nav-link dropdown-toggle nav-link-text " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{session('Active')}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right text-left" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{URL('AddAdmin/'.session('Active'))}}">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout">Log Out</a>
                    </div>
                </li>
        </ul>
    </div>
    </nav>
    <center>
    <div class="container mon-log">
        <div class="alert alert-danger" role="alert">
            <h3 class="ml16">Dashboard</h3>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="jumbotron text-center" id="img-log" >
                    <h4 class="Mlabel">All Sales</h4>
                    <h2 class="Mlabel">&#8369 {{$sales}}</h2>
                </div> 
            </div>
            <div class="col-sm-4">
                <div class="jumbotron text-center"id="img-log1" >
                    <h4 class="Mlabel">Number of Orders</h4>
                    <h2 class="Mlabel">{{$ocount}}</h2>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="jumbotron text-center" id="img-log2">
                    <h4 class="Mlabel">Number of Users</h4>
                    <h2 class="Mlabel">{{$Ucount}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card border-danger bg-light mb-3">
            <div class="card-header">
                <h2>Products<h2>
                </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Photo</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($product as $row)
                        <tr>
                            <td>{{$row->Category}}</td>
                            <td>{{$row->product_name}}</td>
                            <td>P {{$row->product_price}}/kilo</td>
                            <td>{{$row->product_qty}}</td>
                            <td><img src="/Assets/ProductImage/{{$row->product_image}}" class="img-thumbnail" width="65" /></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{url('AddProduct')}}" class="btn btn-danger btn-head">See All</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card border-danger bg-light mb-3">
            <div class="card-header">
                <h2>Sales<h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Purchase Date</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($psales as $row)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($row->date_of_order)->format('l M/d/Y')}}</td>
                            <td>{{$row->product_name}}</td>
                            <td>{{$row->customer_name}}</td>
                            <td>{{$row->total_price}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{url('SalesView')}}" class="btn btn-danger btn-head">See All</a>
            </div>
        </div>
    </div>
    </center>
</body>
<script src="Assets/animations.js"></script>
</html>