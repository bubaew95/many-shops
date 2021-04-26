<?php
require("../framework/vendor/autoload.php");
$openapi = \OpenApi\scan('../framework/api/controllers');
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();