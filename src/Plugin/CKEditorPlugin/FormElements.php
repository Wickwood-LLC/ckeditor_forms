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
    public function getButtons()
    {
        $library_paths = [
            'libraries/forms',
            'libraries/ckeditor/plugins/forms',
        ];

        $library = FALSE;
        foreach ($library_paths as $library_path) {
            if (file_exists(DRUPAL_ROOT . '/' . $library_path)) {
                $library = $library_path;
                break;
            }
        }

        return [
            'Form Elements' => array(
                'label' => $this->t('Form Elements'),
                'image' => $library . '/icons/form.png',
            ),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function isEnabled(Editor $editor)
    {
        return TRUE;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig(Editor $editor)
    {
        return [];
    }
}
