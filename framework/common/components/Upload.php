<?php


namespace common\components;


use yii\imagine\Image;
use yii\web\HttpException;
use yii\web\UploadedFile;

class Upload
{
    /**
     * Абсолютный путь
     * @param array $instance
     * @param $path
     * @return array
     */
    private static function uploadedPath($fileName, $path) : array
    {
        $absolutePath     = $_SERVER['DOCUMENT_ROOT'] . UPLOADS;
        $year             = date('m-Y');
        $path             = !empty($path) ? $path : $year;
        $uploadPath       = "{$absolutePath}/{$path}";
        $uploadThumbPath  = "{$absolutePath}/thumbs/{$path}";

        if(!is_dir( $uploadPath )) {
            mkdir($uploadPath, 0777, true);
            mkdir($uploadThumbPath, 0777, true);
        }

        $randName   = md5(uniqid(rand(), true));
        $fileName = "{$randName}.$fileName";

        return [
            'uploadPath'      => "{$uploadPath}/{$fileName}",
            'uploadThumbPath' => "{$uploadThumbPath}/{$fileName}",
            'file'            => "{$path}/{$fileName}"
        ];
    }

    /**
     * Загрузка изображения
     * @param $context
     * @param $attribute
     * @param string $path
     * @return array|null
     */
    public static function image($context, $attribute, $path = '', $isThumbs = true): ?array
    {
        $uploadedInstance = UploadedFile::getInstances($context, $attribute);
        //if($context->scenario == $context::SCENARIO_UPDATE && !$context->{$attribute}) return true;

        if(!$uploadedInstance) return null;

        if( $context->validate() ) :

            $images = [];
            foreach ($uploadedInstance as $item) :
                $extension  = $uploadedInstance[0]->extension;
                $filePaths  = self::uploadedPath($extension, $path);
                $images[]   = self::uploadImage($item, $filePaths, $isThumbs);
            endforeach;

            return $images;
        endif;

        return null;
    }

    /**
     * Загрузка изображений
     * @param $uploadedInstance
     * @param $filePaths
     * @param $isThumbs
     * @return mixed
     */
    private static function uploadImage($uploadedInstance, $filePaths, $isThumbs): ?String
    {
        if($uploadedInstance->saveAs($filePaths['uploadPath'], true)) :

            if($isThumbs) :
                Image::thumbnail($filePaths['uploadPath'], IMAGE_CROP_WIDTH, IMAGE_CROP_HEIGHT)->save(
                    $filePaths['uploadThumbPath'],
                    ['quality' => 100]
                );
            endif;

            return $filePaths['file'];
        endif;

        return null;
    }


}