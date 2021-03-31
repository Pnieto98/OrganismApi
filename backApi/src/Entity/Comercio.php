<?php

namespace App\Entity;

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
     * @var float
     *
     * @ORM\Column(name="saldo", type="float", precision=10, scale=0, nullable=false)
     */
    private $saldo;

    /**
     * @var string
     *
     * @ORM\Column(name="periodo", type="string", length=10, nullable=false)
     */
    private $periodo;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencimiento", type="date", nullable=false)
     */
    private $vencimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

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

    public function getSaldo(): ?float
    {
        return $this->saldo;
    }

    public function setSaldo(float $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getPeriodo(): ?string
    {
        return $this->periodo;
    }

    public function setPeriodo(string $periodo): self
    {
        $this->periodo = $periodo;

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

    public function getVencimiento(): ?\DateTimeInterface
    {
        return $this->vencimiento;
    }

    public function setVencimiento(\DateTimeInterface $vencimiento): self
    {
        $this->vencimiento = $vencimiento;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
