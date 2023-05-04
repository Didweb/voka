<?php

namespace App\Vokabular\Frontend\Shared\Infrastructure\Service;

class MessageGenerator
{

    const  DANGER_DUPLICATE = 'danger_duplicate';
    const  SUCCESS_ADD = 'success_add';


    public static function getMessage($nameField, $valueField, $type)
    {

        switch($type){
            case 'danger_duplicate':
                return self::getDuplicate($nameField, $valueField);
            case 'success_add':
                return self::getAddOk($nameField, $valueField);
        }


    }

    public static function getDuplicate($nameField, $valueField)
    {
        return 'The  '.$nameField.': <b>'.$valueField.'<b class="text-danger"> already exists</b>. No new '.
                $nameField.' has been saved.';
    }

    public static function getAddOk($nameField, $valueField)
    {
        return 'The <b  class="text-success">'.$valueField.'</b> '.
                $nameField.' has been added. You can add another.';
    }

}