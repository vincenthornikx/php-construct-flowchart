<?php


namespace Ikal\PhpFlowchart\Element;


class NodeConnection
{

    /**
     * @var Node
     */
    protected $fromNode;

    /**
     * @var Node
     */
    protected $toNode;

    /**
     * @param Node $fromNode
     * @param Node $toNode
     *
     * @return $this
     */
    public function connect($fromNode, $toNode)
    {
        $this->fromNode = $fromNode;
        $this->toNode = $toNode;

        return $this;
    }

    /**
     * @return Node
     */
    public function getFromNode()
    {
        return $this->fromNode;
    }

    /**
     * @param Node $fromNode
     *
     * @return $this
     */
    public function setFromNode($fromNode)
    {
        $this->fromNode = $fromNode;

        return $this;
    }

    /**
     * @return Node
     */
    public function getToNode()
    {
        return $this->toNode;
    }

    /**
     * @param Node $toNode
     *
     * @return $this
     */
    public function setToNode($toNode)
    {
        $this->toNode = $toNode;

        return $this;
    }
}