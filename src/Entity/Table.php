<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TableRepository")
 * @ORM\Table(name="league_table")
 */
class Table
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="leagueTable")
     * @ORM\JoinColumn(name="season", nullable=false)
     */
    private $season;

    /**
     * @ORM\Column(name="club", type="string", length=255)
     */
    private $club;

    /**
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @ORM\Column(name="place", type="integer")
     */
    private $place;

    /**
     * @ORM\Column(name="matches", type="integer")
     */
    private $matches;

    /**
     * @ORM\Column(name="wins", type="integer")
     */
    private $wins;

    /**
     * @ORM\Column(name="draws", type="integer")
     */
    private $draws;

    /**
     * @ORM\Column(name="lost", type="integer")
     */
    private $lost;

    /**
     * @ORM\Column(name="scored_goals", type="integer")
     */
    private $scoredGoals;

    /**
     * @ORM\Column(name="lost_goals", type="integer")
     */
    private $lostGoals;

    /**
     * @ORM\Column(name="difference_goals", type="integer")
     */
    private $differenceGoals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Match", mappedBy="winner", cascade={"persist", "remove"})
     */
    private $match;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Match", mappedBy="home", cascade={"persist", "remove"})
     */
    private $homeMatch;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Match", mappedBy="away", cascade={"persist", "remove"})
     */
    private $awayMatch;

    public function __toString()
    {
        return $this->getClub();
    }

    /**
     * @return mixed
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param mixed $match
     * @return Table
     */
    public function setMatch($match)
    {
        $this->match = $match;
        return $this;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(Season $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getClub(): ?string
    {
        return $this->club;
    }

    public function setClub(string $club): self
    {
        $this->club = $club;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getMatches(): ?int
    {
        return $this->matches;
    }

    public function setMatches(int $matches): self
    {
        $this->matches = $matches;

        return $this;
    }

    public function getWins(): ?int
    {
        return $this->wins;
    }

    public function setWins(int $wins): self
    {
        $this->wins = $wins;

        return $this;
    }

    public function getDraws(): ?int
    {
        return $this->draws;
    }

    public function setDraws(int $draws): self
    {
        $this->draws = $draws;

        return $this;
    }

    public function getLost(): ?int
    {
        return $this->lost;
    }

    public function setLost(int $lost): self
    {
        $this->lost = $lost;

        return $this;
    }

    public function getScoredGoals(): ?int
    {
        return $this->scoredGoals;
    }

    public function setScoredGoals(int $scoredGoals): self
    {
        $this->scoredGoals = $scoredGoals;

        return $this;
    }

    public function getLostGoals(): ?int
    {
        return $this->lostGoals;
    }

    public function setLostGoals(int $lostGoals): self
    {
        $this->lostGoals = $lostGoals;

        return $this;
    }

    public function getDifferenceGoals(): ?int
    {
        return $this->differenceGoals;
    }

    public function setDifferenceGoals(int $differenceGoals): self
    {
        $this->differenceGoals = $differenceGoals;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHomeMatch()
    {
        return $this->homeMatch;
    }

    /**
     * @param mixed $homeMatch
     * @return Table
     */
    public function setHomeMatch($homeMatch)
    {
        $this->homeMatch = $homeMatch;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAwayMatch()
    {
        return $this->awayMatch;
    }

    /**
     * @param mixed $awayMatch
     * @return Table
     */
    public function setAwayMatch($awayMatch)
    {
        $this->awayMatch = $awayMatch;
        return $this;
    }


}
