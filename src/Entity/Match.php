<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 * @ORM\Table(name="match_game")
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
     * @ORM\JoinColumn(name="queue", nullable=false)
     */
    private $queue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Table", inversedBy="match")
     * @ORM\JoinColumn(name="winner", nullable=true)
     */
    private $winner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Table", inversedBy="homeMatch")
     * @ORM\JoinColumn(name="home", nullable=false)
     */
    private $home;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Table", inversedBy="awayMatch")
     * @ORM\JoinColumn(name="away", nullable=false)
     */

    private $away;

    /**
     * @ORM\Column(name="score_home", type="integer", nullable=true)
     */
    private $scoreHome;

    /**
     * @ORM\Column(name="score_away", type="integer", nullable=true)
     */
    private $scoreAway;

    /**
     * @ORM\Column(name="goals_home", type="integer", nullable=true)
     */
    private $goalsHome;

    /**
     * @ORM\Column(name="goals_away", type="integer", nullable=true)
     */
    private $goalsAway;

    /**
     * @ORM\OneToMany(targetEntity="MatchType", mappedBy="matchGame")
     */
    private $matchTypes;

    /**
     * Match constructor.
     *
     */
    public function __construct()
    {
        $this->matchTypes = new ArrayCollection();
    }

    public function __toString()
    {
        return 'Mecz '.$this->getHome() .' - '. $this->getAway();
    }

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

    /**
     * @return mixed
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @param mixed $winner
     * @return Match
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * @param mixed $home
     * @return Match
     */
    public function setHome($home)
    {
        $this->home = $home;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAway()
    {
        return $this->away;
    }

    /**
     * @param mixed $away
     * @return Match
     */
    public function setAway($away)
    {
        $this->away = $away;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScoreHome()
    {
        return $this->scoreHome;
    }

    /**
     * @param mixed $scoreHome
     * @return Match
     */
    public function setScoreHome($scoreHome)
    {
        $this->scoreHome = $scoreHome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScoreAway()
    {
        return $this->scoreAway;
    }

    /**
     * @param mixed $scoreAway
     * @return Match
     */
    public function setScoreAway($scoreAway)
    {
        $this->scoreAway = $scoreAway;
        return $this;
    }

    /**
     * @return Collection|MatchType[]
     */
    public function getMatchTypes(): Collection
    {
        return $this->matchTypes;
    }

    /**
     * @param User $user
     * @return |null
     */
    public function getMatchTypesByUser(User $user)
    {
        $criteria = Criteria::create()
            ->andWhere(Criteria::expr()->eq('user', $user));

        $matchType = $this->getMatchTypes()->matching($criteria)->first();

        if($matchType instanceof MatchType) {
            return $matchType;
        }
        return null;
    }

    public function addMatchType(MatchType $matchType): self
    {
        if (!$this->matchTypes->contains($matchType)) {
            $this->matchTypes[] = $matchType;
            $matchType->setMatchGame($this);
        }

        return $this;
    }

    public function removeMatchType(MatchType $matchType): self
    {
        if ($this->matchTypes->contains($matchType)) {
            $this->matchTypes->removeElement($matchType);
            // set the owning side to null (unless already changed)
            if ($matchType->getMatchGame() === $this) {
                $matchType->setMatchGame(null);
            }
        }

        return $this;
    }
}
