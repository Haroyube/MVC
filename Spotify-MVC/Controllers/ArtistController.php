<?php

namespace App\Controllers;

use App\Entity\Album;
use App\Entity\Artist;

class ArtistController extends Controller
{

    public function searchArtist(){

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

        $this->render('artist/search',['artist' => $artist,'albums' => $albumList]);
    }

    public function favoriteArtist(){
        $artist = new Artist("","",0,[],"","");

        $artists = [];
        foreach ($artist->findAll() as $res){

            $artists[] = $res;
        }
        $this->render('artist/favoriteArtists',['artists' => $artists]);
    }
    public function saveArtist(){

        $artistName = $_POST['artistName'];

        #region data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/"."$artistName");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);
        #endregion

        $artist = new Artist($result->id,$result->name,$result->followers->total,$result->genres,$result->external_urls->spotify,$result->images[0]->url ?? 'test');
        if (!$artist->findBy(['idSpotify'=> $result->id])){
            $artist->create();
        }
        $artists = [];

        foreach ($artist->findAll() as $res){

            $artists[] = $res;
        }

        if (!$artist->findBy(['idSpotify'=> $result->id])){
            $artist->create();
        }

        $this->render('artist/favoriteArtists',['artists' => $artists]);
    }

    public function deleteArtist(){

        $artistName = $_POST['artistName'];

        #region data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/"."$artistName");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);
        #endregion

        $artist = new Artist($result->id,$result->name,$result->followers->total,$result->genres,$result->external_urls->spotify,$result->images[0]->url ?? 'test');

        $artist->delete($artist->findBy(['idSpotify' => $result->id])[0]->id);
        $artists = [];
        foreach ($artist->findAll() as $res){

            $artists[] = $res;
        }

        $this->render('artist/favoriteArtists',['artists' => $artists]);
    }
}