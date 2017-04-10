<?php
namespace wirwolf\yii2DebugBackend\Transports\Databases;

use yii\base\Object;

/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 10.04.17
 * Time: 22:40
 */
class FileDatabase extends Object implements IDatabase
{

    /**
     * @var string the directory storing the debugger data files. This can be specified using a path alias.
     */
    public $dataPath = '@runtime/debug';
    /**
     * @var integer the permission to be set for newly created debugger data files.
     * This value will be used by PHP [[chmod()]] function. No umask will be applied.
     * If not set, the permission will be determined by the current environment.
     * @since 2.0.6
     */
    public $fileMode;
    /**
     * @var integer the permission to be set for newly created directories.
     * This value will be used by PHP [[chmod()]] function. No umask will be applied.
     * Defaults to 0775, meaning the directory is read-writable by owner and group,
     * but read-only for other users.
     * @since 2.0.6
     */
    public $dirMode = 0775;
    /**
     * @var integer the maximum number of debug data files to keep. If there are more files generated,
     * the oldest ones will be removed.
     */
    public $historySize = 200;
}