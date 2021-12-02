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
        <link rel="stylesheet" href="css/navStyle.css">
        <link rel="stylesheet" href="css/loginStyle.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script text="text/javascript" src="js/jQuery.js"></script>
        <script text="text/javascript" src="js/fadeIn.js"></script>
        <title>Collectrio!</title>
    </head>

    <body>
        <div class="justify-content-around">
            <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
                <img class="navbar-brand" src="imgs/logo.png" id="logo" />
                <p class="navbar-brand" id="titleNav">Collectrio</p>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav justify-content-around">
                        <li class="nav-item">
                            <a class="nav-link" href="nav.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <?php if (isset($_SESSION['admin']) && ($_SESSION['admin'] > 0 || $_SESSION['admin'] === true)) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="userList.php">User List</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="collection.php">Collection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="mainContent target">
            <?php if (isset($_SESSION['deleteRecord'])) { ?>
                <div class="col-12">
                    <div class="alert alert-success errorBox">
                        <p><?= $_SESSION['deleteRecord']; ?></p>
                    </div>
                </div>
            <?php }
            unset($_SESSION['deleteRecord']); ?>
                    <?php if (isset($_SESSION['updateGame'])) { ?>
                <div class="col-12">
                    <div class="alert alert-success errorBox">
                        <p><?= $_SESSION['updateGame']; ?></p>
                    </div>
                </div>
            <?php }
            unset($_SESSION['updateGame']); ?>
            <?php include 'db.php';
            $query = "SELECT * FROM user" . $_SESSION['id'] . "_roms";
            $result = mysqli_query($con, $query);
            if ($result !== false) { ?>
                <form action="collectionCrud/collectionSearchResult.php" method="post">
                    <input type="text" name="search" id="search" placeholder="Search by title">
                    <input type="submit" name="searchBtn" class="btn btn-success" value="Search">
                </form>
                <a href="createRecord.php">Insert new row</a>
                <table class="table table-bordered table-striped table-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Release Date</th>
                        <th scope="col">Developer</th>
                        <th scope="col">Platform</th>
                        <th scope="col">Rating (from 0 to 100)</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Edit</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $row['title']; ?></td>
                            <td><?= $row['genre']; ?></td>
                            <td><?= $row['releaseDate']; ?></td>
                            <td><?= $row['developer']; ?></td>
                            <td><?= $row['platform']; ?></td>
                            <td><?= $row['rating']; ?></td>
                            <td>
                                <form action="collectionCrud/deleteGame.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <input type="submit" name="delete" class="btn btn-danger" value="DELETE">
                                </form>
                            </td>
                            <td>
                                <form action="collectionCrud/updateGame.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <input type="hidden" name="title" value="<?= $row['title']; ?>">
                                    <input type="hidden" name="genre" value="<?= $row['genre']; ?>">
                                    <input type="hidden" name="releaseDate" value="<?= $row['releaseDate']; ?>">
                                    <input type="hidden" name="developer" value="<?= $row['developer']; ?>">
                                    <input type="hidden" name="platform" value="<?= $row['platform']; ?>">
                                    <input type="hidden" name="rating" value="<?= $row['rating']; ?>">
                                    <input type="submit" name="edit" class="btn btn-info" value="EDIT">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <div>
                    <p>No collection was found. Click <a href="collectionCrud/createCollection.php">here</a> to create one.</p>
                </div>
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
    <?= header("Location: login.php"); ?>
<?php } ?>

</html>