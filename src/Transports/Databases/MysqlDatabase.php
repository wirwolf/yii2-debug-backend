<?php
namespace wirwolf\yii2DebugBackend\Transports\Databases;

use yii\base\Object;
use yii\db\Connection;
use yii\di\Instance;

/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 10.04.17
 * Time: 22:39
 */
class MysqlDatabase extends Object implements IDatabase
{

    /**
     * @var Connection|array|string the DB connection object or the application component ID of the DB connection.
     * After the StorageDb object is created, if you want to change this property, you should only assign it
     * with a DB connection object.
     */
    public $db = 'db';

    public $prefix = 'debug_';

    public $indexTable = '{{summary}}';

    public $dataTable = 'details';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::className());
        $this->db->tablePrefix = $this->prefix;
    }

    public function save($tag, $summary, $data) {

    }
}