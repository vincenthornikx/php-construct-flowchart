<?php

namespace Ikal\PhpFlowchart\Element\Node\Type;

use Ikal\PhpFlowchart\Element\AbstractNode;

class End extends AbstractNode
{

    /**
     * End node must return empty array
     *
     * @return array
     */
    final public function execute()
    {
        return [];
    }
}