<?php
namespace Docusign\Models;

abstract class RequestObject
{
    public function __toJSON()
    {
        /** strip out null values and their corresponding keys, we don't want to send those */
        $json = json_encode($this);
        echo preg_replace('/,\s*"[^"]+":null|"[^"]+":null,?/', '', $json);
    }
}