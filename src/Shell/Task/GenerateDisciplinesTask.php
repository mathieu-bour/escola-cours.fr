<?php

namespace App\Shell\Task;

/**
 * Class GenerateDisciplinesTask
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Shell\Task
 */
class GenerateDisciplinesTask extends GenerateTask
{
    public function main()
    {
        $this->_save($this->_readDefault('disciplines'));
    }
}