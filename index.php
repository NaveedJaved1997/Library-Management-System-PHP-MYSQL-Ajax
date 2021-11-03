<?php require "./header.php"; 
if(!isset($_COOKIE['user_id']) && !isset($_SESSION['username'])){
    header('location: ./login.php');
}
// else
// if(!isset($_SESSION['username'])){
//     header('location: ./login.php');
//     // if(time()-$_SESSION["session_time"] > 60) 
//     // {
//     //     session_unset();
//     // }
//         // if (isset($_SESSION['session_time']) && (time() - $_SESSION['session_time'] > 60)) {
//         //     session_unset();     // unset $_SESSION variable for the run-time 
//         //     session_destroy();   // destroy session data in storage
//         // }
// }
    
?>
<title>Library Mangment System</title>
</head>

<body>
    <?php include "./nav.php" ?>
    <div class="container-fluid pt-3">
    <div id="alert_danger">

    </div>
    <div id="alert">
        
        </div>
        <div class="text-center p-2">
            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#AddModal">
                ADD NEW BOOK
            </button>
            <a class="btn btn-outline-danger m-1" href="./session_expire.php">DELETE SESSION</a>
        </div>
        <div class="row">

            <div class="col-md-8 offset-md-2">
                <table class="table table-bordered table-responsive-sm table-sm text-center">
                    <thead class="bg-primary text-white">
                        <th>SR#</th>
                        <th>Book Name</th>
                        <th>Book Authors</th>
                        <th>Edition</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </thead>
                    <tbody id="table">
                </table>
            </div>
        </div>
    </div>

    <!-- Add New Book Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-center">Add New Book</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form id="addBookForm" action="#" method="POST" enctype="multipart/form-data">
                            <label class="m-1" for="book_name"><b>Book Name</b></label>
                            <input class="form-control m-2" type="text" name="book_name" id="book_name" placeholder="Enter Book Name">
                            <label class="m-1" for="author_name"><b>Author Name</b></label>
                            <input class="form-control m-2" type="text" name="author_name" id="author_name" placeholder="Enter Author Name">
                            <label class="m-1" for="edition"><b>Edition</b></label>
                            <input class="form-control m-2" type="text" name="edition" id="edition" placeholder="Enter Volume / Edition">
                            <label class="m-1" for="imageupload"><b>Book Cover</b></label>
                            <input class="form-control-file m-2" type="file" name="imageupload" id="imageupload" accept="image/*">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-primary m-2 float-right" type="submit" value="Add Book" name="add_book" id="add_book">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Edit Modal Starts -->
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Update Book</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="card-body" class="card-body">
                    <form id="updateBookForm" action="#" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="edit_id" >
                    <input class="form-control m-2" type="text" name="book_name" id="edit_book_name" placeholder="Enter Book Name">
                    <input class="form-control m-2" type="text" name="author_name" id="edit_author_name" placeholder="Enter Author Name">
                    <input class="form-control m-2" type="text" name="edition" id="edit_edition" placeholder="Enter Volume / Edition" >
                   <label for="oldimage">Old Image</label>
                   <img id="oldimage" class="w-25" src="">
                    <!-- <input type="hidden" name="oldimage" id="oldimage"> -->
                   <input class="form-control-file m-2" type="file" name="imageupload2" id="imageupload2" accept="image/*">
                </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input class="btn btn-primary m-2 float-right" type="submit" value="Update" name="edit_book" id="update_btn">
                </div>
            </div>
        </div>
    </div>

<?php
require './footer.php';

?>