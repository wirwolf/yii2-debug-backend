<?php
/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 10.04.17
 * Time: 22:50
 */

namespace wirwolf\yii2DebugBackend\Panels;

use wirwolf\yii2DebugBackend\IPanel;
use yii\base\Object;

/**
 * Class RequestPanel
 * @package wirwolf\yii2DebugBackend\Panels
 */
class RequestPanel extends Object implements IPanel
{

    /**
     * @return string name of the panel
     */
    public function getId() {
        // TODO: Implement getId() method.
    }

    /**
     * @return string content that is displayed at debug toolbar
     */
    public function getSummary() {
        return [];
    }

    /**
     * Saves data to be later used in debugger detail view.
     * This method is called on every page where debugger is enabled.
     *
     * @return mixed data to be saved
     */
    public function getData() {
        return \Yii::$app->request;
    }
}