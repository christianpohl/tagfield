<?php

namespace Tagfield;

/**
 * Class Tagfield
 * @package Tagfield
 */
class Tagfield
{
    /**
     * @var Tagfield_DbTable_Tagfield
     */
    private $table;

    /**
     * constructor
     */
    public function __construct()
    {
        \Zend_Db_Table::setDefaultAdapter(
            \Pimcore\Resource\Mysql::get()->getResource()
        );

        $this->table = new \Tagfield\DbTable\Tagfield();
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getTagsByKey($key)
    {
        $select = $this->table->select()->where('`key` LIKE ?', $key);

        $tags = $this->table->fetchAll($select);

        return $tags->toArray();
    }

    /**
     *
     * @param string $key
     * @return array
     */
    public function getTagListByKey($key)
    {
        $select = $this->table->select()->where('`key` LIKE ?', $key);

        $tags = $this->table->fetchAll($select);

        $list = [];

        foreach ($tags as $tag) {
            $list[] = $tag->tag;
        }

        return $list;
    }

    /**
     *
     * @param string $key
     * @param array $tags
     */
    public function setTags($key, $tags)
    {
        $exTags = $this->getTagListByKey($key);

        if (is_array($tags)) {
            foreach ($tags as $tag) {
                if (!in_array($tag, $exTags, true)) {
                    $this->addTag($key, $tag);
                }
            }
        }

        return true;
    }

    /**
     *
     * @param string $key
     * @param string $tag
     * @return boolean
     */
    private function addTag($key, $tag)
    {
        if ($tag !== '') {
            $this->table->insert([
                'key' => addslashes($key),
                'tag' => addslashes($tag),
            ]);

            return true;
        }

        return false;
    }
}
