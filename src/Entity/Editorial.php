<?php

namespace App\Entity;

use App\Repository\EditorialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EditorialRepository::class)
 */
class Editorial
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Fondo::class, mappedBy="editorial", orphanRemoval=true)
     */
    private $fondos;

    /**
     * @ORM\OneToMany(targetEntity=Fondo::class, mappedBy="edit")
     */
    private $fond;

    public function __construct()
    {
        $this->fondos = new ArrayCollection();
        $this->fond = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection|Fondo[]
     */
    public function getFondos(): Collection
    {
        return $this->fondos;
    }

    public function addFondo(Fondo $fondo): self
    {
        if (!$this->fondos->contains($fondo)) {
            $this->fondos[] = $fondo;
            $fondo->setEditorial($this);
        }

        return $this;
    }

    public function removeFondo(Fondo $fondo): self
    {
        if ($this->fondos->removeElement($fondo)) {
            // set the owning side to null (unless already changed)
            if ($fondo->getEditorial() === $this) {
                $fondo->setEditorial(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fondo[]
     */
    public function getFond(): Collection
    {
        return $this->fond;
    }

    public function addFond(Fondo $fond): self
    {
        if (!$this->fond->contains($fond)) {
            $this->fond[] = $fond;
            $fond->setEdit($this);
        }

        return $this;
    }

    public function removeFond(Fondo $fond): self
    {
        if ($this->fond->removeElement($fond)) {
            // set the owning side to null (unless already changed)
            if ($fond->getEdit() === $this) {
                $fond->setEdit(null);
            }
        }

        return $this;
    }
}
