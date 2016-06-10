<?php

namespace Ikal\PhpFlowchart;

use Ikal\PhpFlowchart\Element\Configuration;
use Ikal\PhpFlowchart\Element\AbstractNode;
use Ikal\PhpFlowchart\Element\Node\Type\End;
use Ikal\PhpFlowchart\Element\Node\Type\Start;
use Ikal\PhpFlowchart\Element\NodeConnection;

class Flowchart
{

    /**
     * @var Configuration
     */
    protected $configuration;

    public function run()
    {
        /** @var Start[] $startNodes */
        $startNodes = $this->configuration->getStartNodes();

        foreach ($startNodes as $startNode) {
            if (!$startNode instanceof Start) {
                throw new \Exception('Flowchart start node must of a subclass of Ikal\PhpFlowchart\Element\Node\Type\Start');
            }
            $this->processNode($startNode);
        }
    }

    /**
     * @param Start|AbstractNode $node
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
            /** @var AbstractNode $node */
            $node = $connection->getToNode();
            if (!$node instanceof End) {
                $this->processNode($node);
            }
        }
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param Configuration $configuration
     *
     * @return $this
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }
}