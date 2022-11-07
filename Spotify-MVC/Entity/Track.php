<?php

namespace App\Entity;

class Track extends Model
{
    public string $id;
    public function __construct(
        public int $idSpotify,

        public string $name,

        public string $type,

        public string $link,

        public int $number,


    )
    {
        $this->table = 'track';

    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }


    public function display(){
        $picture = 'https://medias.slash-paris.com/media_attachments/images/000/029/359/carre_noir_blackout_tuesday_art-1_medium.jpg?1591355942';
        $html = '<div Class="card col-md-8" style="width: 18rem;">
                <img src='.$picture.' Class="card-img-top" alt="...">
                <div Class="card-body">
                    <h5 Class="card-title">'.$this->getName().' </h5>
                    <p Class="card-text"> Numéro : '. $this->getNumber().'</p>
                    <a href='.$this->getLink().' Class="btn btn-primary">Détails</a>
              </div>
              </div>
        ';
        return $html;
    }
}