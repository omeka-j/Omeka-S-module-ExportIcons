<?php declare(strict_types=1);

namespace ExportIcons\Form;

use Laminas\EventManager\Event;
use Laminas\EventManager\EventManagerAwareTrait;
//use Laminas\Form\Checkbox;
use Laminas\Form\Element;
use Laminas\Form\Form;
use Omeka\Form\Element\PropertySelect;
use Laminas\Form\Fieldset;

//use Omeka\Form\Element\Checkbox;

/**
 * ConfigForm
 * 設定フォーム
 */
class ConfigForm extends Form
{
    use EventManagerAwareTrait;

    public function init(): void
    {
        $this
        // RDF
        ->add([
            'name' => 'rdf_title',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'JSON-LD', // @translate
            ],
            'attributes' => [
                'id' => 'rdf_title',

            ],
        ])
        //// isRdf
        ->add([
            'name' => 'ExportIcons_rdf_show',
            'type' => Element\Checkbox::class,
            'options' => [
                'label' => 'Show rdf icon', // @translate
            ],
            'attributes' => [
                'id' => 'ExportIcons_rdf_show'
            ],
        ])
        // Text
        ->add([
            'name' => 'text_title',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'Text', // @translate
            ],
            'attributes' => [
                'id' => 'text_title',

            ],
        ])
        //// isRdf
        ->add([
            'name' => 'ExportIcons_text_show',
            'type' => Element\Checkbox::class,
            'options' => [
                'label' => 'Show text icon', // @translate
                'info' => 'If unset, following options are ignored.', // @translate
            ],
            'attributes' => [
                'id' => 'ExportIcons_text_show'
            ],
        ])
        // TEI
        ->add([
            'name' => 'ExportIcons_tei_property',
            'type' => PropertySelect::class,
            'options' => [
                'label' => 'Property supplying the url of the TEI', // @translate
                # 'info' => 'External or static manifests can be more customized and may be quicker to be loaded. Usually, the property is "dcterms:hasFormat" or "dcterms:isFormatOf".', // @translate
                'empty_option' => '',
                'term_as_value' => true,
                'use_hidden_element' => true,
            ],
            'attributes' => [
                'id' => 'ExportIcons_tei_property',
                'class' => 'chosen-select',
                'data-placeholder' => 'Select property',
            ],
        ])
        // TAPAS
        ->add([
            'name' => 'ExportIcons_tapas_property',
            'type' => PropertySelect::class,
            'options' => [
                'label' => 'Property supplying the url of the TAPAS', // @translate
                # 'info' => 'External or static manifests can be more customized and may be quicker to be loaded. Usually, the property is "dcterms:hasFormat" or "dcterms:isFormatOf".', // @translate
                'empty_option' => '',
                'term_as_value' => true,
                'use_hidden_element' => true,
            ],
            'attributes' => [
                'id' => 'ExportIcons_tapas_property',
                'class' => 'chosen-select',
                'data-placeholder' => 'Select property',
            ],
        ])
        // RTF
        ->add([
            'name' => 'ExportIcons_rtf_property',
            'type' => PropertySelect::class,
            'options' => [
                'label' => 'Property supplying the url of the RTF', // @translate
                # 'info' => 'External or static manifests can be more customized and may be quicker to be loaded. Usually, the property is "dcterms:hasFormat" or "dcterms:isFormatOf".', // @translate
                'empty_option' => '',
                'term_as_value' => true,
                'use_hidden_element' => true,
            ],
            'attributes' => [
                'id' => 'ExportIcons_rtf_property',
                'class' => 'chosen-select',
                'data-placeholder' => 'Select property',
            ],
        ])
        // Mirador
        ->add([
            'name' => 'ExportIcons_mirador_property',
            'type' => PropertySelect::class,
            'options' => [
                'label' => 'Property supplying the url of the Mirador', // @translate
                # 'info' => 'External or static manifests can be more customized and may be quicker to be loaded. Usually, the property is "dcterms:hasFormat" or "dcterms:isFormatOf".', // @translate
                'empty_option' => '',
                'term_as_value' => true,
                'use_hidden_element' => true,
            ],
            'attributes' => [
                'id' => 'ExportIcons_mirador_property',
                'class' => 'chosen-select',
                'data-placeholder' => 'Select property',
            ],
        ])
        // Citation
        ->add([
            'type' => Fieldset::class,
            'options' => [
                'label' => 'Citation', // @translate
            ],
            'attributes' => [
                //'id' => 'title_citation'
            ],
        ])
        //// isCitation
        ->add([
            'name' => 'ExportIcons_citation_show',
            'type' => Element\Checkbox::class,
            'options' => [
                'label' => 'Show citation icon', // @translate
            ],
            'attributes' => [
                'id' => 'ExportIcons_citation_show'
            ],
        ])
        // Share
        ->add([
            'name' => 'title_share',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'Share', // @translate
            ]
        ])
        //// isShare
        ->add([
            'name' => 'ExportIcons_share_show',
            'type' => Element\Checkbox::class,
            'options' => [
                'label' => 'Show sharing icon', // @translate
                'info' => 'If unset, following options are ignored.', // @translate
            ],
            'attributes' => [
                'id' => 'ExportIcons_share_show'
            ],
        ])
        //// isTwitter
        ->add([
            'name' => 'ExportIcons_twitter_show',
            'type' => Element\Checkbox::class,
            'options' => [
                'label' => 'Show twitter icon', // @translate
            ],
            'attributes' => [
                'id' => 'ExportIcons_twitter_show'
            ],
        ])
        //// isFacebook
        ->add([
            'name' => 'ExportIcons_facebook_show',
            'type' => Element\Checkbox::class,
            'options' => [
                'label' => 'Show facebook icon', // @translate
            ],
            'attributes' => [
                'id' => 'ExportIcons_facebook_show'
            ],
        ])
        //// isLine
        ->add([
            'name' => 'ExportIcons_line_show',
            'type' => Element\Checkbox::class,
            'options' => [
                'label' => 'Show line icon', // @translate
            ],
            'attributes' => [
                'id' => 'ExportIcons_line_show'
            ],
        ])
        //// isPocket
        ->add([
            'name' => 'ExportIcons_pocket_show',
            'type' => Element\Checkbox::class,
            'options' => [
                'label' => 'Show pocket icon', // @translate
            ],
            'attributes' => [
                'id' => 'ExportIcons_pocket_show'
            ],
        ])
        //// isMail
        ->add([
            'name' => 'ExportIcons_mail_show',
            'type' => Element\Checkbox::class,
            'options' => [
                'label' => 'Show mail icon', // @translate
            ],
            'attributes' => [
                'id' => 'ExportIcons_mail_show'
            ],
        ])

        ;
        // 以下そのまま
        $addEvent = new Event('form.add_elements', $this);
        $this->getEventManager()->triggerEvent($addEvent);

        $inputFilter = $this->getInputFilter();
        /*
        $inputFilter
            ->add([
                'name' => 'ExportIcons_url',
                'required' => false,
            ])
        ;
        */

        $filterEvent = new Event('form.add_input_filters', $this, ['inputFilter' => $inputFilter]);
        $this->getEventManager()->triggerEvent($filterEvent);
    }
}
