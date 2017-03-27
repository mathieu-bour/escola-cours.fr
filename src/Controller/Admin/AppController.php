<?php
namespace App\Controller\Admin;

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

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('DataTables.DataTables');
    }
}