<?php


namespace app\commands;


use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class UserController extends Controller
{
    /**
     * @var string required, phone number (example: --phone="+123456789")
     */
    public $phone;
    /**
     * @var string required, email address (example: --email="example@test.com")
     */
    public $email;

    public function options($actionID)
    {
        if ($actionID == 'create') {
            return ['phone', 'email'];
        }

        return [];
    }

    /**
     * Creates user by phone number and email
     * @return int
     */
    public function actionCreate()
    {
        if ($this->phone && $this->email) {
            $model = new User();
            $model->phone = $this->phone;
            $model->email = $this->email;

            if ($model->save()) {
                $this->stdout("user was created\n", Console::FG_GREEN);
                return ExitCode::OK;
            }

            $this->stdout("user was not created\n", Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $phoneRed = $this->ansiFormat('--phone', Console::FG_RED);
        $emailRed = $this->ansiFormat('--email', Console::FG_RED);

        echo "$phoneRed and $emailRed parameters required\n";

        return ExitCode::UNSPECIFIED_ERROR;
    }

    /**
     * Shows all users
     */
    public function actionShow()
    {
        $id = $this->ansiFormat('id', Console::FG_YELLOW);
        $phone = $this->ansiFormat('phone', Console::FG_BLUE);
        $email = $this->ansiFormat('email', Console::FG_GREEN);

        echo "$id\t\t$phone\t\t$email\n\n";

        $users = User::find()->all();

        foreach ($users as $user) {
            $id = $this->ansiFormat($user->id, Console::FG_YELLOW);
            $phone = $this->ansiFormat($user->phone, Console::FG_BLUE);
            $email = $this->ansiFormat($user->email, Console::FG_GREEN);

            echo "$id\t\t$phone\t\t$email\n";
        }

        return ExitCode::OK;
    }
}