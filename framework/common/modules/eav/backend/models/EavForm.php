<?php

namespace common\modules\eav\backend\models;


/*
    "group_name" : default,
    "label" : 123,
    "field_type" : text,
    "field_options" : {
        "required" : true,
        "min" : 0,
        "max" : 0,
        "minlength" : 0,
        "maxlength" : 0,
        "locked" : false,
        "visible" : true,
        "size" : small
    }
*/
class EavForm extends \yii\base\Model
{
    public $cid;
    public $group_name = 'default';
    public $label = 'Untitled';
    public $field_type;
    public $field_options;
    public $r = [
        'required' => true,
        'min' => 0,
        'max' => 0,
        "minlength" => 0,
        "maxlength" => 0,
        "locked" => false,
        "visible" => true,
        "size" => 'small',
        'options' => [],
        'description' => ''
    ];

    public function rules()
    {
        return [
            [['group_name', 'label', 'field_type', 'field_options'], 'string']
        ];
    }

}