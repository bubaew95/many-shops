<?php


namespace common\modules\shops\models;


use yii\base\Model;

class UploadImagesForm extends Model
{
    public $image;
    public $images;

    const SCENARIO_DEFAULT = 'SCENARIO_DEFAULT';
    const SCENARIO_UPDATE = 'SCENARIO_UPDATE';

    public function rules()
    {
        return [
            [ ['image'], 'required', 'on' => self::SCENARIO_DEFAULT ],

            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'on' => self::SCENARIO_DEFAULT],
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5, 'on' => self::SCENARIO_DEFAULT],

            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'on' => self::SCENARIO_UPDATE],
            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5, 'on' => self::SCENARIO_UPDATE],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image' => 'Базовое изображение',
            'images' => 'Миниатюрки',
        ];
    }


}