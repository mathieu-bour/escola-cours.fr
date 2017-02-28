<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * Levels Controller
 *
 * @property \App\Model\Table\LevelsTable $Levels
 */
class LevelsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event); // TODO: Change the autogenerated stub
        $this->Auth->allow(['index']);
    }

    /**
     * JSON-only
     * Return all disciplines available
     */
    public function index()
    {
        if ($this->request->is('json')) {
            $rawRevelsWithDisciplines = $this->Levels->find('all')
                ->contain(['Disciplines'])->toArray();

            $levelsWithDisciplines = [];

            foreach ($rawRevelsWithDisciplines as $rawLevelWithDisciplines) {
                $disciplines = [];
                foreach ($rawLevelWithDisciplines['disciplines'] as $discipline) {
                    $disciplines[(int)$discipline['id']] = $discipline['name'];
                }
                $levelsWithDisciplines[(int)$rawLevelWithDisciplines['id']] = $disciplines;
            }

            $this->set([
                'levels' => $this->Levels->find('list')->toArray(),
                'levelsWithDisciplines' => $levelsWithDisciplines
            ]);
        }
    }
}
