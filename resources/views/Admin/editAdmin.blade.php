<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>edit profile</title>
    <link rel="icon" type="image/png" href="/Assets/css/images/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/Assets/css/signup.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head> 
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #f7bfbe">          
    </nav>
    <center>
    <div class="container">
            <form method="post" action="{{action('AddingAdminController@update',$id)}}">
                {{@csrf_field()}}
                <div class="card">
                    <div class="card-heading" style="background-color: #ffe4e1">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="{{URL('AddAdmin/'.session('Active'))}}" class="btn btn-warning btn-cancel">Cancel</a>
                            </div>
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-danger btn-submit">Update</button> 
                                <input type="hidden" name="_method" value="PATCH">                             
                            </div>
                        </div>
                    </div>
                    <div class="card-body"> 
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user-o"></i></span>
                            </div>
                                <input type="text" class="form-control" name="Fname" placeholder="Full Name" aria-describedby="sizing-addon1" value="{{$editadmin->Admin_Name}}">
                            </div><br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                </div>
                                <input type="text" class="form-control" name="Address" placeholder="Address" aria-describedby="sizing-addon1" value="{{$editadmin->Admin_Address}}" >
                            </div><br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" name="Phonenum" placeholder="Phone Number" aria-describedby="sizing-addon1" value="{{$editadmin->Admin_Contact}}">
                            </div><br>
                            <div class="input-group">
                                <div class="form-check form-check-inline">
                                    <div class="input-group prepend">
                                        <span class="input-group-text">
                                    <input class="form-check-input" type="radio" name="Gender" value="Male">
                                        </span>
                                     <input type="text" class="form-check-label" value="Male" disabled>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline">
                                    <div class="input-group prepend">
                                         <span class="input-group-text">
                                    <input class="form-check-input" type="radio" name="Gender" value="Female">
                                         </span>
                                    </div>
                                    <input type="text" value="Female" class="form-check-label" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>   
    </center>
@if (count($errors)>0)
    <script>
        $(document).ready(function () {
            $('#modalFilm').modal('show');
        });
    </script>
</div>@endif

@if (Session::get('Success'))
    <script>
        $(document).ready(function () {
            $('#modalFilmS').modal('show');
        });
    </script>
</div>@endif

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
                    <h3>{{Session::get('Success')}}</h3>
                </div>
                <div class="modal-footer">
                    <a href="{{url('Admin.supplier')}}" class="btn btn-danger">Close</a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light fixed-bottom" style="background-color: #f7bfbe"></nav>
</body>
<script>
    $(document).ready(function(){
        $('.edit-info').on('submit',function(){
            if(confirm("Update your information?")){
                return true;
            }else{
                return false;
            }
        })
})
</script>
</html>