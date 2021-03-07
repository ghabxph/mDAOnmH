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

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="/create-news.php">Create Article</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-2 mx-auto">

                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="newsTitle">Title</label>
                        <input type="text" class="form-control" id="newsTitle" placeholder="Awesome Title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="newContent">Content</label>
                        <textarea class="form-control" id="newContent" rows="15" name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="newContent">Content Type</label>
                        <select class="form-control" id="contentType" name="type">
                            <option>Government</option>
                            <option>Food</option>
                            <option>Sports</option>
                            <option>Places</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" id="validatedCustomFile" name="file">
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-outline-danger" href="/index.php">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <footer class="py-5 bg-dark mt-4">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; 2020</p>
        </div>
    </footer>
</body>
</html>
