<?php

namespace App\Entity;

class Artist
{

    public function __construct(
        public string $id,

        public string $name,

        public int    $followers,

        public array  $genders,

        public string $link,

        public string|null $picture,
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setFollowers(int $followers): self
    {
        $this->followers = $followers;
        return $this;
    }

    public function getFollowers(): int
    {
        return $this->followers;
    }

    public function getGenders(): array
    {
        return $this->genders;
    }

    public function setGenders(array $genders): self
    {
        $this->genders = $genders;
        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }


    public function getPicture(): string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function display(){

        $genre='';
        foreach ($this->genders as $genre){
            if($genre != ''){
                $genre = '<p Class="card-text"> '.$genre.'</p>'.$genre;
            }
        }
        $link = '';
        if ($this->getPicture() != 'test'){
            $picture = $this->getPicture();
        }else{

            $picture = 'https://medias.slash-paris.com/media_attachments/images/000/029/359/carre_noir_blackout_tuesday_art-1_medium.jpg?1591355942';
        }

        $html = '<div Class="card col-md-8" style="width: 18rem;">
                <img src='.$picture.' Class="card-img-top" alt="...">
                <div Class="card-body">
                    <h5 Class="card-title">'.$this->getName().' </h5>
                    <p Class="card-text"> Genre : '. $genre.'</p>
             <p Class="card-text"> Nombre de followers : '.$this->getFollowers().'</p>
                    <form action="http://localhost:8000/hugo/artist" method="POST">
                        <input type="text" id="artist" name="artistName" value='.$this->getId().' hidden><br>
                        <input type="submit" name="submit" value="Détails">
                    </form>
                </div>
              </div>
        ';
        return $html;
    }
}