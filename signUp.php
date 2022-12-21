<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Sign_Up</title>
</head>
<body>
    <div class="d-flex justify-content-center">
        <div class="row fullBody">
            <div class="text-center mt-3">
                <h1>Welcome To BookMyShow</h1>
            </div>
            <form id="accountOpen" class="sigfom mt-4">    
                <h2 class="text-center mb-2">Signup Form</h2>
                <div class="form-group">
                    <div style="display: flex;justify-content: space-between;">
                        <label for="fullName" class="mb-2 h6" >You Name :</label>
                    </div>
                    <input type="text" class="form-control mb-3" name="yourname" id="your_name" placeholder="x y z . . . .">
                </div>
                <div class="form-group">
                    <div style="display: flex;justify-content: space-between;">
                        <label for="userName" class="mb-2 h6" >Username :</label>
                        <span id="check"></span>
                    </div>
                    <input type="text" class="form-control mb-3" name="username" id="user_name" placeholder="x y z . . . .">
                </div>
                <div class="form-group">
                    <label for="userEmail" class="mb-2 h6">Email :</label>
                    <input type="mail" class="form-control mb-3" name="useremail" id="user_email" placeholder="xyz@123gmail.com">
                </div> 
                <div class="form-group">
                    <label for="userPassword" class="mb-2 h6">Password :</label>
                        <input type="password" class="form-control mb-3" name="userpwd" id="user_password" placeholder="* * * * * * * * *  ">
                </div>
                <div class="text-center mt-4">
                        <button type="submit" class="sub"  id="submit">Signup</button>
                </div>
                <center class="mt-3">
                    <p>Already have an account? &nbsp;<a href="logIn.php">Login now</a></p>
                </center>
            </form>
        </div>
    </div>
    <script src="main.js" type="text/javascript"></script>
</body>
</html>