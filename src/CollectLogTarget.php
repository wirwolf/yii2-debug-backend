<?php
/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 09.04.17
 * Time: 16:12
 */

namespace wirwolf\yii2DebugBackend;

use yii\log\Target;

/**
 * Class CollectLogTarget
 * @package wirwolf\yii2DebugBackend
 */
class CollectLogTarget extends Target
{

    /**
     * @var Module
     */
    public $module;

    /**
     * CollectLogTarget constructor.
     * @param Module $module
     * @param array $config
     */
    public function __construct(Module $module, $config = []) {
        parent::__construct($config);
        $this->module = $module;
    }

    /**
     * Exports log messages to a specific destination.
     * Child classes must implement this method.
     */
    public function export() {
        $this->module->sendData();
    }
}