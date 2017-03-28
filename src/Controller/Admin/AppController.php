<?php

namespace App\Controller\Admin;

use Cake\Event\Event;

/**
 * Class AppController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller\Admin
 */
class AppController extends \App\Controller\AppController
{
    public $helpers = [
        'DataTables' => [
            'className' => 'DataTables.DataTables'
        ]
    ];

    /*= Hooks
     *=====================================================*/
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('DataTables.DataTables');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if ($this->request->getParam('controller') != 'Pages' || $this->request->getParam('action') != 'dashboard') {
            $this->Crumbs->append([
                'title' => 'Tableau de bord',
                'url' => ['controller' => 'pages', 'action' => 'dashboard']
            ]);
        }
    }
}