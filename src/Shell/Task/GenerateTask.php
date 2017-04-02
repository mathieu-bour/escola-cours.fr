<?php

namespace App\Shell\Task;

use Cake\Console\Exception\StopException;
use Cake\Console\Shell;
use Cake\Utility\Inflector;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class GenerateTask
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Shell\Task
 */
class GenerateTask extends Shell
{
    /** @var string the default directory */
    protected $_defaultDir;
    /** @var string the dictionaries directory */
    protected $_dictionariesDir;

    /** @var string the model name */
    protected $_model;
    /** @var string the entity name */
    protected $_entityName;

    public function initialize()
    {
        parent::initialize();

        $this->_defaultDir = ROOT . DS . 'generator' . DS . 'default' . DS;
        $this->_dictionariesDir = ROOT . DS . 'generator' . DS . 'dictionaries' . DS;

        $this->_model = str_replace(['App\Shell\Task\Generate', 'Task'], '', get_class($this));
        $this->_entityName = strtolower(Inflector::singularize($this->_model));

        $this->loadModel($this->_model);
    }

    /**
     * Save generated data
     * @param array $data the data to save
     * @param int $chunkSize the chunk size
     */
    protected function _save($data, $chunkSize = 100)
    {
        // Chunk data
        $chunkedData = array_chunk($data, $chunkSize);
        $chunkCount = count($chunkedData);

        $this->nl(0);
        for ($i = 1; $i <= $chunkCount; $i++) {
            $this->_io->overwrite('Saving ' . $this->_entityName . ' chunks [' . $i . '/' . $chunkCount . ']', 0);
            $users = $this->{$this->_model}->newEntities($chunkedData[$i - 1]);

            if (!$this->{$this->_model}->saveMany($users)) {
                throw new StopException('Unable to save user chunk', 2);
            }
        }
        $this->out($this->nl(0));
        $this->out($this->_model . ' saved');
    }

    /**
     * Read a YAML default from the _defaultDir
     * @param string $defaultName the default name
     * @return array
     */
    protected function _readDefault($defaultName)
    {
        try {
            return (array)Yaml::parse(file_get_contents($this->_defaultDir . $defaultName . '.yaml'));
        } catch (ParseException $e) {
            $this->err('Unable to parse the YAML string: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Read a YAML dictionary from the _dictionariesDir
     * @param string $dictionaryName the dictionary name
     * @return array
     */
    protected function _readDictionary($dictionaryName)
    {
        try {
            return (array)Yaml::parse(file_get_contents($this->_dictionariesDir . $dictionaryName . '.yaml'));
        } catch (ParseException $e) {
            $this->err('Unable to parse the YAML string: ' . $e->getMessage());
            return [];
        }
    }
}