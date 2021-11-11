<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;
    }
    #login .container #login-row #login-column #login-box {
        margin-top: 120px;
        max-width: 600px;
        height: 350px;
        border: 1px solid #9C9C9C;
        background-color: #EAEAEA;
    }
    #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
    }
    #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -85px;
    }
</style>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('login-page')}}" class="btn btn-primary mt-2">Login</a>
                                <a href="{{route('sick-page')}}" class="btn btn-primary mt-2 ml-2">Sick Leave</a>
                                <a href="{{route('paid-page')}}" class="btn btn-primary mt-2 ml-2">Paid Leave</a>
                            </div>
                        
                        @if (!Session::has('result'))
                            <form id="login-form" class="form" action="{{route('presence')}}" method="POST">
                                @csrf
                                <h3 class="text-center text-info">Presence</h3>
                                <div class="form-group">
                                    <label for="email" class="text-info">Email:</label><br>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="myemail@email.com">
                                </div>
                                <div class="form-group">
                                    <label for="pin" class="text-info">PIN:</label><br>
                                    <input type="password" name="pin" id="pin" class="form-control" placeholder="Enter 5-digits employee PIN">
                                </div>
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="long" id="long">
                                <div class="form-group mb-1">
                                    <input type="button" name="button" onclick="getLocation()" class="btn btn-block btn-info btn-md" value="Submit">
                                </div>
                                <small>Max presence time allowed: 9 A.M. - Min away time allowed: 5 P.M.</small>
                            </form>
                           
                        @else
                            @php
                                $result = explode('|',Session::get('result'))
                            @endphp
                            <div class="alert alert-{{$result[0]}} mt-3" role="alert">
                                {{$result[1]}}
                            </div>
                        @endif
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3" role="alert">
                            {{$errors->first()}}
                        </div>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>


<script>
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    }
    
    function showPosition(position) {
    //   x.innerHTML = "Latitude: " + position.coords.latitude +
    //   "<br>Longitude: " + position.coords.longitude;
        document.getElementById('lat').value = position.coords.latitude
        document.getElementById('long').value = position.coords.longitude

        document.getElementById('login-form').submit()
    }
</script>
