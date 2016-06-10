<?php

namespace Ikal\PhpFlowchart\Element\Node\Type;

use Ikal\PhpFlowchart\Element\AbstractNode;
use Ikal\PhpFlowchart\Element\NodeConnection;

abstract class Start extends AbstractNode
{

    /**
     * @return NodeConnection[]|NodeConnection
     */
    public function execute()
    {
        $this->setup();

        return $this->getExitConnections();
    }

    abstract public function setup();
}