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

    public $tableSummery = '{{%summery}}';

    public $tableData = '{{%data}}';

    public $tablePrefix = 'debug_';

    /**
     * @var Connection|array|string the DB connection object or the application component ID of the DB connection
     * that this migration should work with. Starting from version 2.0.2, this can also be a configuration array
     * for creating the object.
     *
     * Note that when a Migration object is created by the `migrate` command, this property will be overwritten
     * by the command. If you do not want to use the DB connection provided by the command, you may override
     * the [[init()]] method like the following:
     *
     * ```php
     * public function init()
     * {
     *     $this->db = 'db2';
     *     parent::init();
     * }
     * ```
     */
    public $db = 'db';

    /**
     * Initializes the migration.
     * This method will set [[db]] to be the 'db' application component, if it is `null`.
     */
    public function init() {
        $this->db = Instance::ensure($this->db, Connection::className());
        $this->db->getSchema()->refresh();
        $this->db->enableSlaves = false;
        $this->db->tablePrefix = $this->tablePrefix;
    }

    public function save($tag, $summary, $data) {
        $this->db->createCommand()->insert($this->tableSummery, [
            'tag'         => $tag,
            'url'         => $summary['url'],
            'ajax'        => $summary['ajax'],
            'method'      => $summary['method'],
            'ip'          => $summary['ip'],
            'time'        => $summary['time'],
            'statusCode'  => $summary['statusCode'],
            'tabsSummery' => serialize($summary['plugins']),
        ], $data)->execute();
        foreach ($data as $key => $content) {
            $this->db->createCommand()->insert($this->tableData, [
                'tag'     => $tag,
                'panelId' => $key,
                'content' => serialize($content)
            ])->execute();
        }
        return;
    }
}