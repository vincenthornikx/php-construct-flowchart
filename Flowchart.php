<?php


namespace Ikal\PhpFlowchart;


use Ikal\PhpFlowchart\Element\Node;
use Ikal\PhpFlowchart\Element\Node\Type\End;
use Ikal\PhpFlowchart\Element\Node\Type\Start;
use Ikal\PhpFlowchart\Element\Configuration;
use Ikal\PhpFlowchart\Element\NodeConnection;

class Flowchart
{

    /**
     * @var Configuration
     */
    protected $configuration;

    public function execute()
    {
        /** @var Start $startNode */
        $startNode = $this->configuration->getStartNode();
        if (!is_array($startNode)) {
            $startNode = [$startNode];
        }

        foreach ($startNode as $node) {
            $this->processNode($node);
        }
    }

    /**
     * @param Node $node
     */
    protected function processNode($node)
    {
        $connections = $node->execute();
        if (!is_array($connections)) {
            $connections = [$connections];
        }
        $this->processConnections($connections);
    }

    /**
     * @param NodeConnection[] $connections
     */
    protected function processConnections($connections)
    {
        foreach ($connections as $connection) {
            /** @var Node $node */
            $node = $connection->getToNode();
            if (!$node instanceof End) {
                $this->processNode($node);
            }
        }
    }
}