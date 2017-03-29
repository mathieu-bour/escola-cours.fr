<?php
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Table;

/**
 * Class AppTable
 *
 * @author Mathieu Bour <mathieu.tin.bour@gmail.com>
 * @package App\Model\Table
 */
class AppTable extends Table {
    /**
     * Define the connection name based on the debug config value
     * @return string the connection name
     */
    public static function defaultConnectionName(): string {
        return Configure::read('debug') ? 'dev' : 'prod';
    }
}