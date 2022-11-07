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
        $genres =[];
        foreach ($this->genders as $genre){
            $genres = '<p Class="card-text"> '.$genre.'</p>';
        }
        if ($this->getPicture()){
            $picture = $this->getPicture();
        }else{
            $picture = 'https://www.google.com/url?sa=i&url=https%3A%2F%2Ffr.depositphotos.com%2Fstock-photos%2Fundefined.html&psig=AOvVaw0QJihFKVZ0090Tr6vqulSy&ust=1667898806923000&source=images&cd=vfe&ved=0CAkQjRxqFwoTCKCK9tbcm_sCFQAAAAAdAAAAABAE';
        }
        $html = '<div Class="card col-md-8" style="width: 18rem;">
                <img src='.$picture.' Class="card-img-top" alt="...">
                <div Class="card-body">
                    <h5 Class="card-title">'.$this->getName().' </h5>
                    <p Class="card-text"> Genre : '. '</p>
             <p Class="card-text"> Nombre de followers : '.$this->getFollowers().'</p>
                    <a href='.$this->getLink().' Class="btn btn-primary">Détails</a>
                </div>
              </div>
        ';
        return $html;
    }
}