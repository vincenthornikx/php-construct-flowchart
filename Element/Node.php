<?php


namespace Ikal\PhpFlowchart\Element;


abstract class Node
{

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
}