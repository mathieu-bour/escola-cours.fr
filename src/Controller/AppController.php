<?php

namespace App\Controller;

use App\Controller\Component\CrumbsComponent;
use Cake\Controller\Component\AuthComponent;
use Cake\Controller\Component\CsrfComponent;
use Cake\Controller\Component\FlashComponent;
use Cake\Controller\Component\RequestHandlerComponent;
use Cake\Controller\Component\SecurityComponent;
use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Class AppController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller
 *
 * @property AuthComponent $Auth
 * @property CrumbsComponent $Crumbs
 * @property CsrfComponent $Csrf
 * @property FlashComponent $Flash
 * @property RequestHandlerComponent $RequestHandler
 * @property SecurityComponent $Security
 */
class AppController extends Controller
{
    /*= Hooks
     *=====================================================*/
    public function initialize()
    {
        parent::initialize();
        // Components
        $this->loadComponent('Auth', [
            'authorize' => 'Controller',
            'loginAction' => [
                'prefix' => false,
                'controller' => 'users',
                'action' => 'login'
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email']
                ]
            ]
        ]);
        $this->loadComponent('Crumbs');
        $this->loadComponent('Csrf');
        $this->loadComponent('Flash');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Security');
    }

    public function beforeRender(Event $event)
    {
        if (!$this->request->is('json')) {
            $this->set([
                'here' =>  $this->request->getRequestTarget(),
                'isLogged' => (bool)$this->Auth->user(),
                'isAdmin' => (bool)$this->Auth->user('type') == 'admin',
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

    /*= Auth
     *=====================================================*/
    /**
     * Authorize user to access
     * @param null|array $user the user
     * @return bool
     */
    public function isAuthorized($user = null)
    {
        if (!$this->request->getParam('prefix')) {
            return true;
        }

        if ($this->request->getParam('prefix') === 'admin') {
            return $user['type'] == 'admin';
        }

        return false;
    }

    /*= Common functions
     *=====================================================*/
    /**
     * Set a properly formatted json response
     * @param mixed $data
     * @param string $message
     */
    public function json($data = null, $message = 'OK')
    {
        $this->set([
            'code' => $this->response->getStatusCode(),
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
        $this->Crumbs->end($pageTitle);
    }

    /**
     * Set the page description
     * @param $pageDescription
     */
    public function setDescription($pageDescription) {
        $this->set('pageDescription', $pageDescription);
    }
}
