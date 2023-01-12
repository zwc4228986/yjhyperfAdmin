<?php
namespace YjHyperfAdminPligin\Generator;


class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'publish' => [
                [
                    'id' => 'generator',
                    'description' => 'The config for email.',
                    'source' => __DIR__ . '/../publish/generator.php',
                    'destination' => BASE_PATH . '/config/autoload/generator.php',
                ],
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'command' => [
            ]
        ];
    }
}