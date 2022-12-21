<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
    <title>Log_In</title>
    <style>
        .main{
            height: 90%;
            display:flex;
            align-items: center;
            justify-content: center;
        }
        .fullBody{
            width: 55%;
            height: 95%;
            border-radius: 10px;
            display:flex;
            align-items: center;
            justify-content: center;
            background-repeat: repeat;
            background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzqeyWg5Qsvz67leY-K6TkZ2XLjKyrnhcOHw&usqp=CAU);
            box-shadow: 0 6px 30px 0 rgb(0 0 0 / 20%),
                        0 10px 50px 0 rgb(0 0 0 / 19%);
        }
        .error{
            color:#9b0824;
        }
        .ligfo{
            color:#fff;
            height: auto;
            width: 400px;
            padding: 20px;
            background: transparent;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 3px rgb(255 2 0 / 62%),
                        0px 0px 20px 3px rgb(255 212 0 / 62%) 
        }
        a{
            color: #00C9A7;
            text-decoration: none;
        }
        a:hover{
            color: #00C9A7;
            text-decoration: underline;
        }
        button{
            width: 80%;
            padding: 0;
            color: #fff;
            height: 45px;
            border: none;
            border-radius: 4px;
            background: #00C9A7;
            border-bottom: 2px solid rgba(0,0,0,0.1);
        }
        button:hover{
            color: #fff;
            background: #03af92;
        }
        #inncorectname,#inncorectpwd{
            margin-left: 8px;
            margin-top: -10px;
            margin-bottom: -10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main">
            <div class="fullBody">
                <form id="SigninForm" class="ligfo">
                    <h2 class="text-center mb-4">Login Form</h2>
                    <div class="form-group mb-4">
                        <label for="userName" class="mb-2 h6">Username :</label>   
                        <div class="">
                            <input type="text" class="form-control mb-3" name="loginName" id="loginName" placeholder="x y z . . . .">
                        </div>
                        <p id="inncorectname"></p>
                    </div>
                    <div class="form-group">
                        <label for="userPassword" class="mb-2 h6">Password :</label>
                        <div class="">
                            <input type="password" class="form-control mb-3" name="loginPwd" id="loginPwd" placeholder="* * * * * * * * * ">
                        </div>
                        <p id="inncorectpwd"></p>
                    </div>
                    <div class="text-end"><a href="#">Forgot password ?</a></div>
                    <div class="text-center mt-4">
                        <button type="submit" id="login" name="loggedin">Login</button>
                    </div>
                    <span id="inncLogin"></span>
                    <center class="mt-3">
                        <p>don't have an account?&nbsp; <a href="signUp.php">Signup now</a></p>
                    </center>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="main.js" type="text/javascript"></script>
</html>