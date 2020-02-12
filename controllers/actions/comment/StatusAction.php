<?php


namespace app\modules\blog\controllers\actions\comment;


use app\modules\blog\controllers\actions\BaseAction;
use yii2mod\moderation\enums\Status;

class StatusAction extends BaseAction
{
    public function run($id, $status)
    {
        $comment = $this->controller->findModel($id);
        switch ($status) {
            case Status::PENDING;
                $save = $comment->markPending();
                break;
            case Status::APPROVED;
                $save = $comment->markApproved();
                break;
            case Status::REJECTED;
                $save = $comment->markRejected();
                break;
            case Status::POSTPONED;
                $save = $comment->markPostponed();
                break;
        }
        if($save){
            return $this->controller->redirect('index');
        }
    }
}