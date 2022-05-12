<?php

namespace App\Entity;

use App\Repository\ChildrensRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChildrensRepository::class)]
class Childrens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $additional;

    #[ORM\Column(type: 'string', length: 20)]
    private $age_range;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'childrens')]
    #[ORM\JoinColumn(nullable: false)]
    private $parent;

    #[ORM\ManyToMany(targetEntity: Activities::class, mappedBy: 'childrens')]
    private $activities;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdditional(): ?string
    {
        return $this->additional;
    }

    public function setAdditional(?string $additional): self
    {
        $this->additional = $additional;

        return $this;
    }

    public function getAgeRange(): ?string
    {
        return $this->age_range;
    }

    public function setAgeRange(string $age_range): self
    {
        $this->age_range = $age_range;

        return $this;
    }

    public function getParent(): ?Users
    {
        return $this->parent;
    }

    public function setParent(?Users $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, Activities>
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activities $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->addChildren($this);
        }

        return $this;
    }

    public function removeActivity(Activities $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            $activity->removeChildren($this);
        }

        return $this;
    }


}
