<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Confirmation</title>
    <link rel="icon" type="image/png" href="/Assets/css/images/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/Assets/css/product.css">
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
    </div>
    </nav>
    <center>
    <div class="container mon-log">
    <div class="container">
        <div class="card border-danger bg-light mb-3">
            <div class="card-header">
                <h2>Your Order<h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Product Id</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">TotalPrice</th>
                        <th scope="col">Photo</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($product as $row)
                        <tr>
                        <td>{{$row->pid}}</td>
                        <td>{{$row->product_name}}</td>
                        <td>{{$row->product_qty}}</td>
                        <td>P {{$row->total_price}}/kilo</td>
                        <td>
                            <img src="/Assets/ProductImage/{{$row->product_photo}}"  class="img-thumbnail" width="65" />
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                <td>
                                    <form method="post" class="delete_form" action="{{action('AddOrderController@destroy',$id)}}">
                                        {{@csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-warning" value="Cancel">
                                    </form>
                                </td>
                            <td>
                                <form method="post" class="submit_form" action="{{url('SetOrder')}}">
                                    <input type="hidden" name="Pname" value="{{$row->product_name}}">
                                    <input type="hidden" name="Pqty" value="{{$row->product_qty}}">
                                    <input type="hidden" name="Tprice" value="{{$row->total_price}}">
                                    <input type="hidden" name="Supid" value="{{$row->sid}}">
                                    <input type="hidden" name="userid" value="{{session()->get('Active')}}">
                                    <input type="hidden" name="pid" value="{{$row->pid}}">
                                    <input type="hidden" name="status" value="unpaid">
                                        {{@csrf_field()}}
                                        <input type="submit" class="btn btn-danger" value="Purchase">
                                </form>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    </center>

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
                    <h5 class="modal-title" id="exampleModalLongTitle">Success</h5>
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
<script>
    $(document).ready(function(){
        $('.delete_form').on('submit',function(){
            if(confirm("Do you want to cancel the purchase?")){
                return true;
            }else{
                return false;
            }
        })

        $('.submit_form').on('submit',function(){
            if(confirm("Do you want to purchase the product?")){
                return true;
            }else{
                return false;
            }
        })
})
</script>
<script src="/Assets/animations.js"></script>
</html>