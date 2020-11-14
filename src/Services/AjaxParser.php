<?php

namespace Services;

class AjaxParser
{
    /**
     * @param array $post
     */
    public function parse(array $post)
    {
        if (is_array($post) && !empty($post)) {
            $sessionService = new SessionService();

            foreach ($post as $key => $item) {
                switch ($key) {
                    case 'lang':
                        $sessionService->setLang($item);
                        break;
                    default:
                        break;
                }
            }
        }

        echo json_encode('success');
    }
}
