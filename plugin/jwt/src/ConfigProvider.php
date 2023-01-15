<?php

/**
 * @Notes:【】
 * @Date: 2023-01-15 21:52
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'publish' => [
                [
                    'id' => 'jwt',
                    'description' => 'The config for jwt.',
                    'source' => __DIR__ . '/../publish/jwt.php',
                    'destination' => BASE_PATH . '/config/autoload/jwt.php',
                ],
            ],
        ];
    }
}