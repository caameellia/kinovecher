<?php
namespace app\commands;
use app\models\User;
use yii\console\Controller;

class AdminController extends Controller
{
    /** Назначить администратора существующему пользователю: php yii admin/promote username */
    public function actionPromote($username)
    {
        $user = User::findByUsername($username);
        if (!$user) {
            $this->stderr("Пользователь не найден.\n");
            return 1;
        }
        $user->role = 'admin';
        if (!$user->save(false, ['role'])) {
            $this->stderr("Не удалось изменить роль.\n");
            return 1;
        }
        $this->stdout("Роль admin назначена пользователю {$username}.\n");
        return 0;
    }
}
