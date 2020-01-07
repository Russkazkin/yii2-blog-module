<?php


namespace app\modules\blog\widgets\assets;


use bizley\quill\Quill;
use yii\web\AssetBundle;

class QuillLocalAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/blog/widgets/assets/resources';

    /**
     * @var string CDN URL.
     * @since 2.0
     */
    public $url = 'https://cdn.quilljs.com/';

    /**
     * @var string version to fetch from CDN.
     * Version different from default for this release might not work correctly.
     * @since 2.0
     */
    public $version;

    /**
     * @var string editor theme
     */
    public $theme;

    /**
     * Register CSS and JS file based on theme and version.
     * @param \yii\web\View $view the view that the asset files are to be registered with.
     */
    public function registerAssetFiles($view)
    {
        switch ($this->theme) {
            case Quill::THEME_SNOW:
                $this->css = [ 'quill.snow.css'];
                break;

            case Quill::THEME_BUBBLE:
                $this->css = ['quill.bubble.css'];
                break;

            default:
                $this->css = ['quill.core.css'];
        }

        $this->js = ['quill.min.js'];

        parent::registerAssetFiles($view);
    }
}