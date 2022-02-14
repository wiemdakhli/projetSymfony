<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Valeur
 *
 * @ORM\Table(name="valeur")
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


}
