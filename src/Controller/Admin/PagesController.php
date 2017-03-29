<?php

namespace App\Controller\Admin;

use App\Model\Table\CoursesTable;
use App\Model\Table\DisciplinesTable;
use App\Model\Table\LessonsTable;
use App\Model\Table\UsersTable;
use Cake\I18n\Time;
use Cake\ORM\Query;

/**
 * Pages AppController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller\Admin
 *
 * @property CoursesTable $Courses
 * @property DisciplinesTable $Disciplines
 * @property LessonsTable $Lessons
 * @property UsersTable $Users
 */
class PagesController extends AppController
{

    public function dashboard()
    {
        $this->loadModel('Courses');
        $this->loadModel('Disciplines');
        $this->loadModel('Lessons');
        $this->loadModel('Users');

        $this->setTitle('Tableau de bord');
        $this->set([
            'stats' => [
                'userCount' => $this->Users->find()->count(),
                'studentCount' => $this->Users->find()
                    ->where(['type' => 'student'])
                    ->count(),
                'teacherCount' => $this->Users->find()
                    ->where(['type' => 'teacher'])
                    ->count(),
                'lessonsTotalDuration' => current(
                    $this->Lessons->find()
                        ->select(['totalDuration' => 'SUM(duration)'])
                        ->first()
                        ->toArray()
                )
            ],
            'charts' => [
                'userRegistration' => $this->_userRegistrationChart('week'),
                'lessonsGivenByDate' => $this->_lessonsGivenByDateChart('week'),
                'lessonsGivenDetail' => $this->_lessonsGivenDetailChart('week'),
                'studentsByDisciplineChart' => $this->_studentsByDisciplineChart(),
                'teachersByDisciplineChart' => $this->_teachersByDisciplineChart()
            ],
            'tables' => [
                'bestStudents' => $this->Users->find()
                    ->contain([
                        'Courses',
                        'Courses.Disciplines',
                        'Courses.Levels'
                    ])
                    ->where(['type' => 'student'])
                    ->limit(5)
                    ->orderDesc('lesson_count')
                    ->toArray(),
                'bestTeachers' => $this->Users->find()
                    ->contain([
                        'Courses',
                        'Courses.Disciplines',
                        'Courses.Levels'
                    ])
                    ->where(['type' => 'teacher'])
                    ->limit(5)
                    ->orderDesc('lesson_count')
                    ->toArray()
            ]
        ]);
    }

    /*= Chart.js
     *=====================================================*/
    private function _getTimeDiff($diff)
    {
        switch ($diff) {
            case 'week':
                return Time::now()->subWeek();
            case 'month':
                return Time::now()->subMonth();
            case 'year':
                return Time::now()->subYear();
            default:
                return Time::now()->subYears(1000); // 1000 years are enough
        }
    }

    private function _userRegistrationChart($diff)
    {
        $query = $this->Users->find()
            ->enableHydration(false)
            ->select([
                'date' => 'DATE(created)',
                'students' => 'COUNT(CASE WHEN type = "student" THEN 1 ELSE NULL END)',
                'teachers' => 'COUNT(CASE WHEN type = "teacher" THEN 1 ELSE NULL END)',
            ])
            ->where(['created >=' => $this->_getTimeDiff($diff)])
            ->group('date')
            ->order(['date' => 'asc'])
            ->toList();

        return [
            'type' => 'bar',
            'data' => [
                'labels' => array_map(function ($date) {
                    return Time::parse($date)->format('d/m');
                }, array_column($query, 'date')),
                'datasets' => [
                    [
                        'label' => 'Nouveaux élèves',
                        'data' => array_map('intval', array_column($query, 'students')),
                        'backgroundColor' => '#2196f3'
                    ],
                    [
                        'label' => 'Nouveaux professeurs',
                        'data' => array_map('intval', array_column($query, 'teachers')),
                        'backgroundColor' => '#f44336'
                    ]
                ]
            ]
        ];
    }

