<?php
namespace wirwolf\yii2DebugBackend\Transports\Databases;

/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 10.04.17
 * Time: 22:41
 */
interface IDatabase
{
    public function save($tag, $summary, $data);
}