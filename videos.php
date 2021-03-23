<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/master.css" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <link href="https://vjs.zencdn.net/7.8.4/video-js.css" rel="stylesheet" />
        <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a id="streamfoo" class="navbar-brand" href="index.php">Streamfoo</a>
                </div>
                <div class="form-inline my-2 my-lg-0">
                    <a class="nav-link" href="videos.php">All videos</a>
                </div>
            </nav>
        </header>
        <main>
            <article>
                <section>
                    <?php
                    $con = new PDO('mysql:host=localhost;dbname=videos', 'root', '');
                    $get_videos = $con->prepare("SELECT `name`, `short_name` FROM `videos`");
                    $get_videos->execute();
                    $fetch_videos = $get_videos->fetchAll();
                    $con = null;
                    for ($i=0; $i < sizeof($fetch_videos); $i++) { 
                    ?>
                    <a href="watch.php?v=<?php echo $fetch_videos[$i][`short_name`];?>">
                        <video id="my-video" class="video-js" controls autoplay preload="auto" width="640" height="264" data-setup="{}" src="videos/<?php echo $fetch_videos[$i]['name']; ?>">
                            <source src="<?php echo $fetch_videos[$i][`name`];?>" type="video/mp4">
                        </video>
                    </a>
                    <?php
                    }
                    ?>
                </section>
            </article>
        </main>
    </body>
</html>