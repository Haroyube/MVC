<?php

namespace App\Controllers;

use App\Entity\Track;
use App\Entity\Album;

class TrackController extends Controller
{

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
            $track = new Track($res->id,$res->name,$res->type,$res->external_urls->spotify,$res->track_number);
            $tracks[] = $track;
        }

        $this->render('track/tracks',['tracks' => $tracks]);
    }

    public function favoriteTrack(){
        $track = new Track("","","","",0);

        $tracks = [];
        foreach ($track->findAll() as $res){

            $tracks[] = $res;
        }
        $this->render('track/favoriteTracks',['tracks' => $tracks]);
    }

    public function saveTrack(){
        $trackName = $_POST['trackName'];

        #region data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/tracks/"."$trackName");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);
        #endregion


        $track = new Track($result->id,$result->name,$result->type,$result->external_urls->spotify,$result->track_number);

        if (!$track->findBy(['idSpotify'=> $result->id])){
            $track->create();
        }
        $tracks = [];

        foreach ($track->findAll() as $res){
            $tracks[] = $res;
        }


        $this->render('track/favoriteTracks',['tracks' => $tracks]);
    }

    public function deleteTrack(){
        $trackName = $_POST['trackName'];

        #region data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/tracks/"."$trackName");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);
        #endregion

        $track = new Track($result->id,$result->name,$result->type,$result->external_urls->spotify,$result->track_number);

        $track->delete($track->findBy(['idSpotify' => $result->id])[0]->id);
        $tracks = [];

        foreach ($track->findAll() as $res){
            $tracks[] = $res;
        }

        $this->render('track/favoriteTracks',['tracks' => $tracks]);
    }
}