<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipationChallengeRepository")
 * @ORM\Table(name="`participation_challenge`")
 */
class Participationchallenge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="id_challenge",type="integer")
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="Challenge")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_challenge", referencedColumnName="id")})
     */
    private $idChallenge;

    /**
     * @ORM\Column(name="id_client",type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max=8)
     */
    private $idClient;

    

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $etat;

    



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?string
    {
        return $this->idClient;
    }

    public function setIdClient(string $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdChallenge(): ?string
    {
        return $this->idChallenge;
    }

    public function setIdChallenge(string $idChallenge): self
    {
        $this->idChallenge = $idChallenge;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}







