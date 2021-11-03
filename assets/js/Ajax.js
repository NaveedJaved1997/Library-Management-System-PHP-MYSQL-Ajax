// document.readyState(function(){
//Fetch Book
function LoadData (){
    $.ajax({
        type: "post",
        url: "fetch.php",
        data: {
            token: true ,
        },
        success: function (response) {
            // console.log(response);
            $('#table').append(response).fadeIn(3500);
        }
    });
    // $.ajax({
    //     type: "get",
    //     dataType: "html",
    //     url: "fetch.php",
    //     success: function (result) {
    //         $('#table').append(result).fadeIn(3500);
    //     }
    // });
};

//Add New Book
$('#add_book').click(function(e){
    e.preventDefault();
    var book = $('#book_name').val();
    var author = $('#author_name').val();
    var edition = $('#edition').val();
    var userid = $('#logout_btn').data('value');
    var rowCount = $("#table tr").length;

    var formData = new FormData();
    var input = document.querySelector('input[type=file]'),
    file = input.files[0];
    formData.append("imageupload", file);


    formData.append('token', true);
    formData.append('book_name', book);
    formData.append('author_name', author);
    formData.append('edition', edition);
    formData.append('user_id', userid);
    formData.append('sr', rowCount+1);
    // console.log(rowCount);
    var alert ='<div class="col-md-6 offset-md-3 mt-2 alert alert-success alert-dismissible fade show" role="alert">'
    +'<strong>Success!</strong><p>"Book Has Been Added Successfully.</p>'
    +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
    +'<span aria-hidden="true">&times;</span></button></div>';

    var newRow = "<tr><td class='sr' id='$row1['id']'>"+(rowCount+1)+"</td>"
    +"<td class='bookname'>" +book+ "</td>"
    +"<td class='authorname'>" +author+ "</td>"
    +"<td class='edition'>" +edition+ "</td>"
    +"<td class='image'></td>"
    +"<td><button class='btn text-info edit_btn' data-value=''><i class='fa fa-pencil-square fa-2x' aria-hidden='true'></i></button>"
    +"<button class='btn text-danger delete_btn' data-value=''><i class='fa fa-trash fa-2x' aria-hidden='true'></i></button>"
    +"</td></tr>";

    $.ajax({
        type: "post",
        url: "add.php",
        data: formData,
        // {
        //     imageupload: formData,
        //     token: true ,
        //     book_name: book,
        //     author_name: author,
        //     edition: edition,
        //     user_id: userid,
        //     sr: rowCount+1
        // },
        contentType: false,
        processData: false,
        success: function (result) {
            $('#addBookForm').trigger("reset");
            $('#AddModal').modal('toggle').fadeIn(3000);
            $('#alert').html(alert);
            $('#table').append(result);

        }
    });
});


  //Delete Book
$(document).on("click", ".delete_btn", function(e){
        e.preventDefault();
        var conf=  confirm("Are You Sure To Delete ?");
        if(conf == true){
            var deleteid = $(this).data('value');
            var rowid = $(this).closest('tr');
            var alertSuccess ='<div class="col-md-6 offset-md-3 mt-4 alert alert-warning alert-dismissible fade show" role="alert">'
            +'<strong>Success!</strong><p>Book Has Been Deleted.</p>'
            +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
            +'<span aria-hidden="true">&times;</span></button></div>';

            var alertError ='<div class="col-md-6 offset-md-3 mt-4 alert alert-danger alert-dismissible fade show" role="alert">'
            +'<strong>Success!</strong><p>An Error Occured.</p>'
            +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
            +'<span aria-hidden="true">&times;</span></button></div>';
          
            $.ajax({
                type: "post",
                url: "delete.php",
                data: {
                    token: true ,
                    deleteid: deleteid,
                },
                success: function (response) {
                    // console.log(response);
                    if(response.indexOf('Success') != -1){
                        $('#alert_danger').html(alertSuccess);
                        rowid.remove();
                    }
                    else
                    if(response.indexOf('Error') != -1){
                        $('#alert_danger').html(alertError);
                    }
                }
            });
        }

});
$edit ='';
var serial = '';
$(document).on("click", ".edit_btn", function(e){
    e.preventDefault();
    var editid = $(this).data('value');
    $edit = $(this).parent();

  	var book = $edit.siblings(".bookname").text();
  	var author = $edit.siblings(".authorname").text();
  	var edition = $edit.siblings(".edition").text();
    var oldimage = $edit.siblings('.image').prop('src'); 
    // var tmp = $('.image img').attr('src');
    // var tmp = $('.image img').data('img');
    // console.log(tmp);
    serial =  $edit.siblings(".sr").text();
      
      $('#edit_id').val(editid);
      $('#edit_book_name').val(book);
      $('#edit_author_name').val(author);
      $('#edit_edition').val(edition);
    //   $('#oldimage').val(oldimage);
    //   $('#oldimage').attr("src", tmp+oldimage);
      console.log(oldimage);


      $('#EditModal').modal('toggle');
    
});

