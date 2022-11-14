<?php


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<title>Document</title>
</head>
<body>



<div class="row">
    <?php

    foreach ($tracks as $res){
        $picture = 'https://medias.slash-paris.com/media_attachments/images/000/029/359/carre_noir_blackout_tuesday_art-1_medium.jpg?1591355942';
        echo '<div Class="card col-md-8" style="width: 18rem;">
                <img src='.$picture.' Class="card-img-top" alt="...">
                <div Class="card-body">
                    <h5 Class="card-title">'.$res->name.' </h5>
                    <p Class="card-text"> Numéro : '. $res->number.'</p>
                    <a href='.$res->link.' Class="btn btn-primary">Détails</a>
                    <form action="http://localhost:8000/hugo/deleteTrack" method="POST">
                        <input type="text" id="track" name="trackName" value='.$res->idSpotify.' hidden><br>
                        <input type="submit" name="submit" value="Supprimer des favoris">
                    </form>
              </div>
              </div>
        ';

    }

    ?>
</div>

</div>
</body>
</html>