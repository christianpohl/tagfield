<?php

/**
 * Class AdminController
 * @package Tagfield
 */
class Tagfield_AdminController extends \Pimcore\Controller\Action\Admin
{
    /**
     * get tags by key
     */
    public function gettagsAction()
    {
        $key = $this->getParam('key');

        $table = new \Tagfield\Tagfield();

        $tags = $table->getTagsByKey($key);

        $data = [];

        foreach ($tags as $tag) {
            $data[] = ['value' => $tag['tag']];
        }

        $this->_helper->json(['data' => $data]);
    }
}