//Update Book
$(document).on("click", "#update_btn", function(e){
    e.preventDefault();
    var id = $('#edit_id').val();
    var book = $('#edit_book_name').val();
    var author = $('#edit_author_name').val();
    var edition = $('#edit_edition').val();
    var oldimage = $('#oldimage').val();
    var rowid = $(this).closest('tr');
    var alert ='<div class="col-md-6 offset-md-3 mt-2 alert alert-success alert-dismissible fade show" role="alert">'
    +'<strong>Success!</strong><p>Book Has Been Updated Successfully.</p>'
    +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
    +'<span aria-hidden="true">&times;</span></button></div>';
    
    var formData = new FormData();
    var input = document.querySelector('input[type=file]'),
    file = input.files[0];
    formData.append("imageupload2", file);

    formData.append('token', true);
    formData.append('book_name', book);
    formData.append('author_name', author);
    formData.append('edition', edition);
    formData.append('id', id);
    formData.append('sr', serial);
    formData.append('oldimage', oldimage);

    $.ajax({
        type: "post",
        url: "update.php",
        data: formData,
        // {
        //     token: true ,
        //     id: id,
        //     book_name: book,
        //     author_name: author,
        //     edition: edition,
        //     oldimage: oldimage,
        //     sr: serial
        // },
        contentType: false,
        processData: false,
        success: function (result) {
            $('#updateBookForm').trigger("reset");

            $edit.parent().html(result);

            $('#alert').html(alert);
            $('#EditModal').modal('toggle');
        }
    });
});

// ***** Signup / login *****

