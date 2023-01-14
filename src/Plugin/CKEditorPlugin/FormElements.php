<?php

namespace Drupal\ckeditor_forms\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "forms" plugin.
 *
 * @CKEditorPlugin(
 *   id = "ckeditor_forms",
 *   label = @Translation("CKEditor Form Elements"),
 *   module = "ckeditor_forms"
 * )
 */
class FormElements extends CKEditorPluginBase
{

    /**
     * {@inheritdoc}
     */
    public function getFile()
    {
        $plugin_paths = [
            'libraries/forms/plugin.js',
            'libraries/ckeditor/plugins/forms/plugin.js',
        ];

        $plugin = FALSE;
        foreach ($plugin_paths as $plugin_path) {
            if (file_exists(DRUPAL_ROOT . '/' . $plugin_path)) {
                $plugin = $plugin_path;
                break;
            }
        }

        return $plugin;
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(Editor $editor)
    {
        return [
            'fakeobjects',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getButtons()
    {
        $library_paths = [
            'libraries/forms/icons',
            'libraries/ckeditor/plugins/forms/icons',
        ];

        $library = FALSE;
        foreach ($library_paths as $library_path) {
            if (file_exists(DRUPAL_ROOT . '/' . $library_path)) {
                $library = $library_path;
                break;
            }
        }

        return [
            'Button' => [
                'label' => $this->t('Button'),
                'image' => $library . '/button.png',
            ],
            'Checkbox' => [
                'label' => $this->t('Checkbox'),
                'image' => $library . '/checkbox.png',
            ],
            'Form' => [
                'label' => $this->t('Form'),
                'image' => $library . '/form.png',
            ],
            'Hidden Field' => [
                'label' => $this->t('Hidden Field'),
                'image' => $library . '/hiddenfield.png',
            ],
            'Image Button' => [
                'label' => $this->t('Image Button'),
                'image' => $library . '/imagebutton.png',
            ],
            'Radio Button' => [
                'label' => $this->t('Radio Button'),
                'image' => $library . '/radio.png',
            ],
            'Selection Field' => [
                'label' => $this->t('Selection Field'),
                'image' => $library . '/select.png',
            ],
            'Selection Field RTL' => [
                'label' => $this->t('Selection Field RTL'),
                'image' => $library . '/select-rtl.png',
            ],
            'Textarea' => [
                'label' => $this->t('Textarea'),
                'image' => $library . '/textarea.png',
            ],
            'Textarea RTL' => [
                'label' => $this->t('Textarea RTL'),
                'image' => $library . '/textarea-rtl.png',
            ],
            'Text Field' => [
                'label' => $this->t('Text Field'),
                'image' => $library . '/textfield.png',
            ],
            'Text Field RTL' => [
                'label' => $this->t('Text Field RTL'),
                'image' => $library . '/textfield-rtl.png',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig(Editor $editor)
    {
        return [];
    }
}
