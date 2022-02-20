<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Valeur
 *
 * @ORM\Table(name="valeur", indexes={@ORM\Index(name="id_capteur", columns={"id_capteur"})})
 * @ORM\Entity
 */
class Valeur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_valeur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idValeur;

    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float", precision=10, scale=0, nullable=false)
     */
    private $valeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure", type="datetime", nullable=false)
     */
    private $dateHeure;

    /**
     * @var \Capteur
     *
     * @ORM\ManyToOne(targetEntity="Capteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_capteur", referencedColumnName="id_capteur")
     * })
     */
    private $idCapteur;

    public function getIdValeur(): ?int
    {
        return $this->idValeur;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTimeInterface $dateHeure): self
    {
        $this->dateHeure = $dateHeure;

        return $this;
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


}
