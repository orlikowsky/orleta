<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Queue", inversedBy="matches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $queue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goalsHome;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goalsAway;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQueue(): ?Queue
    {
        return $this->queue;
    }

    public function setQueue(?Queue $queue): self
    {
        $this->queue = $queue;

        return $this;
    }

    public function getGoalsHome(): ?int
    {
        return $this->goalsHome;
    }

    public function setGoalsHome(?int $goalsHome): self
    {
        $this->goalsHome = $goalsHome;

        return $this;
    }

    public function getGoalsAway(): ?int
    {
        return $this->goalsAway;
    }

    public function setGoalsAway(int $goalsAway): self
    {
        $this->goalsAway = $goalsAway;

        return $this;
    }
}
