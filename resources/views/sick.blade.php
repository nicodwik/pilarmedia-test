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
        height: 600px;
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
                        @if (!Session::has('result'))
                            <form id="login-form" class="form" action="{{route('approval.store')}}" method="POST">
                                @csrf
                                <h3 class="text-center text-info">Sick Leave Approval</h3>
                                <div class="form-group">
                                    <label for="email" class="text-info">Email:</label><br>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="myemail@email.com">
                                </div>
                                <div class="form-group">
                                    <label for="pin" class="text-info">PIN:</label><br>
                                    <input type="password" name="pin" id="pin" class="form-control" placeholder="Enter 5-digits employee PIN">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="text-info">Date:</label><br>
                                    <input type="date" name="date" id="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="text-info">Reason:</label><br>
                                    <textarea name="reason" id="" cols="30" rows="5" class="form-control" placeholder="I've been headcache"></textarea>
                                </div>
                                <input type="hidden" name="type" value="sick_leave">
                                <div class="form-group mb-1">
                                    <input type="submit" name="submit" class="btn btn-block btn-info btn-md" value="Submit">
                                </div>
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
                        <div class="alert alert-danger mt-5" role="alert">
                            {{$errors->first()}}
                        </div>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
