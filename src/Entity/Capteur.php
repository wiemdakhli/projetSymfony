<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Capteur
 *
 * @ORM\Table(name="capteur", indexes={@ORM\Index(name="ref", columns={"ref"})})
 * @ORM\Entity
 */
class Capteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_capteur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCapteur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="seuilMin", type="float", precision=10, scale=0, nullable=false)
     */
    private $seuilmin;

    /**
     * @var float
     *
     * @ORM\Column(name="seuilMax", type="float", precision=10, scale=0, nullable=false)
     */
    private $seuilmax;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \Intervalle
     *
     * @ORM\ManyToOne(targetEntity="Intervalle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref", referencedColumnName="id_intervalle")
     * })
     */
    private $ref;

    public function getIdCapteur(): ?int
    {
        return $this->idCapteur;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSeuilmin(): ?float
    {
        return $this->seuilmin;
    }

    public function setSeuilmin(float $seuilmin): self
    {
        $this->seuilmin = $seuilmin;

        return $this;
    }

    public function getSeuilmax(): ?float
    {
        return $this->seuilmax;
    }

    public function setSeuilmax(float $seuilmax): self
    {
        $this->seuilmax = $seuilmax;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRef(): ?Intervalle
    {
        return $this->ref;
    }

    public function setRef(?Intervalle $ref): self
    {
        $this->ref = $ref;

        return $this;
    }


}