    private function _lessonsGivenByDateChart($diff)
    {
        $query = $this->Lessons->find()
            ->enableHydration(false)
            ->select([
                'date' => 'DATE(beginning)',
                'count' => 'COUNT(*)'
            ])
            ->where(['beginning >=' => $this->_getTimeDiff($diff)])
            ->group('date')
            ->order(['date' => 'asc'])
            ->toList();

        return [
            'type' => 'bar',
            'data' => [
                'labels' => array_map(function ($date) {
                    return Time::parse($date)->format('d/m');
                }, array_column($query, 'date')),
                'datasets' => [
                    [
                        'label' => 'Cours donnés',
                        'data' => array_map('intval', array_column($query, 'count')),
                        'backgroundColor' => '#673ab7'
                    ]
                ]
            ]
        ];
    }

    private function _lessonsGivenDetailChart($diff)
    {
        $query = $this->Lessons->find()
            ->enableHydration(false)
            ->select([
                'discipline_id',
                'count' => 'COUNT(*)'
            ])
            ->where(['beginning >=' => $this->_getTimeDiff($diff)])
            ->group('discipline_id')
            ->order(['discipline_id' => 'asc'])
            ->toList();
        $disciplines = $this->Disciplines->find('list')->orderAsc('id')->toArray();

        return [
            'type' => 'doughnut',
            'data' => [
                'labels' => array_values($disciplines),
                'datasets' => [
                    [
                        'label' => 'Cours donnés',
                        'data' => array_map('intval', array_column($query, 'count')),
                        'backgroundColor' => [
                            '#f44336',
                            '#9c27b0',
                            '#3f51b5',
                            '#03a9f4',
                            '#009688',
                            '#8bc34a',
                            '#ffeb3b',
                            '#ff9800',
                            '#ff5722'
                        ]
                    ]
                ]
            ],
            'options' => [
                'cutoutPercentage' => 70
            ]
        ];
    }

    private function _studentsByDisciplineChart()
    {
        $query = $this->Courses->find()
            ->enableHydration(false)
            ->innerJoinWith('Users', function (Query $q) {
                return $q->where(['type' => 'student']);
            })
            ->select([
                'discipline_id',
                'count' => 'COUNT(*)'
            ])
            ->group('discipline_id')
            ->order(['discipline_id' => 'asc'])
            ->toList();
        $disciplines = $this->Disciplines->find('list')->orderAsc('id')->toArray();

        return [
            'type' => 'radar',
            'data' => [
                'labels' => array_values($disciplines),
                'datasets' => [
                    [
                        'label' => 'Effectif élèves',
                        'data' => array_map('intval', array_column($query, 'count')),
                        'backgroundColor' => 'rgba(63, 81, 181, 0.6)'
                    ]
                ]
            ],
            'options' => [
                'scale' => [
                    'ticks' => [
                        'beginAtZero' => true
                    ]
                ]
            ]
        ];
    }

    private function _teachersByDisciplineChart()
    {
        $query = $this->Courses->find()
            ->enableHydration(false)
            ->innerJoinWith('Users', function (Query $q) {
                return $q->where(['type' => 'teacher']);
            })
            ->select([
                'discipline_id',
                'count' => 'COUNT(*)'
            ])
            ->group('discipline_id')
            ->order(['discipline_id' => 'asc'])
            ->toList();
        $disciplines = $this->Disciplines->find('list')->orderAsc('id')->toArray();

        return [
            'type' => 'radar',
            'data' => [
                'labels' => array_values($disciplines),
                'datasets' => [
                    [
                        'label' => 'Effectif prof.',
                        'data' => array_map('intval', array_column($query, 'count')),
                        'backgroundColor' => 'rgba(139, 195, 75, 0.6)'
                    ]
                ]
            ],
            'options' => [
                'scale' => [
                    'ticks' => [
                        'beginAtZero' => true
                    ]
                ]
            ]
        ];
    }
}
