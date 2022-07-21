<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Log in</title>
<link rel="icon" type="image/png" href="/Assets/css/images/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="Assets/css/login.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <img src="Assets/css/images/BaniLogo.png" class="logon">
            <a class="navbar-brand ml2" href="#">Bani <b> E-Market</b></a> 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
        </div>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
          <div class="card-header">
              <h1 class="ml16">About</h1>
            </div>
            <div class="card-body scroll">
                <p class="card-text">
                    <strong>Edited...</strong>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-5">
            <div class="jumbotron jumbs">
                <form class="form-group" method="post" action="{{route('check')}}">
                {{@csrf_field()}}
                <div class="form-group">
                    <label class="formlab" for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                </div>
                <div class="form-group">
                    <label class="formlab" for="exampleInputPassword1">Password</label>
                    <input type="password" name="Password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    <span class="text-danger">{{ $errors->first('Password') }}</span>
                </div>
                <p>Don't have account?<a href="{{route('AddCustomer.create')}}">Create now!</a></p>
                <button type="submit" class="btn btn-danger">Submit</button>
                </form>
            </div>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Log in Failed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>{{Session::get('Fail')}}</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="Assets/animations.js"></script>
</html>                                                                                    