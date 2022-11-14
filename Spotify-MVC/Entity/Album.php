<?php

namespace App\Entity;

class Album extends Model
{
    public int $id;
    public function __construct(
        public string $idSpotify,

        public string $name,

        public Artist $artist,

        public string  $group,

        public string $type,

        public string|null $picture,

        public string $link,

        public string $date,


    )
    {
        $this->table = 'album';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Artist
     */
    public function getArtist(): Artist
    {
        return $this->artist;
    }

    /**
     * @param Artist $artist
     */
    public function setArtist(Artist $artist): void
    {
        $this->artist = $artist;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     */
    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->idSpotify;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->idSpotify = $id;
    }

    public function display(){

        if ($this->getPicture() != 'test'){
            $picture = $this->getPicture();
        }else{

            $picture = 'https://medias.slash-paris.com/media_attachments/images/000/029/359/carre_noir_blackout_tuesday_art-1_medium.jpg?1591355942';
        }

        $html = '<div Class="card col-md-8" style="width: 18rem;">
                <img src='.$picture.' Class="card-img-top" alt="...">
                <div Class="card-body">
                    <h5 Class="card-title">'.$this->getName().' </h5>
                    <p Class="card-text"> Artiste : '. $this->getArtist()->getName().'</p>
             <p Class="card-text"> Date de sortie : '.$this->getDate().'</p>
             <form action="http://localhost:8000/track/track" method="POST">
                 <input type="text" id="album" name="albumName" value='.$this->getId().' hidden><br>
                 <input type="submit" name="submit" value="Détails">
             </form>
                </div>
              </div>
        ';
        return $html;
    }
}