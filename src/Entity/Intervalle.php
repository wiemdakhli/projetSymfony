<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervalle
 *
 * @ORM\Table(name="intervalle")
 * @ORM\Entity
 */
class Intervalle
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_intervalle", type="string", length=11, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idIntervalle;

    /**
     * @var float
     *
     * @ORM\Column(name="rangMin", type="float", precision=10, scale=0, nullable=false)
     */
    private $rangmin;

    /**
     * @var float
     *
     * @ORM\Column(name="rangMax", type="float", precision=10, scale=0, nullable=false)
     */
    private $rangmax;

    public function getIdIntervalle(): ?string
    {
        return $this->idIntervalle;
    }

    public function getRangmin(): ?float
    {
        return $this->rangmin;
    }

    public function setRangmin(float $rangmin): self
    {
        $this->rangmin = $rangmin;

        return $this;
    }

    public function getRangmax(): ?float
    {
        return $this->rangmax;
    }

    public function setRangmax(float $rangmax): self
    {
        $this->rangmax = $rangmax;

        return $this;
    }


}
