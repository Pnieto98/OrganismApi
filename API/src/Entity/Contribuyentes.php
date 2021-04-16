<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contribuyentes
 *
 * @ORM\Table(name="contribuyentes")
 * @ORM\Entity
 */
class Contribuyentes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=40, nullable=false)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="Dni", type="integer", nullable=false)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="Mail", type="string", length=50, nullable=false)
     */
    private $mail;
    /**
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Comercio", mappedBy="idContribuyente")
     */
    private $dueda_comercio;
    public function __construct()
    {
        $this->dueda_comercio = new ArrayCollection();
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

    public function getDni(): ?int
    {
        return $this->dni;
    }

    public function setDni(int $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }


}
