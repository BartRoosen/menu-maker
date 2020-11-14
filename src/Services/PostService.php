<?php


namespace Services;


class PostService
{
    public function checkPostRequest(array $fields)
    {
        if(!isset($_POST)) {
            return false;
        }

        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                return false;
            }

            if ('' === $_POST[$field]) {
                return false;
            }
        }

        return true;
    }
}