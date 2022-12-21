<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
$username = "admin";
$password = "=@!#254tecmint";
$ready = "mysql:host=localhost;dbname=booking";

$conn = new PDO( $ready, $username, $password);
global $conn;

  /* ********************************** SIGNUP PAGE ********************************** */

function userSignup(){
    global $conn;
    $your_name = $_POST['your_name'];
    $userName = $_POST['uname'];
    $userEmail = $_POST['mail'];
    $userPassword = $_POST['pwd'];

    $query = $conn->prepare("SELECT count(user_name) FROM signup WHERE user_name = :uname");
    $query->bindParam(":uname", $userName,PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetchColumn();
    $rest = array();
    
    if ($row > 0) {
        $rest['type']="error";
        $rest['message']="Username already exists.";
    }else{
        $sqlInsert = $conn->prepare("INSERT INTO signup(your_name,user_name,email_id,password)
                                    VALUES(:yname,:username,:email,:password)"); 
        $sqlInsert->bindParam(':yname', $your_name,PDO::PARAM_STR);
        $sqlInsert->bindParam(':username', $userName,PDO::PARAM_STR);
        $sqlInsert->bindParam(':email', $userEmail,PDO::PARAM_STR);
        $sqlInsert->bindParam(':password', $userPassword,PDO::PARAM_STR);
        $sqlInsert->execute();
        
        $rest['type']="success";
        $rest['message']="New account created !";
    }
    echo json_encode($rest);
}

  /* ********************************** LOGIN PAGE ********************************** */

function user_login(){
    global $conn;

    session_start();
    $log_name = $_POST['name'];
    $log_pwd = $_POST['pwd'];

    $name_sql = $conn->prepare("SELECT count(*) FROM signup WHERE user_name = :lgname");
    $name_sql->bindParam(":lgname",$log_name,PDO::PARAM_STR);
    $name_sql->execute();
    $row = $name_sql->fetchColumn();
    $response = array();
    
    if($row > 0){
        $pwd_sql= $conn->prepare("SELECT count(*) FROM signup WHERE user_name = :lgName AND password = :lgpwd");
        $pwd_sql->bindParam(":lgName",$log_name,PDO::PARAM_STR);
        $pwd_sql->bindParam(":lgpwd",$log_pwd,PDO::PARAM_STR);
        $pwd_sql->execute();
        $raw = $pwd_sql->fetchColumn();
        if($raw > 0){
            $response['type']="login";
            $response['message']="Login Successfull !";
            $_SESSION['username'] = $log_name;
            
        }else{
            $response['type']="password";
            $response['message']="Password is wrong !";
        }
    }else{
        $response['type']="username";  
        $response['message']="Username is not exist !";
    }
    echo json_encode($response);
}

  /* ********************************** ADMIN PAGE ********************************** */

    /* ***************** ADD MOVIE DETAILS ***************** */

function movie_add(){
    global $conn;

    $name_of_movie = $_POST['movie_name'];
    $date_of_movie = $_POST['movie_date'];
    $movie_starting_time = $_POST['movie_start_time'];
    $movie_ending_time = $_POST['movie_end_time'];  

    if ($name_of_movie !='' && $date_of_movie !='' && $movie_starting_time != '' && $movie_ending_time != '') {
        $movie_name = $conn->prepare("INSERT INTO movie_name(movie_name)VALUES(:m_name)"); 
        $movie_name->bindParam(':m_name', $name_of_movie,PDO::PARAM_STR);
        $movie_name->execute();
        $movie_name_id =$conn->lastInsertId();
        
        $movie_data = $conn->prepare("INSERT INTO movie_details(movie_name_id,movie_date,movie_start,movie_end) 
                                        VALUES(:m_name_id,:d_movie,:s_movie,:e_movie)"); 
        $movie_data->bindParam(':m_name_id', $movie_name_id,PDO::PARAM_INT);
        $movie_data->bindParam(':d_movie', $date_of_movie,PDO::PARAM_STR);
        $movie_data->bindParam(':s_movie', $movie_starting_time,PDO::PARAM_STR);
        $movie_data->bindParam(':e_movie', $movie_ending_time,PDO::PARAM_STR);
        $movie_data->execute();
        echo "Movie added";
    }else{
        echo"Please fill all fileds";
    }
}

    /* ***************** MOVIE DATA_TABLE ***************** */

function show_edit_data(){
    global $conn;

    $query_show = $conn->prepare("SELECT movie_name.id,movie_name.movie_name,movie_details.movie_date FROM movie_name INNER JOIN movie_details ON movie_name.id = movie_details.movie_name_id ");
    $query_show->execute();
    $movieData = array();
    
    while ($result = $query_show->fetch(PDO::FETCH_ASSOC)) {
        $movieRows = array();

        $movieRows[] = $result['id'];
        $movieRows[] = '<span id="'.$result['id'].'"class="movieN">'.$result['movie_name'].'</span>';
        $movieRows[] = $result['movie_date'];
        $movieRows[] = '<button type="button" name="update" id="'.$result["id"].'" class="btn btn-warning btn-xs update"> Update </button>';
        $movieRows[] = '<button type="button" name="delete" id="'.$result["id"].'" class="btn btn-danger btn-xs delete"> Delete </button>';
        $movieData[] =$movieRows;
    }
    $dataset = array(
        "data" => $movieData,
        "sql" => $query_show,
    );
    echo json_encode($dataset);
}

  /* ******************* MOVIE NAME ID ******************* */

function user_ragister_data(){
    global $conn;
    
    $nId =$_POST['nId'];
    $query_user = $conn->prepare("SELECT * FROM user_details where movie_id=:id");
    $query_user->bindParam(':id',$nId,PDO::PARAM_INT);
    $query_user->execute();
    $userData = array();
    
    while ($row = $query_user->fetch(PDO::FETCH_ASSOC)) {   
        
        $userRows = array();
        $userRows[] = $row['id'];
        $userRows[] = $row['user_name'];
        $userRows[] = $row['user_s_date'];
        $userRows[] = $row['user_s_time'];
        $userRows[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs u_update"> Update </button>';
        $userRows[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs u_delete"> Delete </button>';
        $userData[] =$userRows;
    }
    $dataUser = array(
        "data" => $userData,
        // "sql" => $query_user,
    );
    echo json_encode($dataUser);
}

// function user_mList(){
//     global $conn;
//     $nId =$_POST['nId'];

//     $u_fet =$conn->prepare("SELECT * FROM movie_name");
//     $u_fet->execute();
//     $r = $u_fet->fetch(PDO::FETCH_ASSOC);
//     // echo json_encode($r);
//     // print_r($r)
//     while($r = $u_fet->fetch(PDO::FETCH_ASSOC)){
//         if ($r['id'] == $nId) {
//             echo'<option value="'.$r['id'].'" selected>'.$r['movie_name'].'</option>';
//         }else {
//             echo'<option value="'.$r['id'].'">'.$r['movie_name'].'</option>';
//         }
//     }
// }

function show_Umovie(){
    global $conn;
    $pId = $_POST['empId'];
    
    $u_fet =$conn->prepare("SELECT * FROM user_details WHERE id=:id");
    $u_fet->bindParam(':id',$pId,PDO::PARAM_INT);
    $u_fet->execute();
    $r = $u_fet->fetch(PDO::FETCH_ASSOC);
    echo json_encode($r);
}

function update_save(){
    global $conn;
    $upId = $_POST['upId'];
    $user_name = $_POST['user_name'];
    $movie_id = $_POST['movie_id'];
    $up_date = $_POST['up_date'];
    $up_time = $_POST['up_time'];

    if ($up_time != 'none' || !isset($up_date)) {
        $update_user=$conn->prepare("UPDATE user_details SET movie_id=:m_id,user_name=:u_n,user_s_date=:u_s_date,user_s_time=:u_s_time WHERE id=:id");
        $update_user->bindParam(':id',$upId,PDO::PARAM_INT);
        $update_user->bindParam(':u_n',$user_name,PDO::PARAM_STR);
        $update_user->bindParam(':m_id',$movie_id,PDO::PARAM_STR);
        $update_user->bindParam(':u_s_date',$up_date,PDO::PARAM_STR);
        $update_user->bindParam(':u_s_time',$up_time,PDO::PARAM_STR);
        $update_user->execute();

        echo 'Update successfull !';
    }else{
        echo 'error !';
    }
}

function delete_user(){
    global $conn;
    $udId = $_POST['udId'];

    $user_delete = $conn->prepare("DELETE FROM user_details where id=:id");
    $user_delete->bindParam(':id', $udId,PDO::PARAM_INT);
    $user_delete->execute();
}
  /* ******************* MOVIE UPDATE ******************* */

function show_movie(){
    global $conn;
    $uId = $_POST['uId'];

    $fet_movie = $conn->prepare("SELECT movie_name.id,movie_name.movie_name,movie_details.movie_date,movie_details.movie_start,movie_details.movie_end FROM movie_name INNER JOIN movie_details ON movie_name.id = movie_details.movie_name_id WHERE movie_name.id =:id");
    $fet_movie->bindParam(':id',$uId,PDO::PARAM_INT);
    $fet_movie->execute();
    $fi_modal = $fet_movie->fetch(PDO::FETCH_ASSOC);
    echo json_encode($fi_modal);
}

function update_data(){
    global $conn;
    $Id = $_POST['id'];
    $u_m = $_POST['u_m'];
    $u_d = $_POST['u_d'];
    $u_st = $_POST['u_st'];
    $u_et = $_POST['u_et'];

    $update_name = $conn->prepare("UPDATE movie_name SET movie_name =:name WHERE id=:id");
    $update_name->bindParam(':id',$Id,PDO::PARAM_INT);
    $update_name->bindParam(':name',$u_m,PDO::PARAM_STR);
    $update_name->execute();

    $update_dt = $conn->prepare("UPDATE movie_details SET movie_date =:date,movie_start=:st,movie_end=:et WHERE movie_name_id=:id");
    $update_dt->bindParam(':id',$Id,PDO::PARAM_INT);
    $update_dt->bindParam(':date',$u_d,PDO::PARAM_STR);
    $update_dt->bindParam(':st',$u_st,PDO::PARAM_STR);
    $update_dt->bindParam(':et',$u_et,PDO::PARAM_STR);
    $update_dt->execute();
}

  /* ******************* MOVIE DELETE ******************* */

function deleteMovie(){
    global $conn;
    $d_id = $_POST['dId'];

    $del_mov_name = $conn->prepare("DELETE FROM movie_name where id = :id");
    $del_mov_name->bindParam(':id', $d_id,PDO::PARAM_INT);
    $del_mov_name->execute();

    $del_mov_data = $conn->prepare("DELETE FROM movie_details where movie_name_id = :id");
    $del_mov_data->bindParam(':id', $d_id,PDO::PARAM_INT);
    $del_mov_data->execute();
}

 /* ************************************************* USER SELECTION PAGE ************************************************* */

  function user_select_movie(){
    global $conn;

    $mId = $_POST['mId'];

    $u_s_query = $conn->prepare("SELECT * FROM movie_details where movie_name_id =:id");
    $u_s_query->bindParam(':id', $mId,PDO::PARAM_INT);
    $u_s_query->execute();
    $result1 = $u_s_query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result1);
  }

  function date_availbility(){
    global $conn;

    $empId = $_POST['empId'];
    $usr_s_date = strtotime($_POST['usr_s_date']);
    $sta_d = strtotime($_POST['date1']);
    $end_d = strtotime($_POST['date2']);
    
    if ($usr_s_date >= $sta_d && $usr_s_date <=$end_d) {

        $u_d_query = $conn->prepare("SELECT * FROM movie_details where movie_name_id =:id ");
        $u_d_query->bindParam(':id', $empId,PDO::PARAM_INT);
        $u_d_query->execute();
        echo '<option value="">Select</option>';
        while ($result2 = $u_d_query->fetch(PDO::FETCH_ASSOC)) {
            echo '<option id="'.$result2['id'].'">'.$result2['movie_start'].'-'.$result2['movie_end'].'</option>';
        }   
    } else {
        echo '<option value="none" selected>No show available!</option>';
    }
  }

  function user_ticket(){
    global $conn;

    $user_name = $_POST['user_name'];
    $movie_id = $_POST['movie_id'];
    $user_date = $_POST['u_date'];
    $user_time = $_POST['u_time'];

    if ($user_time != 'none' || !isset($user_date)) {
        $user_tickte = $conn->prepare("INSERT INTO user_details(movie_id,user_name,user_s_date,user_s_time) 
                                        VALUES(:m_id,:user_n,:user_d,:user_t)");
        $user_tickte->bindParam(':m_id',$movie_id,PDO::PARAM_INT);
        $user_tickte->bindParam(':user_n',$user_name,PDO::PARAM_STR);
        $user_tickte->bindParam(':user_d',$user_date,PDO::PARAM_STR);
        $user_tickte->bindParam(':user_t',$user_time,PDO::PARAM_STR);
        $user_tickte->execute();
        
        echo 'Ticket Book !';
        
    } else {
        echo 'Movie is not available on this date !';
    }
    
  }

?>