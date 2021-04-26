<?php

namespace console\controllers;

use yii\console\Controller;

use OpenApi\Annotations\OpenApi;
use Yii;
use yii\console\ExitCode;
use yii\helpers\Console;
use function OpenApi\scan;


class DefaultController extends Controller
{
    public function actionSwagger()
    {
        $openApi = scan('api/controllers');
        $file = Yii::getAlias('@frontend/documentation/swagger.yaml');

        $handle = fopen($file, 'wb');
        fwrite($handle, $openApi->toYaml());
        fclose($handle);

        echo $this->ansiFormat('Created \n",'. Console::FG_BLUE);

        return ExitCode::OK;
    }
}