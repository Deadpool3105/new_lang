<?php

include 'function.php';

if ($_POST['action'] == 'signUp') {
    userSignup();
}
elseif ($_POST['action'] == 'login'){
    user_login();
}
elseif($_POST['action'] == 'movie_add'){
    movie_add();
}
elseif ($_POST['action'] == 'user_ragister_data') {
    user_ragister_data();
}
elseif ($_POST['action'] == 'show_movie') {
    show_movie();
}
elseif ($_POST['action'] == 'update_data') {
    update_data();
}
// elseif ($_POST['action'] == 'user_mList') {
//     user_mList();
// }
elseif ($_POST['action'] == 'show_Umovie') {
    show_Umovie();
}
elseif ($_POST['action'] == 'delete_user') {
    delete_user();
}
elseif ($_POST['action'] == 'update_save') {
    update_save();
}
elseif ($_POST['action'] == 'delete_movie') {
    deleteMovie();
}
elseif ($_POST['action'] == 'user_select_movie') {
    user_select_movie();
}
elseif ($_POST['action'] == 'date_range_check') {
    date_availbility();
}
elseif ($_POST['action'] == 'user_book') {
    user_ticket();
}
else{
    show_edit_data();
}

?>