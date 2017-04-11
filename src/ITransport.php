<?php
/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 10.04.17
 * Time: 22:35
 */

namespace wirwolf\yii2DebugBackend;

/**
 * Interface ITransport
 * @package wirwolf\yii2DebugBackend
 */
interface ITransport
{

    /**
     * @param $tag
     * @param $summary
     * @param $data
     * @return mixed
     */
    public function sendContent($tag, $summary, $data);

    /**
     * @return bool
     */
    public function alive();
}