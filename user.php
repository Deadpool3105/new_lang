<?php
session_start();

$username = "admin";
$password = "=@!#254tecmint";
$ready = "mysql:host=localhost;dbname=booking";

$conn = new PDO( $ready, $username, $password);



// echo"<center>";
// echo"<h3>Welcome user :-&nbsp ";
// echo "<u>".$_SESSION['username']."</u>";
// echo"</h3></center>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
    
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
   
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="style.css">
    <title>Welcome User - <?php echo $_SESSION['username']?></title>
</head>
<body>
    
    <div id="LOGOUT_IMG">
        <!-- <img src="./image/logout-icon-removebg-preview.png" class="float-end" height="40" style="cursor: pointer;margin: -30px 20px 0 0;"> -->
        <input type="image" src="https://thumbs.dreamstime.com/b/logout-icon-glassy-brown-round-button-isolated-abstract-illustration-103975968.jpg" class="float-end">
    </div>
    <center>
        <h3>Welcome User:- <u><?php echo $_SESSION['username']?></u></h3>
    </center>
    
    <div class="abc">
    <div class="container">
        <div class="d-flex justify-content-center">
            <form id="book_ticket" class="col-7 mt-5 ">    
                <h2 class="text-center mb-4">booking Form</h2>

                <div class="form-group row">
                  <label for="" class="form-label col-3 h5">Name</label>:
                    <div class="col-7">
                        <!-- <p class="form-control tet_style" id="user_name" name="user_name"></p> -->
                        <input type="text" value="<?php echo $_SESSION['username']?>"  id="user_name" name="user_name" class="form-control tet_style mb-3" disabled>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="movies" class="col-3 form-label h5">Movie &nbsp;List</label>:
                    <div class="col-7">
                        <select class="form-select form-select-sm tet_style" id="user_select_movie">
                            <option selected>Select</option>;
                            <?php 
                                $u_fet =$conn->prepare("SELECT * FROM movie_name");
                                $u_fet->execute();
                                while($r = $u_fet->fetch(PDO::FETCH_ASSOC)){ 
                                    echo'<option value="'.$r['id'].'">'.$r['movie_name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="movies" class="col-3 form-label h5">Show &nbsp;Date</label>:
                    <div class="col-7">
                        <input type="date" class="form-control" name="user_date" id="user_date">
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="movies" class="col-3 form-label h5">Show &nbsp;Time</label>:
                    <div class="col-7">
                        <select class="form-select form-select-sm tet_style" name="select_time" id="select_time">
                            <option selected>Select</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" class="submit" id="submit_user">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
    </div>

</body>
<script src="main.js" type="text/javascript"></script>

</html>