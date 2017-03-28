<?php

namespace App\Controller\Admin;

use App\Model\Table\UsersTable;
use Cake\I18n\Time;

/**
 * Pages AppController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller\Admin
 *
 * @property UsersTable $Users
 */
class PagesController extends AppController
{
    private function _userRegistrationChart($days = 7)
    {
        $this->loadModel('Users');

        $query = $this->Users->find()
            ->enableHydration(false)
            ->select([
                'date' => 'DATE(created)',
                'count' => 'COUNT(*)'
            ])
            ->where(['created >=' => Time::now()->subDays($days)])
            ->group('date')
            ->order(['date' => 'desc'])
            ->toList();

        return [
            'type' => 'bar',
            'data' => [
                'labels' => array_map(function ($date) {
                    return Time::parse($date)->format('d/m');
                }, array_column($query, 'date')),
                'datasets' => [
                    [
                        'label' => 'Nouveaux inscrits',
                        'data' => array_map('intval', array_column($query, 'count')),
                        'backgroundColor' => '#673ab7'
                    ]
                ]
            ]
        ];
    }

    public function dashboard()
    {
        $this->setTitle('Tableau de bord');
        $this->set([
            'charts' => [
                'userRegistration' => $this->_userRegistrationChart()
            ]
        ]);
    }
}
