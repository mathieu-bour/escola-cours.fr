<?php

namespace App\Controller\Admin;

use App\Model\Table\SlotsTable;

/**
 * Class SlotsController
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Controller\Admin
 *
 * @property SlotsTable $Slots
 */
class SlotsController extends AppController
{
    public function common($userId1, $userId2)
    {
        $slots1 = $this->Slots->find()
            ->select(['day', 'hour'])
            ->where(['user_id' => $userId1])
            ->order(['day', 'hour'])
            ->toArray();
        $slots2 = $this->Slots->find()
            ->select(['day', 'hour'])
            ->where(['user_id' => $userId2])
            ->order(['day', 'hour'])
            ->toArray();
        $this->json(array_values(array_intersect($slots1, $slots2)));
    }
}