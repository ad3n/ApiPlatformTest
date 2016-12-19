<?php

namespace AppBundle\ActionLogger;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
trait ActionLoggable
{
    /**
     * @var string
     */
    protected $createdBy;

    /**
     * @var string
     */
    protected $updatedBy;

    /**
     * Returns createdBy value.
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Returns updatedBy value.
     *
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param string $createdBy
     *
     * @return $this
     */
    public function setCreatedBy(string $createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @param string $updatedBy
     *
     * @return $this
     */
    public function setUpdatedBy(string $updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }
}
