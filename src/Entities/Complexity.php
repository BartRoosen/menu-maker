<?php


namespace Entities;


class Complexity
{
    /** @var int */
    private $complexityId;

    /** @var string */
    private $complexityName;

    /** @var bool */
    private $complexityDeleted;

    /**
     * @return int
     */
    public function getComplexityId()
    {
        return $this->complexityId;
    }

    /**
     * @param int $complexityId
     */
    public function setComplexityId($complexityId)
    {
        $this->complexityId = $complexityId;
    }

    /**
     * @return string
     */
    public function getComplexityName()
    {
        return $this->complexityName;
    }

    /**
     * @param string $complexityName
     */
    public function setComplexityName($complexityName)
    {
        $this->complexityName = $complexityName;
    }

    /**
     * @return bool
     */
    public function isComplexityDeleted()
    {
        return $this->complexityDeleted;
    }

    /**
     * @param bool $complexityDeleted
     */
    public function setComplexityDeleted($complexityDeleted)
    {
        $this->complexityDeleted = $complexityDeleted;
    }
}
