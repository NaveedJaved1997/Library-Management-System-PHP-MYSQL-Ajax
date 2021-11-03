<?php require './header.php';
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    header('location: ./index.php');
}
?>
    <title>Register</title>
</head>
<body>
    <?php include './nav.php';?>
    <div id="alert">

    </div>
    <div class="container col-md-6 offset-md-3 pt-5">

        <div class="card">
            <div class="card-header">
            <h4 class="card-title">Sign-up</h4>
            </div>
        <div class="card-body">
            <form action="./signup.php" method="post">
                <label class="p-1" for="name"><b>Full Name</b></label>
                <input class="form-control m-1" type="text" name="name" id="name" required>
                <label class="p-1" for="email"><b>Email</b></label>
                <input class="form-control m-1" type="email" name="email" id="email" required>
                <label class="p-1" for="password"><b>Password</b></label>
                <input class="form-control m-1" type="password" name="password" id="password" required>
                <input class="btn btn-outline-primary m-1 float-right" type="submit" value="Sign-up" name="register_btn" id="register_btn">
            </form>
          </div>
        </div>
    </div>
    <script src="./Lib/js/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./Lib/bootstrap/js//bootstrap.min.js"></script>
    <script src="./assets/js/Ajax.js"></script>

</body>
</html>