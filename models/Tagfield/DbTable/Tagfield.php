<?php

namespace Tagfield\DbTable;

/**
 * Class Tagfield
 * @package Tagfield\DbTable
 */
class Tagfield extends \Zend_Db_Table_Abstract
{
    /**
     * @var string
     */
    protected $_name = 'plugin_tagfield';

    /**
     * @var string
     */
    protected $_primary = 'id';
}
