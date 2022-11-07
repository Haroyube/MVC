<?php

namespace App\Controllers;

use App\Entity\Artist;

class HugoController extends Controller
{
    public function index()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=orelsan&type=artist");
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

    public function search()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=orelsan&type=artist");
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

        $this->render('hugo/search',compact('artists'));
    }
}