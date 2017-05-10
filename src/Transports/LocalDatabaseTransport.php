<?php

namespace wirwolf\yii2DebugBackend\Transports;

use wirwolf\yii2DebugBackend\ITransport;
use wirwolf\yii2DebugBackend\Transports\Databases\FileDatabase;
use wirwolf\yii2DebugBackend\Transports\Databases\IDatabase;
use yii\base\Object;

/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 10.04.17
 * Time: 22:37
 */
class LocalDatabaseTransport extends Object implements ITransport
{

    /**
     * @var IDatabase
     */
    public $storageClass = null;

    /**
     * LocalDatabaseTransport constructor.
     * @param array $config
     */
    public function init() {
        if(!$this->storageClass) {
            $this->storageClass = \Yii::createObject(['class' => FileDatabase::className()]);
        } else {
            $this->storageClass = \Yii::createObject($this->storageClass);
        }
    }

    /**
     * @param $tag
     * @param $summary
     * @param $data
     * @return mixed
     */
    public function sendContent($tag, $summary, $data) {
        return $this->storageClass->save($tag, $summary, $data);
    }

    /**
     * @return bool
     */
    public function alive() {
        //var_dump(floor(100 * disk_free_space($disk) / disk_total_space($disk)));
        return true;
    }
}