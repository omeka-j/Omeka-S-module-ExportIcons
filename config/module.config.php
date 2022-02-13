<?php
namespace ExportIcons;

return [
    'view_manager' => [
        'template_path_stack' => [
            OMEKA_PATH . '/modules/ExportIcons/view',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'ExportIcons' => View\Helper\ExportIcons::class,
        ]
    ],
    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => dirname(__DIR__) . '/language',
                'pattern' => '%s.mo',
                'text_domain' => null,
            ],
        ],
    ],
    "ExportIcons" => [
        "config" => [
            "ExportIcons_rdf_show" => "1",
            "ExportIcons_text_show" => "1",
            "ExportIcons_tei_property" => "",
            "ExportIcons_tapas_property" => "",
            "ExportIcons_rtf_property" => "",
            "ExportIcons_mirador_property" => "",
            "ExportIcons_citation_show" => "1",
            "ExportIcons_share_show" => "1",
            "ExportIcons_twitter_show" => "1",
            "ExportIcons_facebook_show" => "1",
            "ExportIcons_line_show" => "1",
            "ExportIcons_pocket_show" => "1",
            "ExportIcons_mail_show" => "1"
        ]
    ]
];
