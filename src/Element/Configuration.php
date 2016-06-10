<?php

namespace Ikal\PhpFlowchart\Element;

use Ikal\PhpFlowchart\Element\Configuration\AbstractLoader;
use Ikal\PhpFlowchart\Element\Configuration\Loader\Json;
use Ikal\PhpFlowchart\Element\Node\Type\Start;

class Configuration
{

    const TYPE_JSON = "json";

    /**
     * @var Start[]
     */
    protected $startNodes = [];

    /**
     * @param string $data
     * @param string|null $type
     */
    public function load($data, $type = null)
    {
        /** @var AbstractLoader $loader */
        $loader = null;
        switch ($type) {
            case self::TYPE_JSON:
                $loader = new Json();
                break;
        }

        if ($loader) {
            $loader->parseData($data);
            $this->startNodes = $loader->getStartNodes();
        }
    }

    /**
     * @return Start{}|Start
     */
    public function getStartNodes()
    {
        return $this->startNodes;
    }
}