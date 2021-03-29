<?php

namespace App\Entity;
use App\Entity\Contribuyentes;
use Doctrine\ORM\Mapping as ORM;

/**
 * Comercio
 *
 * @ORM\Table(name="comercio", indexes={@ORM\Index(name="id_contribuyente", columns={"id_contribuyente"})})
 * @ORM\Entity
 */
class Comercio
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
     * @var int
     *
     * @ORM\Column(name="cuenta", type="integer", nullable=false)
     */
    private $cuenta;

    /**
     * @var int
     *
     * @ORM\Column(name="saldo", type="integer", nullable=false)
     */
    private $saldo;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '0';

    /**
     * @var \Contribuyentes
     *
     * @ORM\ManyToOne(targetEntity="Contribuyentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_contribuyente", referencedColumnName="id")
     * })
     */
    private $idContribuyente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCuenta(): ?int
    {
        return $this->cuenta;
    }

    public function setCuenta(int $cuenta): self
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    public function getSaldo(): ?int
    {
        return $this->saldo;
    }

    public function setSaldo(int $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIdContribuyente(): ?Contribuyentes
    {
        return $this->idContribuyente;
    }

    public function setIdContribuyente(?Contribuyentes $idContribuyente): self
    {
        $this->idContribuyente = $idContribuyente;

        return $this;
    }


}
