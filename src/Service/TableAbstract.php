<?php

namespace App\Service;

use App\Entity\Season;
use App\Entity\Table;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

abstract class TableAbstract
{
    /**
     * @var int $points
     */
    private $points = 0;

    /**
     * @var int $place
     */
    private $place;

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param PersistentCollection $matchTypes
     * @return int
     */
    public function setPoints(PersistentCollection $matchTypes): int
    {
        foreach ($matchTypes as $matchType) {
            
        }

        return $this->points;
    }

    /**
     * @return int
     */
    public function getPlace(): int
    {
        return $this->place;
    }

    /**
     * @param int $place
     * @return TableAbstract
     */
    public function setPlace(int $place): TableAbstract
    {
        $this->place = $place;
        return $this;
    }
}