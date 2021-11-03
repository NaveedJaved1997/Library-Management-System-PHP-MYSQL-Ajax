<?php include './header.php';
if(!isset($_COOKIE['user_id']) && !isset($_SESSION['username'])){
    header('location: ./login.php');
}
?>
    <title>Users Settings</title>
</head>
<body>
    <?php include './nav.php';?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 card p-2 pt-3">
                <h5><i>Welcome</i> <b><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else if(isset($_COOKIE['user_name'])){echo $_COOKIE['user_name'];} ?></b></h5>
            <ul class="list-group list-unstyled">
                <li><a href="./index.php">Home</a></li>
                <li><a href="#">Change Password</a></li>
                <li><a class="text-danger" href="" data-value="<?php if(isset($_SESSION['userid'])){echo $_SESSION['userid'];} else if(isset($_COOKIE['user_id'])){echo $_COOKIE['user_id'];} ?>" id="logout_btn">Logout</a></li>
            </ul>
            </div>
            <div class="col-md-8 p-2 pt-3">
            <div class="container-fluid">
                <!-- <h3>Details Here</h3> -->
                <div class="card col-md-10 offset-md-1 p-0">
                    <div class="card-header bg-primary text-white">
                    <h4 class="text-center">Manage Profile</h4>
                    </div>
                    <div class="card-body">
                <form id="profile" action="#" method="post">
                    <input type="hidden" name="user_id" id="user_id">
                    <input class="form-control m-1" type="text" name="user_name" id="user_name">
                    <input class="form-control m-1" type="email" name="user_email" id="user_email">
                    <!-- <input class="form-control m-1" type="password" name="user_pass" id="user_pass"> -->
                    <input class="btn btn-outline-primary m-1 float-right" type="submit" value="Save Changes" id="update_profile_btn" name="update_profile_btn">
                </form>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

<?php
require './footer.php';
?>