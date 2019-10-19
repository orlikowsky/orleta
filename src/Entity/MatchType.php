<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchTypesRepository")
 * @ORM\Table(
 *     name="match_types",
 *     uniqueConstraints={@ORM\UniqueConstraint(columns={"user_id", "match_game_id"})}
 * )
 */
class MatchType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Match", inversedBy="matchTypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matchGame;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="matchTypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsHome;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsAway;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Table", inversedBy="matchTypes")
     * @ORM\JoinColumn(name="winner", nullable=true)
     */
    private $winner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatchGame(): ?Match
    {
        return $this->matchGame;
    }

    public function setMatchGame(?Match $matchGame): self
    {
        $this->matchGame = $matchGame;

        return $this;
    }

    public function getGoalsHome(): ?int
    {
        return $this->goalsHome;
    }

    public function setGoalsHome(int $goalsHome): self
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

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @param mixed $winner
     * @return MatchType
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;
        return $this;
    }


}
