<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="#">LMS</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <?php
        if(isset($_SESSION['username']) && !empty($_SESSION['username']) || (isset($_COOKIE['user_id']))){
        ?>
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
            </li>
        <?php }
        else {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="./login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./register.php">Register</a>
            </li>
            <?php }?>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="#">Action 1</a>
                    <a class="dropdown-item" href="#">Action 2</a>
                </div>
            </li> -->
        </ul>

        <?php
        if(isset($_SESSION['username']) && !empty($_SESSION['username']) || (isset($_COOKIE['user_id']))){

        
        ?>
        <ul class="navbar-nav mt-2 mt-lg-0 float-right">
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else if(isset($_COOKIE['user_name'])){echo $_COOKIE['user_name'];} ?></a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="./settings.php">Settings</a>
                    <a class="dropdown-item text-danger" href="#" data-value="<?php if(isset($_SESSION['userid'])){echo $_SESSION['userid'];} else if(isset($_COOKIE['user_id'])){echo $_COOKIE['user_id'];} ?>" id="logout_btn">Logout</a>
                </div>
            </li>
        <?php } else {
            ?>    
        <li class="nav-item dropdown list-unstyled">
            <a class="btn btn-outline-primary" href="./login.php">Login</a>
        </li>
        <?php }?>
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
    </div>
</nav>