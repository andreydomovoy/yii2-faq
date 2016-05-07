<?php

namespace ando\faq;

use yii;
use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;
use yii\console\Application as ConsoleApplication;

/**
 * Class Bootstrap
 * @package ando\faq
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @param yii\base\Application $app
     * @throws yii\base\InvalidConfigException
     */
    public function bootstrap($app)
    {
        if (!$app instanceof ConsoleApplication) {
            // get module 'faq'
            $module = $app->getModule('faq');

            // configure url rules
            $configUrlRule = [
                'class' => 'yii\web\GroupUrlRule',
                'prefix' => $module->urlPrefix,
                'rules' => $module->urlRules,
            ];

            // create rule
            $rule = Yii::createObject($configUrlRule);
            // add rule to urlManager
            $app->urlManager->addRules([$rule], false);

            // add more languages if they not set before
            if (!isset($app->get('i18n')->translations['faq*'])) {
                $app->get('i18n')->translations['faq*'] = [
                    'class' => PhpMessageSource::className(),
                    'basePath' => __DIR__ . '/messages',
                    'sourceLanguage' => 'en-US'
                ];
            }
        }
    }
}