<?php

$config_apps = require __DIR__ . '/config_apps.php';
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$dbSso = require __DIR__ . '/dbSso.php';
$dbSimrsOld = require __DIR__ . '/dbSimrsOld.php';
$params['config_apps'] = $config_apps;

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => "Asia/Jakarta",
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'sso',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'app\models\User',
            'identityClass' => 'app\models\Identitas',
            'enableAutoLogin' => true,
            'loginUrl'  => $config_apps['config']['url_apps']['sso'] . 'masuk?b=' . $config_apps['config']['url_apps']['base'],
            'identityCookie' => ['name' => '_identity-id', 'httpOnly' => true, 'domain' => 'simrs.aa'],
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
        'db' => $db,
        'dbSso' => $dbSso,
        'dbSimrsOld' => $dbSimrsOld,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',                 // only for integer id
                '<controller:\w+>/<action:\w+[-\w]+\w>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+[-\w]+\w>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>s' => '<controller>/index',
            ],
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
            'db' => $db,
            'itemTable' => 'master.auth_item',
            'assignmentTable' => 'master.auth_assignment',
            'itemChildTable' => 'master.auth_item_child',
            'ruleTable' => 'master.auth_rule'
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/theme',
                    'js' => [
                        'adminlte3/plugins/jquery/jquery.min.js',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/theme',
                    'js' => [
                        'adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js',
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web/theme',
                    'css' => [
                        'adminlte3/dist/css/bootstrap.min.css',
                    ]
                ],

            ],
        ],

    ],
    'params' => $params,
    'modules' => [
        'utility' => [
            'class' => 'c006\utility\migration\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'treemanager' => [
            'class' => '\kartik\tree\Module',
        ],
        'rbac' => [
            'class' => 'app\modules\rbac\Module',
        ],
        'gridviewKartik' =>  [
            'class' => '\kartik\grid\Module',
        ]

    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'auth/*',
            'api/api-referensi/*',
        ]
    ],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

if (!YII_ENV_TEST) {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ // here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ // setting for our templates
                    'yii2-adminlte3' => '@vendor/hail812/yii2-adminlte3/src/gii/generators/crud/default' // template name => path to template
                ]
            ]
        ]
    ];
}

return $config;
