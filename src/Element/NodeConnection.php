<?php

namespace Ikal\PhpFlowchart\Element;

class NodeConnection
{

    /**
     * @var AbstractNode
     */
    protected $fromNode;
    /**
     * @var AbstractNode
     */
    protected $toNode;

    /**
     * @param AbstractNode $fromNode
     * @param AbstractNode $toNode
     *
     * @return $this
     */
    public function connectNodes($fromNode, $toNode)
    {
        $this->fromNode = $fromNode;
        $this->toNode = $toNode;

        $fromNode->addExitConnection($this);

        return $this;
    }

    /**
     * @return AbstractNode
     */
    public function getFromNode()
    {
        return $this->fromNode;
    }

    /**
     * @param AbstractNode $fromNode
     *
     * @return $this
     */
    public function setFromNode($fromNode)
    {
        $this->fromNode = $fromNode;

        return $this;
    }

    /**
     * @return AbstractNode
     */
    public function getToNode()
    {
        return $this->toNode;
    }

    /**
     * @param AbstractNode $toNode
     *
     * @return $this
     */
    public function setToNode($toNode)
    {
        $this->toNode = $toNode;

        return $this;
    }
}