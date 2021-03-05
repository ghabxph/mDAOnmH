<?php
    $sql = "SELECT * FROM blog ORDER BY created_at DESC;";
    if (trim($_GET['filter']) !== '') {
        $sql = 'SELECT * FROM blog WHERE type="'.$_GET['filter'].'" ORDER BY created_at DESC;';
    }
    $connection = mysqli_connect("localhost", "root", "", "exam");
    $res = mysqli_query($connection, $sql);
    $blogs = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $blogs[] = $row;
    }
    mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Optimy Exam</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery-3.5.0.js"></script>
    <script src="js/bootstrap.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="/index.php">Articles</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?filter=government">Government</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?filter=sports">Sports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?filter=food">Food</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link btn btn-success" href="/create-news.php">Create</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row text-center">
            <?php if (empty($blogs)) { ?>
                <header class="jumbotron mt-4 mx-auto mb-12">
                    <h1 class="display-3">Oops no entry for this type!</h1>
                    <a class="btn btn-primary btn-lg mt-4" href="/create-news.php">Create Article</a>
                </header>
            <?php } ?>
            <?php foreach ($blogs as $blog) { ?>
            <div class="col-lg-3 col-md-6 mb-4 mt-2">
                <div class="card h-100">
                    <img class="card-img-top" src="uploads/<?=$blog['filename']?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?=$blog['title']?></h4>
                        <p class="card-text" style="text-overflow:ellipsis; max-height: 200px; overflow:hidden"><?=$blog['content']?></p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary">Find Out More!</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; 2020</p>
        </div>
    </footer>
</body>
</html>
