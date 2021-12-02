<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>

<?php if (isset($_SESSION['username'])) {
?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Risque' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <link rel="stylesheet" href="../css/navStyle.css">
        <link rel="stylesheet" href="../css/loginStyle.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script text="text/javascript" src="../js/jQuery.js"></script>
        <script text="text/javascript" src="../js/fadeIn.js"></script>
        <title>Collectrio!</title>
    </head>

    <body>
        <div class="justify-content-around">
            <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
                <img class="navbar-brand" src="../imgs/logo.png" id="logo" />
                <p class="navbar-brand" id="titleNav">Collectrio</p>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav justify-content-around">
                        <li class="nav-item">
                            <a class="nav-link" href="../nav.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../profile.php">Profile</a>
                        </li>
                        <?php if (isset($_SESSION['admin']) && ($_SESSION['admin'] > 0 || $_SESSION['admin'] === true)) { //check if logged in user has admin status
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../userList.php">User List</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../collection.php">Collection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="mainContent target">
            <?php if (isset($_SESSION['createUser'])) { ?>
                <div class="col-12">
                    <div class="alert alert-success errorBox">
                        <p><?= $_SESSION['createUser']; ?></p>
                    </div>
                </div>
            <?php }
            unset($_SESSION['createUser']); ?>
            <?php if (isset($_SESSION['deleteUser'])) { ?>
                <div class="col-12">
                    <div class="alert alert-success errorBox">
                        <p><?= $_SESSION['deleteUser']; ?></p>
                    </div>
                </div>
            <?php }
            unset($_SESSION['deleteUser']); ?>
            <?php if (isset($_SESSION['updateUser'])) { ?>
                <div class="col-12">
                    <div class="alert alert-success errorBox">
                        <p><?= $_SESSION['updateUser']; ?></p>
                    </div>
                </div>
            <?php }
            unset($_SESSION['updateUser']); ?>
            <a href="createUser.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Create New User</a>
            <?php include '../db.php';

            if (isset($_POST['search'])) {

                $query = "SELECT * FROM users WHERE NOT username='" . $_SESSION['username'] . "' AND username LIKE '" . $_POST['search'] . "'";
                $result = mysqli_query($con, $query);
                if (!mysqli_num_rows($result) > 0) { ?>
                    <div>
                        <p>No other users seem to be registered</p>
                    </div>
                <?php } else { ?>
                    <form action="userSearchResult.php" method="post">
                        <input type="text" name="search" id="search" placeholder="Search by username">
                        <input type="submit" name="searchBtn" class="btn btn-success" value="Search">
                    </form>
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Account created date</th>
                            <th scope="col">Admin?</th>
                            <th scope="col">Edit User</th>
                            <th scope="col">Delete User</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['trn_date'] ?></td>
                                <td><?php if ($row['admin'] > 0) { ?>
                                        <p>Yes</p>
                                    <?php } else { ?>
                                        <p>No</p>
                                    <?php } ?>
                                </td>
                                <td>
                                    <form action="updateUser.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <input type="text" name="username" placeholder="Username" value="<?php echo $row['username'] ?>">
                                        <input type="submit" name="edit" class="btn btn-info" value="EDIT">
                                    </form>
                                </td>
                                <td>
                                    <form action="deleteUser.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <input type="submit" name="delete" class="btn btn-danger" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } ?>
        </div>

        <div class="container">
            <footer class="py-3 my-4 bg-light">
                <p class="text-center text-info">By Kurtis Charlton (000759576), 2021 </p>
            </footer>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    </body>
<?php } else { ?>
    <?= header("Location: ../login.php"); ?>
<?php }
        } ?>

</html>