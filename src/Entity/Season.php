<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeasonRepository")
 * @ORM\Table(
 *     name="season",
 *     uniqueConstraints={@ORM\UniqueConstraint(columns={"current"})}
 * )
 */
class Season
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="season", type="string", length=10)
     */
    private $season;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Queue", mappedBy="season")
     */
    private $queues;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Table", mappedBy="season", cascade={"persist", "remove"})
     */
    private $leagueTable;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserTable", mappedBy="season")
     */
    private $userTables;

    /**
     * @ORM\Column(name="current", type="boolean", nullable=true)
     */
    private $current;

    public function __construct()
    {
        $this->queues = new ArrayCollection();
        $this->userTables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): self
    {
        $this->season = $season;

        return $this;
    }

    /**
     * @return Collection|Queue[]
     */
    public function getQueues(): Collection
    {
        return $this->queues;
    }

    public function addQueue(Queue $queue): self
    {
        if (!$this->queues->contains($queue)) {
            $this->queues[] = $queue;
            $queue->setSeason($this);
        }

        return $this;
    }

    public function removeQueue(Queue $queue): self
    {
        if ($this->queues->contains($queue)) {
            $this->queues->removeElement($queue);
            // set the owning side to null (unless already changed)
            if ($queue->getSeason() === $this) {
                $queue->setSeason(null);
            }
        }

        return $this;
    }

    public function getLeagueTable(): ?Table
    {
        return $this->leagueTable;
    }

    public function setLeagueTable(Table $leagueTable): self
    {
        $this->leagueTable = $leagueTable;

        // set the owning side of the relation if necessary
        if ($this !== $leagueTable->getSeason()) {
            $leagueTable->setSeason($this);
        }

        return $this;
    }

    /**
     * @return Collection|UserTable[]
     */
    public function getUserTables(): Collection
    {
        return $this->userTables;
    }

    public function addUserTable(UserTable $userTable): self
    {
        if (!$this->userTables->contains($userTable)) {
            $this->userTables[] = $userTable;
            $userTable->setSeason($this);
        }

        return $this;
    }

    public function removeUserTable(UserTable $userTable): self
    {
        if ($this->userTables->contains($userTable)) {
            $this->userTables->removeElement($userTable);
            // set the owning side to null (unless already changed)
            if ($userTable->getSeason() === $this) {
                $userTable->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @param mixed $current
     * @return Season
     */
    public function setCurrent($current)
    {
        $this->current = $current;
        return $this;
    }
}
