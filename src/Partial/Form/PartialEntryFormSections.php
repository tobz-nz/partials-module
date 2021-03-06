<?php namespace Anomaly\PartialsModule\Partial\Form;

use Anomaly\PartialsModule\Partial\PartialModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class PartialEntryFormSections
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PartialsModule\Partial\Form
 */
class PartialEntryFormSections
{

    /**
     * Handle the form sections.
     *
     * @param PartialEntryFormBuilder $builder
     */
    public function handle(PartialEntryFormBuilder $builder)
    {
        $builder->setSections(
            [
                'general' => [
                    'tabs' => [
                        'general' => [
                            'title'  => 'module::tab.partial',
                            'fields' => [
                                'partial_name',
                                'partial_slug'
                            ]
                        ],
                        'content' => [
                            'title'  => 'module::tab.content',
                            'fields' => function (PartialEntryFormBuilder $builder) {
                                return array_map(
                                    function (FieldType $field) {
                                        return 'entry_' . $field->getField();
                                    },
                                    array_filter(
                                        $builder->getFormFields()->all(),
                                        function (FieldType $field) {
                                            return (!$field->getEntry() instanceof PartialModel);
                                        }
                                    )
                                );
                            }
                        ],
                        'css'     => [
                            'title'  => 'module::tab.css',
                            'fields' => [
                                'partial_css'
                            ]
                        ],
                        'js'      => [
                            'title'  => 'module::tab.js',
                            'fields' => [
                                'partial_js'
                            ]
                        ]
                    ]
                ]
            ]
        );
    }
}
