<?php

namespace App\Controllers;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Music;

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


    public function artist(){

        $artistName = $_POST['artistName'];

        #region data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/".$artistName);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $result = json_decode($result);

        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/".$artistName.'/albums?market=FR');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $albums = curl_exec($ch);
        curl_close($ch);

        $albums = json_decode($albums);
        #endregion


        $artist = new Artist($result->id,$result->name,$result->followers->total,$result->genres,$result->external_urls->spotify,$result->images[0]->url ?? 'test');

        $albumList = [];

        foreach ($albums->items as $res){
            $album = new Album($res->id,$res->name,$artist,$res->album_group,$res->album_type,$res->images[0]->url ?? 'test',$res->external_urls->spotify,$res->release_date);
            $albumList[] = $album;
        }

        $this->render('hugo/search',['artist' => $artist,'albums' => $albumList]);
    }


    public function track(){

        $albumName = $_POST['albumName'];

        #region data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/albums/". $albumName."?market=FR");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $result = json_decode($result);

        curl_close($ch);

        #endregion

        $tracks = [];
        foreach ($result->tracks->items as $res){
            $track = new Music($res->id,$res->name,$res->type,$res->external_urls->spotify,$res->track_number);
            $tracks[] = $track;
        }

        $this->render('hugo/tracks',['tracks' => $tracks]);
    }
}