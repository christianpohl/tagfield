<?php

namespace Tagfield;

use Pimcore\API\Plugin as PluginLib;

/**
 * Class Plugin
 * @package Tagfield
 */
class Plugin extends PluginLib\AbstractPlugin implements PluginLib\PluginInterface
{
    /**
     * @return string
     */
    public static function install()
    {
        try {
            PluginLib\AbstractPlugin::getDb()->query(
                'CREATE TABLE IF NOT EXISTS plugin_tagfield (
                id INT NOT NULL AUTO_INCREMENT,
                key varchar(255) DEFAULT NULL,
                tag varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
            );
        } catch (\Exception $e) {
            $message = 'Error querying plugin query: ' . $e->getMessage() . $e->getCode();

            \Logger::error('Tagfield-Plugin: ' . $message);
        }

        $statusMessage = 'Tagfield Plugin could not be installed';

        if (self::isInstalled()) {
            $statusMessage = 'Tagfield Plugin successfully installed.';
        }

        return $statusMessage;
    }

    /**
     * @return bool
     */
    public static function needsReloadAfterInstall()
    {
        return true;
    }

    /**
     * @return string
     */
    public static function uninstall()
    {
        PluginLib\AbstractPlugin::getDb()->query('DROP TABLE plugin_tagfield');

        $statusMessage = 'Tagfield Plugin could not be uninstalled';

        if (!self::isInstalled()) {
            $statusMessage = 'Tagfield Plugin successfully uninstalled.';
        }

        return $statusMessage;
    }

    /**
     * @return bool
     */
    public static function isInstalled()
    {
        $result = null;

        try {
            $result = PluginLib\AbstractPlugin::getDb()->query('SELECT * FROM plugin_tagfield');
        } catch (\Exception $e) {
            $message = 'Error querying plugin query: ' . $e->getMessage() . $e->getCode();

            \Logger::error('Tagfield-Plugin: ' . $message);
        }

        return $result ? true : false;
    }

    /**
     * @return string
     */
    public static function getJsClassName()
    {
        return '';
    }

    /**
     * @param string $language
     * @return string
     */
    public static function getTranslationFile($language)
    {
        if (file_exists(PIMCORE_PLUGINS_PATH . '/Tagfield/texts/' . $language . '.csv')) {
            return '/Tagfield/texts/' . $language . '.csv';
        }

        return '/Tagfield/texts/en.csv';
    }
}
