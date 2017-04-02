<?php

namespace App\Shell\Task;

/**
 * Class GenerateLevelsTask
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Shell\Task
 */
class GenerateLevelsTask extends GenerateTask
{
    public function main()
    {
        $this->_save($this->_readDefault('levels'));
    }
}