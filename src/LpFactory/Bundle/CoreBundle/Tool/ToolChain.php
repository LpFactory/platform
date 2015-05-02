<?php
/**
 * Copyright 2015 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2015 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/LpFactory/blob/master/LICENSE
 * @link https://github.com/jbouzekri/LpFactory
 */

namespace LpFactory\Bundle\CoreBundle\Tool;

use LpFactory\Bundle\CoreBundle\Model\AbstractPage;

/**
 * Class ToolChain
 *
 * @package LpFactory\Bundle\CoreBundle\Tool
 * @author jobou
 */
class ToolChain implements ToolChainInterface
{
    /**
     * @var array
     */
    protected $tools = array();

    /**
     * {@inheritdoc}
     */
    public function addTool(ToolInterface $tool, $alias)
    {
        $this->tools[$alias] = $tool;
        $this->sortTools();

        return $this;
    }

    /**
     * Sort tools
     */
    protected function sortTools()
    {
        usort($this->tools, function (ToolInterface $toolLeft, ToolInterface $toolRight) {
            if ($toolLeft == $toolRight) {
                return 0;
            }

            return ($toolLeft->getPriority() < $toolRight->getPriority()) ? -1 : 1;
        });
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->tools;
    }

    /**
     * {@inheritdoc}
     */
    public function allInPage(AbstractPage $page)
    {
        $toolsInPage = array();

        /** @var ToolInterface $tool */
        foreach ($this->tools as $tool) {
            if ($tool->supportsPage($page)) {
                $toolsInPage[] = $tool;
            }
        }

        return $toolsInPage;
    }
}
