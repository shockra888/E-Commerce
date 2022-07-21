<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show Orders</title>
    <link rel="icon" type="image/png" href="/Assets/css/images/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/Assets/css/C_orders.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top nav-under">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="form-inline">
             <input class="form-control" name="query" id="search" type="search" placeholder="AutoSearch" aria-label="Search">
            </form>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link nav-link-text" href="{{url('AddOrder/create')}}">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link nav-link-text" href="{{URL('SetOrder/create/'.session('Active'))}}">Orders</a>
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
    <div class="container mon-log">
    <div class="container">
        <div class="card border-danger bg-light mb-3">
            <div class="card-header">
                <h2>orders<h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Order date</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                        <h3>Your total balance is {{$total}}</h3>
                        <a href="{{action('SetOrderController@edit',session('Active'))}}" class="btn btn-warning btn-out">Payment</a>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    </center>
</body>
<script>
    $(document).ready(function(){
        fetch_order_data();
        function fetch_order_data(query = ''){
            $.ajax({
                url: "{{route('search.action')}}",
                method: 'GET',
                data: {query:query},
                dataType: 'json',
                success:function(data){
                    $('tbody').html(data.table_data);
                }
            })
        }

        $(document).on('keyup','#search', function(){
            var query = $(this).val();
            fetch_order_data(query);
        });
    });
</script>
<script src="/Assets/animations.js"></script>
</html>