<?php

namespace App\Controllers;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Track;

class HugoController extends Controller
{
    public function index()
    {
        if(isset($_POST['artistName'])){
            $artistName = $_POST['artistName'];
            $artistName = str_replace(' ','_', $artistName);
        }else{
            $artistName = 'powerwolf';
        }
        $artistName = ucfirst($artistName);
        #region data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=".$artistName."&type=artist");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);
        #endregion
        $artists = [];

        foreach ($result->artists->items as $res){
            $artist = new Artist($res->id,$res->name,$res->followers->total,$res->genres,$res->external_urls->spotify,$res->images[0]->url ?? 'test');
            $artists[] = $artist;

        }

        $this->render('hugo/index',compact('artists'));
    }

}