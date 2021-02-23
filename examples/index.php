<?php

include dirname(__DIR__) . '/vendor/autoload.php';

use Selen\Environment\TypeInterface;
use Selen\Environment\Types;

class Development implements TypeInterface
{
    public const ENV_NAME = 'development';

    public function name(): string
    {
        return self::ENV_NAME;
    }

    public function values(): array
    {
        return [
            'aws' => [
                'client' => [
                    'version' => 'latest',
                    'region'  => 'us-east-1',
                ],
                's3' => [
                    'bucketName' => 'php-enviroment-development',
                ],
            ],
        ];
    }
}

class Testing implements TypeInterface
{
    public const ENV_NAME = 'testing';

    public function name(): string
    {
        return self::ENV_NAME;
    }

    public function values(): array
    {
        return [
            'aws' => [
                'client' => [
                    'version' => 'latest',
                    'region'  => 'us-east-1',
                ],
                's3' => [
                    'bucketName' => 'php-enviroment-testing',
                ],
            ],
        ];
    }
}

$types = new Types(new Development(), new Testing());

$envValues = $types->get(Development::ENV_NAME);

var_dump($envValues->values());

$envValues = $types->get(Testing::ENV_NAME);

var_dump($envValues->values());

try {
    $types->get('local');
} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
    // RuntimeException The specified environment name does not exist
}
