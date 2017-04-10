<?php
/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 11.04.17
 * Time: 0:07
 */

namespace wirwolf\yii2DebugBackend;

interface IPanel
{
    /**
     * @return string name of the panel
     */
    public function getId();

    /**
     * @return array
     */
    public function getSummary();

    /**
     * Saves data to be later used in debugger detail view.
     * This method is called on every page where debugger is enabled.
     *
     * @return mixed data to be saved
     */
    public function getData();

}
