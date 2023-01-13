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
        return drupal_get_path('module', 'ckeditor_forms') . '/js/forms.js';
    }

    /**
     * {@inheritdoc}
     */
    public function getButtons()
    {
        $libraryUrl = $this->getLibraryUrl();

        return [
            'Form Elements' => array(
                'label' => $this->t('Form Elements'),
                'image' => $libraryUrl . '/icons/form.png',
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

    /**
     * Get the CKEditor Form Elements library URL.
     */
    protected function getLibraryUrl()
    {

        $originUrl = \Drupal::request()->getSchemeAndHttpHost() . \Drupal::request()->getBaseUrl();

        $librarayPath = DRUPAL_ROOT . '/libraries/forms';
        $librarayUrl = $originUrl . '/libraries/forms';

        // Is the library found in the root libraries path.
        $libraryFound = file_exists($librarayPath . '/plugin.js');

        // If library is not found, then look in the current profile libraries path.
        if (!$libraryFound) {
            if ($installProfile = \Drupal::installProfile()) {
                $profilePath = drupal_get_path('profile', $installProfile);
                $profilePath .= '/libraries/forms';

                // Is the library found in the current profile libraries path.
                if (file_exists(DRUPAL_ROOT . '/' . $profilePath . '/plugin.js')) {
                    $libraryFound = TRUE;
                    $librarayUrl = $originUrl . '/' . $profilePath;
                }
            }
        }

        if ($libraryFound) {
            return $librarayUrl;
        } else {
            return $originUrl . '/libraries/forms';
        }
    }
}
