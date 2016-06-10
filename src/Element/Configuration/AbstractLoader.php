<?php

namespace Ikal\PhpFlowchart\Element\Configuration;

use Ikal\PhpFlowchart\Element\AbstractNode;
use Ikal\PhpFlowchart\Element\Node\Type\Start;
use Ikal\PhpFlowchart\Element\NodeConnection;

abstract class AbstractLoader
{

    /**
     * @var AbstractNode[]
     */
    protected $nodes = [];

    /**
     * @param mixed $data
     */
    public function parseData($data)
    {
        $data = $this->formatAsArray($data);

        // improper data format, panic!
        if (!is_array($data) || !isset($data['nodes'], $data['connections'])) {
            // error
            return;
        }

        foreach ($data['nodes'] as $node) {
            $this->parseNodeData($node);
        }

        foreach ($data['connections'] as $connection) {
            $this->parseConnectionData($connection);
        }
    }

    /**
     * @param mixed $data
     *
     * @return array
     */
    protected function formatAsArray($data)
    {
        return (array)$data;
    }

    /**
     * @param array $data
     */
    protected function parseNodeData($data)
    {
        if (!is_array($data) || !isset($data['id'], $data['class']) || !class_exists($data['class'])) {
            // panic
            return;
        }

        /** @var AbstractNode $node */
        $node = new $data['class']();
        if (!$node instanceof AbstractNode) {
            // panic
            return;
        }

        $node->setId($data['id']);
        $this->nodes[$node->getId()] = $node;
    }

    /**
     * @param array $data
     */
    protected function parseConnectionData($data)
    {
        if (!is_array($data) || !isset($data['from'], $data['to'])) {
            // panic
            return;
        }

        $fromId = $data['from'];
        $toId = $data['to'];
        if (!isset($this->nodes[$fromId], $this->nodes[$toId])) {
            // connection cannot be made because of missing nodes, panic
            return;
        }

        $fromNode = $this->nodes[$fromId];
        $toNode = $this->nodes[$toId];
        $connection = new NodeConnection();
        $connection->connectNodes($fromNode, $toNode);
    }

    /**
     * @return AbstractNode[]
     */
    public function getStartNodes()
    {
        $startNodes = [];
        foreach ($this->nodes as $node) {
            if ($node instanceof Start) {
                $startNodes[] = $node;
            }
        }

        return $startNodes;
    }
}