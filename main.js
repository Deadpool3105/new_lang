$(document).ready(function (){

  /* ********************************** SIGNUP PAGE ********************************** */

  $("#accountOpen").validate({
    rules: {
      yourname:'required',
      username: "required",
      useremail:{
        required: true,
        email: true
      },
      userpwd:"required"
    },
    messages: {
      yourname:"Please enter your name !",
      username: "Please enter username !",
      useremail:{
        required:"Please enter email !",
        email:"Please enter valid email !"
      },
      userpwd:"please enter valid password !"
    },
    submitHandler: function () {
      var your_name = $("#your_name").val().trim();
      var uname = $("#user_name").val().trim();
      var mail = $("#user_email").val();
      var pwd = $("#user_password").val();
      var action = "signUp";
      $.ajax({
        url: "ind.php",
        method: "POST",
        dataType: "json",
        data: {
          action: action,
          your_name:your_name,
          uname: uname,
          mail: mail,
          pwd: pwd,
        },
        success: function (data){
          if(data.type == "error"){
            $("#check").html(data.message).css("color","#faff00");
          }else{      
            $("#check").html("");
            alert(data.message);
            window.location.href = "logIn.php";
            $("#submit").attr("disabled", false);
          }
        },
      });
    },
  });

  /* ********************************** LOGIN PAGE ********************************** */
  

  $("#SigninForm").submit(function (e) {
    e.preventDefault();
    var ln_name = $("#loginName").val().trim();
    var ln_pwd = $("#loginPwd").val();
    var action = "login";
    $.ajax({
      url: "ind.php",
      method: "POST",
      dataType: "json",
      data: {name:ln_name,pwd:ln_pwd,action:action},
      success: function (data) {
        if (data.type == "username") {
          $("#inncLogin,#inncorectpwd").html("");
          $("#inncorectname").html(data.message).css("color", "rgb(78 198 255)");
        } else {
          if (data.type == "password") {
            $("#inncorectname,#inncLogin").html("");
            $("#inncorectpwd").html(data.message).css("color", "rgb(78 198 255)");
          } else {
            $("#inncorectpwd,#inncorectname").html("");
            alert(data.message);

            if (ln_name == 'admin') {
              window.location.href = "admin.php";
            }else {
              window.location.href = "user.php";
            }
          }
        }
      },
    });
  });  

  $("#logout_img,#LOGOUT_IMG").click(function () {
    $.ajax({
      url: "logout.php",
      method: "POST",
      success: function (data) {
        window.location.href = "logIn.php";
        window.location.reset();
      },
    });
  })

  /* ************************************************ ADMIN PAGE ************************************************ */

  $('#show_date,#ushow_date').daterangepicker({  
    "linkedCalendars": false,
    "opens": "center",
    locale: {
      // format: "YYYY-MM-DD",
      // separator: "/",
      format: "YYYY-MM-DD",
      separator: "/",
    }
  })

  /* ************************************** MOVIE ADD MODAL 1 ************************************** */
  
  $("#add_movie_details").click(function(){
    $("#add_movie").modal('show');
    $("#close").click(function(){
      $("#add_movie").modal('hide');
    })
  })

    /* *************************** ADD MOVIE DETAILS *************************** */

  $("#ADMIN_ADD_FORM").submit(function (e) {
    e.preventDefault();
    var movie_name = $("#movie_name").val();
    var movie_date = $("#show_date").val();
    var movie_start_time = $("#start_time").val();
    var movie_end_time = $("#end_time").val();
    var action = "movie_add";

    $.ajax({
      url: "ind.php",
      method: "POST",
      data: {
        movie_name:movie_name,
        movie_date:movie_date,
        movie_start_time:movie_start_time,
        movie_end_time:movie_end_time,
        action:action
      },
      success: function (data) {
        alert(data)
        $('#add_movie').modal('hide');
        window.location.reload();
      }
    })
  })
  
  /* ************ MULTIPLE TIME PICKER IN ADMIN MODAL ************ */

  var max_flids = 7;
  var x = 1;

  $(".add_time_filde_button").click(function(e){
    e.preventDefault();
    if(x < max_flids){
      x++;
      $(".add_time_zone").append('<div class="time_zone form-group row mt-3" id="add_time_zone">\
                                    <div class="time col-4">\
                                      <input type="Time" class="form-control" name="start_time[]" id="start_time" value="">\
                                    </div>\
                                    <label class="col-1" style="margin-top: 2px;font-size: 20px;">TO</label>&nbsp;&nbsp;\
                                    <div class="time col-4">\
                                      <input type="Time" class="form-control" name="end_time[]" id="end_time" value="">\
                                    </div>\
                                      <button type="button" class="btn btn-primary remove_filde">-</button>\
                                  </div>'
                                )
    }
  });
  $(".add_time_zone").on('click','.remove_filde',function(e){
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  });

  /* ***************** MOVIE DETAILS DATA-TABLE ***************** */

  $("#Movie_Table").DataTable({
    "ajax": {
      url: "ind.php",
      type: "POST",
    },
    success: function (data) {
     alert(data);
    }
  });

    /* *************************************************** NAME MODAL 2 *************************************************** */

  $("#Movie_Table").on('click','.movieN',function(){
    var nId =  this.id;
    var action = 'user_ragister_data';
    $("#user_details").modal("show");
    $(".User_Table").DataTable({
      // retrieve: true,
      destroy: true,
      "serverSide": false,
      "ajax": {
        url: "ind.php",
        type: "POST",
        data: {nId: nId,action: action},
        dataType: 'json',
      },
      success: function (data) {
       console.log(data);
      }
      // $("#up_movie").val("<option value="+data.id+">"+data.movie_name+"</option>")
    })
  })
  // $("#Movie_Table").on('click','.movieN',function(){
  //   var nId =  this.id;
  //   var action = 'user_mList';
  //   // $("#user_details").modal("show");
  //  $.ajax({
  //   url:'ind.php',
  //   method:'POST',
  //   dataType:'json',
  //   data:{nId:nId,action:action},
  //   success: function(data){
  //     // if (data.id == nId) {
  //       // $("#up_movie").html("<option value="+data.id+" selected>"+data.movie_name+"</option>");
  //     // } else {
  //       // $("#up_movie").html("<option value="+data.id+">"+data.movie_name+"</option>");
  //     // }
  //     $(".up_movie").val(data);
  //   }
  //  })
  // })
  /* ************* USER INFO. DATA-TABLE ************* */
  $(".User_Table").on('click','.u_update',function(){
    var empId = this.id;
    // var Nid = $(".movieN").attr('id');
    var action = 'show_Umovie';
    $.ajax({
      url:'ind.php',
      method:'POST',
      dataType:'json',
      data:{empId:empId,action:action},
      success: function(data){
        $("#update_ticket").modal('show');
        $("#umpId").val(data.id);
        $("#up_name").val(data.user_name);
        $("#up_date").val(data.user_s_date);
        $("#up_time").html("<option value="+data.user_s_time+">"+data.user_s_time+"</option>");
        // window.location.reload();
      }
    })
  })

  $(document).on('submit','#up_ticket',function(e){
    e.preventDefault();
    var upId =  $("#umpId").val();
    console.log(upId);
    var user_name = $("#up_name").val();
    var up_movie = $("#up_movie").val();
    var up_date = $("#up_date").val();
    var up_time = $("#up_time").val().trim();
    console.log(up_date);
    var action = 'update_save';
    $.ajax({
      url: "ind.php",
      method: "POST",
      data: {
        upId:upId,
        action: action,
        user_name:user_name,
        movie_id: up_movie,
        up_date: up_date,
        up_time: up_time,
      },
      success: function(data){
        if (data == 'error !') {
          alert(data);
        }else{
          $("#update_ticket").modal('hide');
          alert(data);
          window.location.reload();
        }
      }
    })
  })

  $('.User_Table').on('click','.u_delete',function(){
    var udId = this.id;
    var action = 'delete_user';
   if (confirm("Are you sure ?")) {
     $.ajax({
       url:"ind.php",
       method:"POST",
       data: {udId: udId,action: action },
       success: function (data) {
         window.location.reload();
        }
      })
    }else{
      return false;
    }
  })
    /* ***************************************** UPDATE MODAL ***************************************** */

    $('#Movie_Table').on('click','.update',function(){
      var uId = this.id;
      var action = 'show_movie';
      $("#update_movie").modal('show');
      $.ajax({
        url:"ind.php",
        method:"POST",
        dataType:'json',
        data: {uId: uId,action: action },
        success: function (data) {
          // console.log(data.id);
          $("#empId").val(data.id);
          $("#umovie_name").val(data.movie_name);
          $("#ushow_date").val(data.movie_date);
          $("#ustart_time").val(data.movie_start);
          $("#uend_time").val(data.movie_end);
          // $('.drp-selected').val(data.movie_date);
        }
      })
    })

    $(document).on('submit','#ADMIN_UPDATE_FORM',function(e){
      e.preventDefault();
      var id = $("#empId").val();
      // console.log(id);
      var action = 'update_data';
      var u_m = $("#umovie_name").val();
      var u_d = $("#ushow_date").val();
      var u_st = $("#ustart_time").val();
      var u_et = $("#uend_time").val();
      $.ajax({
        url:"ind.php",
        method:"POST",
        // dataType:'json',
        data: {
          id:id,
          u_m:u_m,
          u_d:u_d,
          u_st:u_st,
          u_et:u_et,
          action: action,
        },
        success: function (data) {
          // alert();
          // console.log(data);
          $("#update_movie").modal('hide');
          window.location.reload();

        }
      })
    })
     /* ************ MULTIPLE TIME PICKER IN UPDATE MODAL ************ */

  var max_uflids = 7;
  var y = 1;
  $(".update_time_button").click(function(e){
    e.preventDefault();
    if(y < max_uflids){
      y++;
      $(".add_utime").append('<div class="time_zone form-group row mt-3" id="add_time_zone">\
                                <div class="time col-4">\
                                  <input type="Time" class="form-control" name="ustart_time[]" id="ustart_time" value="">\
                                </div>\
                                <label class="col-1" style="margin-top: 2px;font-size: 20px;">TO</label>&nbsp;&nbsp;\
                                <div class="time col-4">\
                                  <input type="Time" class="form-control" name="uend_time[]" id="uend_time" value="">\
                                </div><button type="button" class="btn btn-primary remove_ufilde">-</button>\
                              </div>'
                            )
    }
  });
  $(".add_utime").on('click','.remove_ufilde',function(e){
    e.preventDefault();
    $(this).parent('div').remove();
    y--;
  })
    
    /* ***************** DELETE MOVIE ***************** */

  $('#Movie_Table').on('click','.delete',function(){
    var dId = this.id;
    console.log(dId);
    var action = 'delete_movie';
   if (confirm("Are you sure ?")) {
     $.ajax({
       url:"ind.php",
       method:"POST",
       data: {dId: dId,action: action },
       success: function (data) {
         window.location.reload();
        }
      })
    }else{
      return false;
    }
  })


  /* ************************************************* USER SELECTION PAGE ************************************************* */
  
  /* ************************ USER MOVIE SELECTION ************************ */

  $("#user_select_movie,#up_movie").on('change',function(){
    var mId = this.value;
    var action = 'user_select_movie';
    $.ajax({
      method: "POST",
      url: "ind.php",
      data: {
        mId: mId,
        action:action,
      },
      dataType: 'json',
      success: function (data) {
        /* ************** MOVIE DATE CHECK ************** */

        $("#user_date,#up_date").on('change',function(){
          var empId = data.movie_name_id;
          var action = 'date_range_check';
          var usr_s_date = this.value;
          var stclassval = data.movie_date;                       
          var arr_stcls = stclassval.split('/');
          var val1 = arr_stcls[0];
          var val2 = arr_stcls[1];
          // console.log(usr_s_date);
          // console.log(val1);
          // console.log(val2);
          $.ajax({
            url:'ind.php',
            method:'POST',
            data:{
              empId:empId,
              action:action,
              usr_s_date:usr_s_date,
              date1:val1,
              date2:val2,
            },
            success: function(result){
              $("#select_time,#up_time").html(result);
            }
          })
          
        });
        
      }
    })
  })

  $("#book_ticket").validate({
    rules:{
      // user_movie:"required",
      // user_date:"required",
    },
    messages:{

    },
    submitHandler: function () {
      var user_name = $("#user_name").val();
      var movie_id = $("#user_select_movie").val();
      var u_date = $("#user_date").val();
      var u_time = $("#select_time").val();
      // console.log(u_date);
      // console.log(u_time);
      var action = "user_book";
      $.ajax({
        url: "ind.php",
        method: "POST",
        data: {
          action: action,
          user_name:user_name,
          movie_id: movie_id,
          u_date: u_date,
          u_time: u_time,
        },
        success: function(data){
          alert(data);
          $("#book_ticket").reset();
        }
      })
    }

  })
  
})