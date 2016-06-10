<?php


namespace Ikal\PhpFlowchart\Element\Node\Type;

use Ikal\PhpFlowchart\Element\Node;

class End extends Node
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