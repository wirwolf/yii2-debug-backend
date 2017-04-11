<?php
/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 10.04.17
 * Time: 22:53
 */

namespace wirwolf\yii2DebugBackend\Panels;

use wirwolf\yii2DebugBackend\IPanel;
use Yii;
use yii\base\Object;

/**
 * Debugger panel that collects and displays application configuration and environment.
 *
 * @property array $extensions This property is read-only.
 * @property array $phpInfo This property is read-only.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ConfigPanel extends Object implements IPanel
{

    /**
     * @return string name of the panel
     */
    public function getId() {
        return 'yii.config';

    }

    /**
     * @return string content that is displayed at debug toolbar
     */
    public function getSummary() {
        return [];
    }

    /**
     * Returns the BODY contents of the phpinfo() output
     *
     * @return array
     */
    private function getPhpInfo() {
        ob_start();
        phpinfo();
        $pinfo = ob_get_contents();
        ob_end_clean();
        $phpinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo);
        $phpinfo = str_replace('<table', '<div class="table-responsive"><table class="table table-condensed table-bordered table-striped table-hover config-php-info-table" ', $phpinfo);
        $phpinfo = str_replace('</table>', '</table></div>', $phpinfo);
        return $phpinfo;
    }

    /**
     * @inheritdoc
     */
    public function getData() {
        return [
            'phpVersion'  => PHP_VERSION,
            'yiiVersion'  => Yii::getVersion(),
            'application' => [
                'yii'            => Yii::getVersion(),
                'name'           => Yii::$app->name,
                'version'        => Yii::$app->version,
                'language'       => Yii::$app->language,
                'sourceLanguage' => Yii::$app->sourceLanguage,
                'charset'        => Yii::$app->charset,
                'env'            => YII_ENV,
                'debug'          => YII_DEBUG,
            ],
            'php'         => [
                'version'   => PHP_VERSION,
                'info'      => $this->getPhpInfo(),
                'xdebug'    => extension_loaded('xdebug'),
                'apc'       => extension_loaded('apc'),
                'memcache'  => extension_loaded('memcache'),
                'memcached' => extension_loaded('memcached'),
            ],
            'extensions'  => Yii::$app->extensions,
        ];
    }
}