//signup
    $(document).on("click", "#register_btn", function(e){
    e.preventDefault();
    // console.log("test");
    var name = $('#name').val();
    var email = $('#email').val();
    var pass = $('#password').val();

    var password_regex1=/([a-z].*[A-Z])|([A-Z].*[a-z])([0-9])+([!,%,&,@,#,$,^,*,?,_,~])/;
    var password_regex2=/([0-9])/;
    var password_regex3=/([!,%,&,@,#,$,^,*,?,_,~])/;
    var email_regex=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(name == '' || name == null){
        var nameError = '<div class="col-md-6 offset-md-3 mt-2 alert alert-warning alert-dismissible fade show" role="alert">'
        +'<strong>Error!</strong><p>Please Enter Your Full Name.</p>'
        +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
        +'<span aria-hidden="true">&times;</span>'
        +'</button>'
        +'</div>';
        $('#alert').html(nameError);
        // $('#name').addClass('border-danger');
    }
    //email check
    else if(email_regex.test(email)==false){
        // console.log(pass);
        var emailError = '<div class="col-md-6 offset-md-3 mt-2 alert alert-warning alert-dismissible fade show" role="alert">'
        +'<strong>Error!</strong><p>Please Enter a Valid Email.</p>'
        +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
        +'<span aria-hidden="true">&times;</span>'
        +'</button>'
        +'</div>';
        $('#alert').html(emailError);
        // $('#email').addClass('border-danger');
        // $('#name').removeClass('border-danger');
        // $('#name').addClass('border-success');
        // console.log(pass);
    }
    //check password
    else if(pass.length < 6  || password_regex2.test(pass)==false){
        if( password_regex1.test(pass)==false ||  password_regex3.test(pass)==false){

        var passError = '<div class="col-md-6 offset-md-3 mt-2 alert alert-warning alert-dismissible fade show" role="alert">'
        +'<strong>Error!</strong><p>Password Length Should be minimuum of 6 characters. And Should Contains 1 Upercase Leter 1 Special Symbol & 1 Numaric Value.</p>'
        +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
        +'<span aria-hidden="true">&times;</span>'
        +'</button>'
        +'</div>';
        $('#alert').html(passError);
        // $('#email').removeClass('border-danger');
        // $('#email').addClass('border-success');
        // $('#password').addClass('border-success');
        }
        }
    else{
        // $('#password').removeClass('border-danger');
        // $('#password').addClass('border-success');
        $.ajax({
            type: "post",
            url: "signup.php",
            data: {
                token: true ,
                name: name,
                email: email,
                password: pass
            },
            success: function (response) {
                // console.log('response');
                console.log(response);
                if (response.indexOf('Already') != -1) {
                    var tmp = '<div class="col-md-6 offset-md-3 mt-2 alert alert-warning alert-dismissible fade show" role="alert">'
                        +'<strong>Error!</strong><p>This Email is already Assosiated With Another Account.</p>'
                        +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                        +'<span aria-hidden="true">&times;</span></button></div>';
                        $('#alert').html(tmp);
                    }
                else if (response.indexOf('Success') != -1) {
                    var tmp = '<div class="col-md-6 offset-md-3 mt-2 alert alert-success alert-dismissible fade show" role="alert">'
                    +'<strong>Success!</strong><p>Registration Has Been Completed Successfully.</p>'
                    +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                    +'<span aria-hidden="true">&times;</span></button></div>';
                        $('#alert').html(tmp);
                    }
                    else if (response.indexOf('Failed') != -1) {
                        var tmp ='<div class="col-md-6 offset-md-3 mt-2 alert alert-danger alert-dismissible fade show" role="alert">'
                        +'<strong>Error!</strong><p>Somehow an error is occured.</p>'
                        +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                       +'<span aria-hidden="true">&times;</span></button></div>';
                        $('#alert').html(tmp);
                    }
                // $('#alert').html(response);

            }
        });
    }
    
    });

    //sign-in
    $(document).on("click", "#signin_btn", function(e){
        e.preventDefault();
        var email = $('#email').val();
        var pass = $('#password').val();
        // var remb = $('#remember').val();
        var remb = false;
        var checked = $('#remember').is(':checked');
        if(checked){
            remb = true;
        }
        else{
            remb = false;
        }

        // console.log(remb);
        //email check
        var email_regex=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(email_regex.test(email)==false){
            var emailError = '<div class="col-md-6 offset-md-3 mt-2 alert alert-warning alert-dismissible fade show" role="alert">'
            +'<strong>Error!</strong><p>Please Enter a Valid Email.</p>'
            +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
            +'<span aria-hidden="true">&times;</span>'
            +'</button></div>';
            $('#alert').html(emailError);
        }

        else{
            $.ajax({
            type: "post",
            url: "signin.php",
            data: {
                token: true ,
                email: email,
                password: pass,
                remember: remb
            },
            success: function (response) {
                // console.log(response);
                var alert_success = '<div class="col-md-6 offset-md-3 mt-2 alert alert-success alert-dismissible fade show" role="alert">'
                +'<strong>Success!</strong><p>Login Successfully.</p>'
                +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                +'<span aria-hidden="true">&times;</span></button></div>';

                var alert_danger ='<div class="col-md-6 offset-md-3 mt-2 alert alert-danger alert-dismissible fade show" role="alert">'
                +'<strong>Error!</strong><p>This Email is Not Registered.</p>'
                +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                +'<span aria-hidden="true">&times;</span></button></div>';
                
                var alert_warning ='<div class="col-md-6 offset-md-3 mt-2 alert alert-warning alert-dismissible fade show" role="alert">'
                +'<strong>Error!</strong><p>"Password Does Not Match.</p>'
                +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                +'<span aria-hidden="true">&times;</span></button></div>';
                
                if(response.indexOf('Success')!=-1){
                    $('#alert').html(alert_success);
                    $(location).attr('href','../../lms2/index.php');
                }
                else if(response.indexOf('Danger')!=-1){
                    console.log('Error: Email Not Found');
                    $('#alert').html(alert_danger);
                }
                else if(response.indexOf('Warning')!=-1){
                    $('#alert').html(alert_warning);
                    console.log('Warning: password does not match');
                }
            //     else{
            //     $(location).attr('href','../../lms2/index.php');
            // }
        }
        });
        }
        });

    //logout
    $(document).on("click", "#logout_btn", function(){
        var userid = $(this).data('value');
        $.ajax({
            type: "post",
            url: "logout.php",
            data: {
                token: true ,
                id: userid
            },
            success: function (response) {
                // console.log(response);
                var tmp ='<div class="col-md-6 offset-md-3 mt-2 alert alert-success alert-dismissible fade show" role="alert">'
                 +'<strong>Success!</strong><p>"Logout Successfully.</p>'
                 +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                 +'<span aria-hidden="true">&times;</span></button></div>';
                if(response.indexOf('Success')!= -1){
                    $(location).attr('href','../../lms2/login.php');
                    $('#alert').html(tmp);
                }

            }
        });
    });
    
    //Load users profile data
    function profile(){
        // $.ajax({
        //     type: "get",
        //     dataType: "html",
        //     url: "profile.php",
        //     success: function (result) {
        //         $('#profile').html(result).fadeIn(3500);
        //     }
        // });
        $.ajax({
            type: "post",
            url: "profile.php",
            data: {
                token: true ,
            },
            success: function (response) {
                // console.log(response);
                $('#profile').html(response).fadeIn(3500);
            }
        });
    };

// });
