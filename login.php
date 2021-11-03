<?php
require './header.php';
if(isset($_COOKIE['user_id'])){
    header('location: ./index.php');
}
else
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    header('location: ./index.php');
}
?>
    <title>Login : LMS</title>
</head>
<body>
    <?php include './nav.php'; ?>
    <div id="alert">

    </div>
    <div class="container col-md-6 offset-md-3 pt-5">
        <div class="card">
            <div class="card-header">
                Login
            </div>
            <div class="card-body">
            <form action="./signin.php" method="post">
                <input class="form-control m-1" type="text" name="email" id="email" value="<?php if(isset($_COOKIE['user_email'])){echo $_COOKIE['user_email'];}?>">
                <input class="form-control m-1" type="password" name="password" id="password" value="<?php if(isset($_COOKIE['user_pass'])){echo $_COOKIE['user_pass'];}?>">
                <input class="form-control-checkbox m-1" type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE['user_id'])){echo 'checked';}?>>
                <label class="form-control-label m-1" for="remember">Remember Me</label>
                <input class="btn btn-outline-primary m-1 float-right" type="submit" value="Sign-in" name="signin_btn" id="signin_btn">
            </form>
            </div>
        </div>
    </div>

<?php
require './footer.php';
?>