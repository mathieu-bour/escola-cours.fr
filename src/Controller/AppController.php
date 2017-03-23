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

    /*= Hooks
     *=====================================================*/
    public function initialize()
    {
        parent::initialize();

        // Components
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
        $this->loadComponent('Auth', [
            'loginAction' => [
                'admin' => false
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email']
                ]
            ]
        ]);
    }

    public function beforeFilter(Event $event)
    {
        return parent::beforeFilter($event);
    }

    public function beforeRender(Event $event)
    {
        if (!$this->request->is('json')) {
            $this->set([
                'isLogged' => (bool)$this->Auth->user(),
                'isAdmin' => (bool)$this->Auth->user('admin'),
                '_csrfToken' => $this->request->getParam('_csrfToken')
            ]);

        }

        if (
            !array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        return parent::beforeRender($event);
    }

    /*= Common functions
     *=====================================================*/
    /**
     * Set a properly formatted json response
     * @param mixed $data
     * @param int $code
     * @param string $message
     */
    public function json($data = null, $code = 200, $message = 'OK')
    {
        $this->set([
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'url' => $this->request->getRequestTarget()
        ]);
    }

    /**
     * Set the page title
     * @param string $pageTitle
     */
    public function setTitle($pageTitle)
    {
        $this->set('pageTitle', $pageTitle);
    }
}
