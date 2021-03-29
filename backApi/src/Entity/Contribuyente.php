<?php



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


}
