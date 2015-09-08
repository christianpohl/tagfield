<?php

namespace Pimcore\Model\Object\ClassDefinition\Data;

use \Pimcore\Model\Object\ClassDefinition\Data\Multiselect;

/**
 * Class Tagfield
 * @package Pimcore\Model\Object\ClassDefinition\Data
 */
class Tagfield extends Multiselect
{
    /**
     * @var string
     */
    public $fieldtype = 'Tagfield';

    /**
     * @var
     */
    public $tagskey;

    /**
     * @return mixed
     */
    public function getTagskey()
    {
        return $this->tagskey;
    }

    /**
     * @param $tagskey
     */
    public function setTagskey($tagskey)
    {
        $this->tagskey = $tagskey;
    }

    /**
     * @param mixed $data
     * @param null $object
     * @return array
     */
    public function getDataForEditmode($data, $object = null)
    {
        if (is_array($data)) {
            $ret = [];

            foreach ($data as $d) {
                $ret[] = ['value' => $d];
            }

            return $ret;
        }
    }

    /**
     * @param $data
     * @param null $object
     * @return bool|string
     */
    public function getDataForQueryResource($data, $object = null)
    {
        $dbTable = new \Tagfield\Tagfield();
        $dbTable->setTags($this->tagskey, $data);

        if (is_array($data) && count($data)) {
            return ',' . implode(',', $data) . ',';
        }

        return false;
    }
}
