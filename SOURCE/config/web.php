<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'timeZone' => 'Asia/Ho_Chi_Minh',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'main',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                    'yii\web\JqueryAsset' => [
                        'js' => []
                    ],
                    'yii\bootstrap\BootstrapPluginAsset' => [
                        'js' => []
                    ],
                    'yii\bootstrap\BootstrapAsset' => [
                        'css' => []
                    ]
                ],
                'converter'=> [
                    'class'=>'nizsheanez\assetConverter\Converter',
                    'force'=> false, // true : If you want convert your sass each time without time dependency
                    'destinationDir' => 'compiled', //at which folder of @webroot put compiled files
                    'parsers' => [
                        'sass' => [ // file extension to parse
                            'class' => 'nizsheanez\assetConverter\Sass',
                            'output' => 'css', // parsed output file type
                            'options' => [
                                'cachePath' => '@app/runtime/cache/sass-parser' // optional options
                            ],
                        ],
                        'scss' => [ // file extension to parse
                            'class' => 'nizsheanez\assetConverter\Scss',
                            'output' => 'css', // parsed output file type
                            'options' => [ // optional options
                                'enableCompass' => true, // default is true
                                'importPaths' => [], // import paths, you may use path alias here, 
                                    // e.g., `['@path/to/dir', '@path/to/dir1', ...]`
                                'lineComments' => false, // if true — compiler will place line numbers in your compiled output
                                'outputStyle' => 'nested', // May be `compressed`, `crunched`, `expanded` or `nested`,
                                    // see more at http://sass-lang.com/documentation/file.SASS_REFERENCE.html#output_style
                            ],
                        ],
                    ]
                ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'o60lq8tkQdSpe0YVVgspsSNPn-jIuk1q',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'app\controllers\CustomProjectRule',
                ]
            ],
        ],
        'db' => $db,
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'controllers' => ['site'],
                'actions' => [],
                'allow' => true,
            ],
            [
                'controllers' => ['app/diem-den'],
                'actions' => ['index' ,'detail'],
                'allow' => true,
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

$config['modules']['contrib'] = [
    'class' => 'app\modules\contrib\Module'
];

$config['modules']['app'] = [
    'class' => 'app\modules\app\Module'
];

return $config;
