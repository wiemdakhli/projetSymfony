<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValeurCapteur
 *
 * @ORM\Table(name="valeur_capteur", indexes={@ORM\Index(name="id_capteur", columns={"id_capteur"}), @ORM\Index(name="id_valeur", columns={"id_valeur"})})
 * @ORM\Entity
 */
class ValeurCapteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_val_cap", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idValCap;

    /**
     * @var \Capteur
     *
     * @ORM\ManyToOne(targetEntity="Capteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_capteur", referencedColumnName="id_capteur")
     * })
     */
    private $idCapteur;

    /**
     * @var \Valeur
     *
     * @ORM\ManyToOne(targetEntity="Valeur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_valeur", referencedColumnName="id_valeur")
     * })
     */
    private $idValeur;

    public function getIdValCap(): ?int
    {
        return $this->idValCap;
    }

    public function getIdCapteur(): ?Capteur
    {
        return $this->idCapteur;
    }

    public function setIdCapteur(?Capteur $idCapteur): self
    {
        $this->idCapteur = $idCapteur;

        return $this;
    }

    public function getIdValeur(): ?Valeur
    {
        return $this->idValeur;
    }

    public function setIdValeur(?Valeur $idValeur): self
    {
        $this->idValeur = $idValeur;

        return $this;
    }


}
