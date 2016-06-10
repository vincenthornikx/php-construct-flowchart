<?php

namespace Ikal\PhpFlowchart\Element;

abstract class AbstractNode
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var NodeConnection[]
     */
    protected $exitConnections = [];

    /**
     * @return NodeConnection[]|NodeConnection
     */
    abstract public function execute();

    /**
     * @param NodeConnection $connection
     *
     * @return $this
     */
    public function addExitConnection($connection)
    {
        $this->exitConnections[] = $connection;

        return $this;
    }

    /**
     * @return NodeConnection[]
     */
    public function getExitConnections()
    {
        return $this->exitConnections;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}