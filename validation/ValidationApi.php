<?php
/**
 * Created by PhpStorm.
 * User: Ms
 * Date: 14/02/2018
 * Time: 04:07 PM
 */

class ValidationApi
{
    public function CheckParamGallery($Type)
    {

        if (!intval($Type)) {
            return $Type;
        } else {
            return false;
        }

    }
    private function CheckParamsString($Type)
    {
        $string1=escape_string($Type);
        $string2=htmlspecialchars($string1);
        $string3=htmlentities($string2,ENT_COMPAT,'UTF-8');
        $string4=trim($string3);
        return $string4;
    }

    public function CheckParamArticle($id)
    {

        if (!intval($id)) {
            return $id;
        } else {
            return false;
        }

    }

}