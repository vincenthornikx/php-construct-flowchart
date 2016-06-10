<?php

namespace Ikal\PhpFlowchart;

use Exception;
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
        if (!$this->isConfigured()) {
            return;
        }

        /** @var Start[] $startNodes */
        $startNodes = $this->getConfiguration()->getStartNodes();

        foreach ($startNodes as $startNode) {
            if (!$startNode instanceof Start) {
                throw new Exception('Flowchart start node must of a subclass of Ikal\PhpFlowchart\Element\Node\Type\Start');
            }
            $this->processNode($startNode);
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    protected function isConfigured()
    {
        if (empty($this->getConfiguration())) {
            throw new Exception('Flowchart has not been configured');
        }

        /** @var Configuration $configuration */
        $configuration = $this->getConfiguration();
        if (!count($configuration->getStartNodes())) {
            throw new Exception('Flowchart has no starting nodes');
        }

        return true;
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