<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;

class CrumbsComponent extends Component
{
    public $crumbList = [];
    public $crumbEnd;

    /**
     * Initialize crumbs
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
    }

    /**
     * Append a crumb to crumbList
     * @param string|array $crumb
     */
    public function append($crumb)
    {
        array_push($this->crumbList, $crumb);
    }

    /**
     * Prepend a crumb to crumbList
     * @param string|array $crumb
     */
    public function prepend($crumb)
    {
        array_unshift($this->crumbList, $crumb);
    }

    /**
     * Ensure that the end is at the end
     * @param string|array $crumb
     */
    public function end($crumb)
    {
        $this->crumbEnd = $crumb;
    }

    /*= Hooks
     *=====================================================*/
    public function beforeRender(Event $event)
    {
        $crumbList = $this->crumbList;

        if (!empty($this->crumbEnd)) {
            array_push($crumbList, $this->crumbEnd);
        }

        $event->getSubject()->set('crumbList', $this->crumbList);
    }
}