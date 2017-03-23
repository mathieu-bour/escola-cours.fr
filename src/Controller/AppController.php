<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Route\Route;

/**
 * Class AppController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller
 */
class AppController extends Controller
{

    public function initialize()
    {
        parent::initialize();

        // Components
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email']
                ]
            ]
        ]);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function beforeRender(Event $event)
    {
        if (!$this->request->is('json')) {
            $this->set('isLogged', (bool)$this->Auth->user());
            $this->set([
                '_csrfToken' => $this->request->getParam('_csrfToken')
            ]);

        }

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function json($data = null, $code = 200, $message = 'OK')
    {
        $this->set([
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'url' => $this->request->getRequestTarget()
        ]);
    }

    public function setTitle($pageTitle)
    {
        $this->set('pageTitle', $pageTitle);
    }
}
