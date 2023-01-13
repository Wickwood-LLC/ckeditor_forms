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
        return $this->getLibraryPath() . '/plugin.js';
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
     * Get the CKEditor Form Elements library path.
     */
    protected function getLibraryPath()
    {
        // Following the logic in Drupal 8.9.x and Drupal 9.x
        // ----------------------------------------------------------------------
        // Issue #3096648: Add support for third party libraries in site specific
        // and install profile specific libraries folders
        // https://www.drupal.org/project/drupal/issues/3096648
        //
        // https://git.drupalcode.org/project/drupal/commit/1edf15f
        // -----------------------------------------------------------------------
        // Search sites/<domain>/*.
        $directories[] = \Drupal::service('site.path') . "/libraries/";

        // Always search the root 'libraries' directory.
        $directories[] = 'libraries/';

        // Installation profiles can place libraries into a 'libraries' directory.
        if ($installProfile = \Drupal::installProfile()) {
            $profile_path = drupal_get_path('profile', $installProfile);
            $directories[] = "$profile_path/libraries/";
        }

        foreach ($directories as $dir) {
            if (file_exists(DRUPAL_ROOT . '/' . $dir . 'forms/plugin.js')) {
                return $dir . 'forms';
            }
        }

        return 'libraries/forms';
    }


    /**
     * Get the CKEditor Form Elements library URL.
     */
    protected function getLibraryUrl()
    {

        $originUrl = \Drupal::request()->getSchemeAndHttpHost() . \Drupal::request()->getBaseUrl();

        $libraryPath = DRUPAL_ROOT . '/libraries/forms';
        $libraryUrl = $originUrl . '/libraries/forms';

        // Is the library found in the root libraries path.
        $libraryFound = file_exists($libraryPath . '/plugin.js');

        // If library is not found, then look in the current profile libraries path.
        if (!$libraryFound) {
            if ($installProfile = \Drupal::installProfile()) {
                $profilePath = drupal_get_path('profile', $installProfile);
                $profilePath .= '/libraries/forms';

                // Is the library found in the current profile libraries path.
                if (file_exists(DRUPAL_ROOT . '/' . $profilePath . '/plugin.js')) {
                    $libraryFound = TRUE;
                    $libraryUrl = $originUrl . '/' . $profilePath;
                }
            }
        }

        if ($libraryFound) {
            return $libraryUrl;
        } else {
            return $originUrl . '/libraries/forms';
        }
    }
}
