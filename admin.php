<?php
session_start();

// echo"<center><h3 style='margin-top: 20px;margin-bottom: 20px;'>";
// echo"Welcome admin : " .$_SESSION['username'];
// echo"</h3></center>";
$username = "admin";
$password = "=@!#254tecmint";
$ready = "mysql:host=localhost;dbname=booking";

$conn = new PDO( $ready, $username, $password);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
   
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
    
    <link rel="stylesheet" href="style.css" type="text/css"></link>
    

    <title>Welcome - <?php echo $_SESSION['username']?></title>
</head>
<body>

    <!-- /* *****************MOVIE ADD MODAL ***************** */ -->

    <div class="d-flex justify-content-between head">
        <button class="btn btn-info" type="button" id="add_movie_details">Add Movie</button>
        <!-- <input type="image" src="./image/logout-icon-removebg-preview.png" alt="logout_logo" id="logout_img"> -->
        <input type="image" src="https://thumbs.dreamstime.com/b/logout-icon-glassy-brown-round-button-isolated-abstract-illustration-103975968.jpg" alt="logout_logo" id="logout_img">
    </div>
    <hr style="margin: 0 0 1.5rem 0;color: inherit;border: 0;border-top: 1px solid;opacity: 0.5;">
    <div class="container">
        <div class="modal fade" id="add_movie" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <form id="ADMIN_ADD_FORM" class="admin">
                    <div class="modal-content">
                        <div style="background-color: gainsboro;border-radius: 7px;">
                            <div class="text-center">
                                <h3 class="modal-title ">Movie Details</h3>
                            </div>
                            <hr>
                            <div class="modal-body">
                                <div class="form-group row mb-4">
                                    <label class="col-3">MOVIE</label>:
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="movie_name" id="movie_name" placeholder="Movie name . ." value="">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-3">SHOW DATE</label>:
                                    <div class="col-5">
                                        <input type="text" class="form-control" name="show_date" id="show_date" placeholder="Select date . .">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="time" class="col-3">SHOW TIME</label>:
                                    <div class="add_time_zone form-group row col-8" id="add_time_zone">
                                        <div class="col-4">
                                            <input type="Time" class="form-control" name="start_time[]" id="start_time" value="">
                                        </div>
                                        <label class="col-1" style="margin-top: 2px;font-size: 20px;">TO</label>&nbsp;&nbsp;
                                        <div class="col-4">
                                            <input type="Time" class="form-control" name="end_time[]" id="end_time" value="">
                                        </div>    
                                    </div>
                                    <div style="display: contents;">
                                        <button type="button" class="btn btn-primary add_time_filde_button" id="add_time_filde_button">+</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <button type="submit" id="save" class="btn btn-info">Save</button>&nbsp;
                                    <button type="reset" id="close" class="btn btn-warning">Close</button>&nbsp;
                                </div> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
    <!-- /* *****************MOVIE DETAILS DATA-TABLE ***************** */ -->

    <table id="Movie_Table">
        <thead>
            <tr>  
                <th># &nbsp; </th>
                <th>Movie_Name &nbsp; </th>
                <th>Show_Date &nbsp; </th>
                <th>Update &nbsp; </th>
                <th>Delete &nbsp; </th>
            </tr>
        </thead>
    </table>

    <!-- /* ***************** USER INFO DATA-TABLE ***************** */ -->

    <div class="container">
        <div class="modal fade" id="user_details" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                        <div class="text-center">
                            <h3 class="modal-title ">User Details</h3>
                        <hr>
                    </div>
                    <div class="modal-body">
                        <table class="User_Table">
                            <thead>
                                <tr>  
                                    <th># </th>
                                    <th>User_Name&nbsp;</th>
                                    <th>Show_Date&nbsp;</th>
                                    <th>Show_Time&nbsp;</th>
                                    <th>Update&nbsp;</th>
                                    <th>Delete&nbsp;</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /* ***************** MOVIE UPDATE MODAL ***************** */ -->

    <div class="container">
        <div class="modal fade" id="update_movie" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <form id="ADMIN_UPDATE_FORM" >
                    <div class="modal-content">
                        <div style="background-color: gainsboro;border-radius: 7px;">
                            <div class="text-center">
                                <h3 class="modal-title ">Movie Details</h3>
                            </div>
                            <hr>
                            <div class="modal-body">
                                <div class="form-group row mb-4">
                                    <label class="col-3">MOVIE</label>:
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="umovie_name" id="umovie_name" placeholder="Movie name . ." value="">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-3">SHOW DATE</label>:
                                    <div class="col-5">
                                        <input type="text" class="form-control" name="ushow_date" id="ushow_date" accept="true">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="time" class="col-3">SHOW TIME</label>:
                                    <div class="add_utime form-group row col-8" id="add_utime">
                                        <div class="col-4">
                                            <input type="Time" class="form-control" name="ustart_time[]" id="ustart_time" value="">
                                        </div>
                                        <label class="col-1" style="margin-top: 2px;font-size: 20px;">TO</label>&nbsp;&nbsp;
                                        <div class="col-4">
                                            <input type="Time" class="form-control" name="uend_time[]" id="uend_time" value="">
                                        </div>
                                    </div>
                                    <div style="display: contents;">
                                        <button type="button" class="update_time_button btn btn-primary" id="update_time_button">+</button>
                                    </div>    
                                </div>
                                <hr>
                                <div class="modal-footer">
                                    <input type="hidden" name="empId" id="empId" />
                                    <button type="submit" id="updateSave" name="updateSave"class="btn btn-info">Save</button>&nbsp;
                                    <button type="button" id="updateClose" class="btn btn-warning">Close</button>&nbsp;
                                </div> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="modal fade update_ticket" id="update_ticket" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <form id="up_ticket" class="mt-5" style="width: 43%;margin-left: 94px;border: none;position: fixed;"> 
                    <div class="modal-content">
                        <div style="background-color: gainsboro;border-radius: 7px;">
                            <div class="text-center">
                                    <h3 class="modal-title ">Update</h3>
                            </div>
                            <hr>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="" class="form-label col-3 h5">Name</label>:
                                    <div class="col-8">
                                        <input type="text" value="" id="up_name" name="up_name" class="form-control tet_style mb-3" disabled>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="movies" class="col-3 form-label h5">Movie &nbsp;List</label>:
                                    <div class="col-8">
                                        <select class="form-select form-select-sm tet_style up_movie" id="up_movie">
                                            <!-- <option >Select</option>; -->
                                            <?php
                                                $pId = $_POST['nId'];
                                                $u_fet =$conn->prepare("SELECT * FROM movie_name");
                                                // $u_fet->bindParam(':id',$pId,PDO::PARAM_INT);
                                                $u_fet->execute();
                                                while($r = $u_fet->fetch(PDO::FETCH_ASSOC)){
                                                    // if ($r['id'] == $pId) {
                                                        // echo'<option value="'.$r['id'].'" selected>'.$r['movie_name'].'</option>';
                                                    // } else {
                                                        echo'<option value="'.$r['id'].'">'.$r['movie_name'].'</option>';
                                                    // }
                                                    
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="movies" class="col-3 form-label h5">Show &nbsp;Date</label>:
                                    <div class="col-8">
                                        <input type="date" class="form-control" name="up_date" id="up_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="movies" class="col-3 form-label h5">Show &nbsp;Time</label>:
                                    <div class="col-8">
                                        <select class="form-select form-select-sm tet_style" name="up_time" id="up_time">
                                            <option selected>Select</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <!-- <div class="d-flex justify-content-center"> -->
                                <div class="modal-footer">
                                    <input type="hidden" name="umpId" id="umpId"/>
                                    <button type="submit" class="btn btn-primary" class="submit" id="up_submit">Save</button>
                                    <button type="button" id="up_close" class="btn btn-warning">Close</button>&nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="main.js" type="text/javascript"></script>
</html>