<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/master.css" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <link href="https://vjs.zencdn.net/7.8.4/video-js.css" rel="stylesheet" />
        <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a id="streamfoo" class="navbar-brand" href="../index.php">Streamfoo</a>
                </div>
                <div class="form-inline my-2 my-lg-0">
                    <a class="nav-link" href="../videos.php">All videos</a>
                    <a class="btn btn-primary my-2 my-sm-0">Login</a>
                </div>
            </nav>
        </header>
        <?php
        if($_FILES["file"]["name"] != ''){
            if ($_FILES["file"]["name"] <= 104857600) {
                $n=8;
                function getRandomString($n) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomString = '';

                    for ($i = 0; $i < $n; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }

                    return $randomString;
                }
                $nb = getRandomString($n);
                $test = explode('.', $_FILES["file"]["name"]);
                $ext = end($test);
                $name = $nb . '.' . $ext;
                //$namePoster = $nb.'.png';
                $location = $name;
                move_uploaded_file($_FILES["file"]["tmp_name"], $location);
                $con = new PDO('mysql:host=localhost;dbname=videos', 'root', '');
                $insert_video = $con->prepare("INSERT INTO `videos` (`name`,`short_name`) VALUES ('$location','$nb')");
                $insert_video->execute();
                $con = null;
        ?>
        <div style="margin-top:50px;"></div>
        <a href="../watch.php?v=<?php echo $nb;?>">
            <video id="my-video" class="video-js" controls preload="auto" width="640" height="264" data-setup="{}" style="margin-left:auto;margin-right:auto;">
                <source src="<?php echo $nb;?>.mp4" type="video/mp4">
            </video>
        </a>
        <div style="width: 45%;margin: auto;text-align: center;margin-top: 25px;padding: 5px;background: #006600;color: #fff;border-radius: 3px;">Video added</div>
        <?php
            }else{
                header("Location: index.php?err=ftb");
                exit();
            }
        }else{
            header("Location: index.php?err=nf");
            exit();
        }
        ?>
        <script src="https://vjs.zencdn.net/7.8.4/video.js"></script>
    </body>
</html>