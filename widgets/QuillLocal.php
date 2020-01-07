<?php


namespace app\modules\blog\widgets;


use app\modules\blog\widgets\assets\QuillLocalAsset;
use bizley\quill\assets\HighlightAsset;
use bizley\quill\assets\KatexAsset;
use bizley\quill\assets\QuillAsset;
use bizley\quill\Quill;
use yii\helpers\Json;
use yii\web\View;

class QuillLocal extends Quill
{
    private $_katex = false;
    private $_highlight = false;

    /**
     * Registers widget assets.
     * Note that Quill works without jQuery.
     */
    public function registerClientScript()
    {
        $view = $this->view;

        if ($this->_katex) {
            $katexAsset = KatexAsset::register($view);
            $katexAsset->version = $this->katexVersion;
        }

        if ($this->_highlight) {
            $highlightAsset = HighlightAsset::register($view);
            $highlightAsset->version = $this->highlightVersion;
            $highlightAsset->style = $this->highlightStyle;
        }

        $asset = QuillLocalAsset::register($view);
        $asset->theme = $this->theme;
        $asset->version = $this->quillVersion;

        $configs = Json::encode($this->_quillConfiguration);
        $editor = 'q_' . preg_replace('~[^0-9_\p{L}]~u', '_', $this->id);

        $js = "var $editor=new Quill(\"#editor-{$this->id}\",$configs);";
        $js .= "document.getElementById(\"editor-{$this->id}\").onclick=function(e){document.querySelector(\"#editor-{$this->id} .ql-editor\").focus();};";
        $js .= "$editor.on('text-change',function(){document.getElementById(\"{$this->_fieldId}\").value=$editor.root.innerHTML;});";

        if (!empty($this->js)) {
            $js .= str_replace('{quill}', $editor, $this->js);
        }

        $view->registerJs($js, View::POS_END);
    }
}