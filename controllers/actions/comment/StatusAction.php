<?php


namespace app\modules\blog\controllers\actions\comment;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Comment;

class StatusAction extends BaseAction
{
    public function run($id, $status)
    {
        $comment = $this->controller->findModel($id);
        switch ($status) {
            case 1:
                $save = $comment->markApproved();
                break;
        }
        if($save){
            return $this->controller->redirect('index');
        }
    }
}