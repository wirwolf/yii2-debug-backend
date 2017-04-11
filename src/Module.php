<?php
/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 09.04.17
 * Time: 15:58
 */

namespace wirwolf\yii2DebugBackend;

use yii\base\Application;
use yii\base\BootstrapInterface;

/**
 * Class Module
 * @package wirwolf\yii2DebugPackend
 */
class Module extends \yii\base\Module implements BootstrapInterface
{

    /**
     * @var array
     */
    public $panels = [];

    /**
     * @var ITransport
     */
    public $transport = false;

    /**
     * @var CollectLogTarget
     */
    public $logTarget;

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app) {
        $this->logTarget = $app->getLog()->targets['debug'] = new CollectLogTarget($this);
        $this->panels = array_merge($this->getBasePanels(), $this->panels);

    }

    /**
     *
     */
    protected function getBasePanels() {
        return [
           'asset' => Panels\AssetPanel::class,
           'config' => Panels\ConfigPanel::class,
           'db' => Panels\DbPanel::class,
           'log' => Panels\LogPanel::class,
           'mail' => Panels\MailPanel::class,
           'request' => Panels\RequestPanel::class,
        ];
    }

    public function disabledPanels($list = []) {

    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function sendData() {
        if(false == $this->transport) {
            $this->transport = \Yii::createObject(
                Transports\LocalDatabaseTransport::class,
                [
                    'storageClass' => Transports\Databases\FileDatabase::class
                ]
            );
        }
        if ($this->transport->alive()) {
            $content = $this->collectData();
            if ($this->transport->sendContent($content['tag'], $content['summary'], $content['data'])) {
                exit(0);
            }
        }

    }


    private function  collectData() {
        $summary = $this->collectBaseSummary();
        $data = [];
        $errorLog = [];
        foreach($this->panels as $item) {
            /** @var IPanel $itemObject */
            $itemObject = \Yii::createObject($item);
            if(!$itemObject instanceof IPanel) {
                $errorLog[] = $itemObject::className() . ' not implement IPanel interface';
            }
            $summary = array_merge($summary, $itemObject->getSummary());
            $data[$itemObject->getId()] = $itemObject->getData();
        }
        return [
            'tag'     => uniqid(),
            'summary' => $summary,
            'data'    => $data
        ];
    }

    /**
     * Collects summary data of current request.
     * @return array
     */
    protected function collectBaseSummary() {
        if (\Yii::$app === null) {
            return '';
        }

        $request = \Yii::$app->getRequest();
        $response = \Yii::$app->getResponse();
        $summary = [
            'url'        => $request->getAbsoluteUrl(),
            'ajax'       => (int)$request->getIsAjax(),
            'method'     => $request->getMethod(),
            'ip'         => $request->getUserIP(),
            'time'       => $_SERVER['REQUEST_TIME_FLOAT'],
            'statusCode' => $response->statusCode,
        ];
        return $summary;
    }
}