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
    public function beforeFilter(Event $event)
    {
        return parent::beforeFilter($event);
    }
}