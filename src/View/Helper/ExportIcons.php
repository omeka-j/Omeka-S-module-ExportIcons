<?php
namespace ExportIcons\View\Helper;

use Omeka\Api\Representation\AbstractResourceEntityRepresentation;
use Laminas\View\Helper\AbstractHelper;

class ExportIcons extends AbstractHelper
{
    public function __invoke(AbstractResourceEntityRepresentation $resource)
    {
        $view = $this->getView();

        //アセットのURL
        $assetUrl = $view->plugin('assetUrl');
        $asset = $assetUrl('', 'ExportIcons', false, false)."img/icon";

        // common

        $title = $resource->displayTitle();
        $url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://").$_SERVER["HTTP_HOST"].$resource->url();

        // Text

        $options = [
            "tei" => ["label" => "Text Encoding Initiative", "icon" => $asset."/Text_Encoding_InitiativeTEI_Logo.svg"],
            "tapas" => [
                "label" => "TAPAS",
                "icon" => $asset."/logo_tapas.png"
            ],
            "rtf" => [
                "label" => "Rich Text Format",
                "icon" => $asset."/rtf-file-symbol-svgrepo-com.svg"
            ],
            "mirador" => [
                "label" => "Mirador",
                "icon" => $asset."/mirador.svg"
            ]
        ];

        $text = [
            "show" => $view->setting("ExportIcons_text_show"),
            "values" => []
        ];

        foreach ($options as $key => $v) {
            $property = $view->setting("ExportIcons_".$key."_property");
            $textUrl = "";

            foreach ($resource->value($property, ['all' => true]) as $value) {
                if ($value->type() === 'uri') {
                    $textUrl = $value->uri();
                    break;
                }
            }

            if ($textUrl != "") {
                $text["values"][$key] = [
                    "label" => $v["label"],
                    "icon" => $v["icon"],
                    "url" => $textUrl
                ];
            }
        }

        // Share

        $keys = [
            "twitter" => ["label" => "Twitter", "url" => "https://twitter.com/intent/tweet?url=".$url."&text=".$title],
            "facebook" => ["label" => "Facebook", "url" => "https://www.facebook.com/sharer/sharer.php?u=".$url],
            "line" => ["label" => "Line", "url" => "http://line.me/R/msg/text/?".$url],
            "pocket" => ["label" => "Pocket", "url" => "http://getpocket.com/edit?url=".$url],
            "mail" => ["label" => "Mail", "url" => "mailto:?body=".$url]
        ];

        $share = [
            "show" => $view->setting('ExportIcons_share_show'),
            "values" => []
        ];

        foreach ($keys as $key => $v) {
            $show = $view->setting('ExportIcons_'.$key."_show");
            if ($show) {
                $share["values"][$key] = [
                    "label" => $v["label"],
                    "url" => $v["url"]
                ];
            }
        }

        //

        $citation = [
            "show" => $view->setting("ExportIcons_citation_show"),
            "url" => $url,
            "title" => $title
        ];

        //

        $rdf = [
            "show" => $view->setting("ExportIcons_rdf_show"),
            "uri" => $resource->apiUrl(),
            "icon" => $asset.'/Rdf_logo.svg'
        ];

        //

        $results = [
            "rdf" => $rdf,
            "text" => $text,
            "share" => $share,
            'citation' =>  $citation,
            "asset" => $asset
        ];

        return $view->partial(
            'common/export-icons',
            $results
        );
    }
}
