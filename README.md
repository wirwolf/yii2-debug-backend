Debug Extension for Yii 2
=========================

This extension provides a debugger for [Yii framework 2.0](http://www.yiiframework.com) applications. When this extension is used,
a debugger toolbar will appear at the bottom of every page.

For license information check the [LICENSE](LICENSE.md)-file.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist wirwolf/yii2-debug-backend
```

or add

```
"wirwolf/yii2-debug-backend": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply modify your application configuration as follows:

```php
$config = [
	'id' => 'yii2-basic'
];

if(YII_DEBUG) {
	$config['bootstrap'][] = 'debugBackend';
	$config['modules']['debugBackend'] = [
		'class'     => \wirwolf\yii2DebugBackend\Module::class,
		'transport' => [
			'class'        => \wirwolf\yii2DebugBackend\Transports\LocalDatabaseTransport::class,
			'storageClass' => \wirwolf\yii2DebugBackend\Transports\Databases\MysqlDatabase::class

		]
	];
}
```