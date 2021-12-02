<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>

<?php if (isset($_SESSION['username'])) {
    if (isset($_POST['edit'])) {
        $id = $_POST["id"];
        $title = $_POST["title"];
        $genre = $_POST["genre"];
        $releaseDate = $_POST["releaseDate"];
        $developer = $_POST["developer"];
        $platform = $_POST["platform"];
        $rating = $_POST["rating"];
    }
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
                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] > 0) { ?>
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
            <h1>Update Game</h1>
            <form action="updateGameProcess.php" method="post">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="text" name="title" placeholder="Title" value="<?= $title; ?>">
                <input type="text" name="genre" placeholder="Genre" value="<?= $genre; ?>">
                <input type="date" name="releaseDate" placeholder="Release Date" value="<?= $releaseDate; ?>">
                <input type="text" name="developer" placeholder="Developer" value="<?= $developer; ?>">
                <input type="text" name="platform" placeholder="Platform" value="<?= $platform; ?>">
                <input type="text" name="rating" placeholder="Rating" value="<?= $rating; ?>">
                <input type="submit" name="changeRec" class="btn btn-success" readonly value="Change record">
            </form>
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
<?php } ?>

</html>