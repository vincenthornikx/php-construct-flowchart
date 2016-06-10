<?php


namespace Ikal\PhpFlowchart\Element;


use Ikal\PhpFlowchart\Element\Node\Type\Start;

class Configuration
{

    protected $initDone = false;

    public function init()
    {
        if ($this->initDone) {
            return;
        }

        $this->initDone = true;
    }

    /**
     * @return Start{}|Start
     */
    public function getStartNode()
    {

    }
}