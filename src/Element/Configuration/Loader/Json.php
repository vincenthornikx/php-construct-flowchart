<?php

namespace Ikal\PhpFlowchart\Element\Configuration\Loader;

use Ikal\PhpFlowchart\Element\Configuration\AbstractLoader;

class Json extends AbstractLoader
{

    /**
     * @param string $data
     */
    public function parse($data)
    {
        // data could be json string or filename
        if (file_exists($data)) {
            $data = file_get_contents($data);
        }

        $this->parseData($data);
    }

    /**
     * @param mixed $data
     *
     * @return array|bool|null
     */
    protected function formatAsArray($data)
    {
        // format data as array
        if (!is_array($data)) {
            if (is_object($data)) {
                $data = json_decode(json_encode($data), true);
            } elseif (is_string($data)) {
                $data = json_decode($data, true);
            }
        }

        return $data;
    }
}