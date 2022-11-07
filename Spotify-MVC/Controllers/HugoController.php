<?php

namespace App\Controllers;

use App\Entity\Artist;

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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=".$artistName."&type=artist");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);
        $artists = [];

        foreach ($result->artists->items as $res){
            $artist = new Artist($res->id,$res->name,$res->followers->total,$res->genres,$res->external_urls->spotify,$res->images[0]->url ?? 'test');
//            $artist = ['id' => $res->id,'name' => $res->name,'followers' => $res->followers->total,'genders' => $res->genres,'link' => $res->external_urls->spotify,'picture'=>$res->images[0]->url];
            $artists[] = $artist;

        }

        $this->render('hugo/index',compact('artists'));
    }


    public function artist(){

        $artistName = $_POST['artistName'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/".$artistName);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/".$artistName.'/top-tracks?market=FR');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $albums = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result);
        var_dump($albums);


        $artist = new Artist($result->id,$result->name,$result->followers->total,$result->genres,$result->external_urls->spotify,$result->images[0]->url ?? 'test');

        $this->render('hugo/search',['artist' => $artist,'albums' => $albums]);
    }
}