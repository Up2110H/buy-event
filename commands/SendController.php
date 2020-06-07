<?php


namespace app\commands;


use app\models\Buy;
use app\models\User;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class SendController extends Controller
{
    /**
     * @var int user id in `user` table (example: --user=1)
     * if not set, all users will be selected
     */
    public $user;

    public function options($actionID)
    {
        return ['user'];
    }

    /**
     * Sends a recent purchase email
     * @return int
     */
    public function actionMail()
    {

        $users = $this->findUsers();

        if (count($users)) {
            Console::startProgress(1, count($users));
            for ($i = 0; $i < count($users); $i++) {

                $purchase = Buy::find()
                    ->where(['user_id' => $users[$i]->id])
                    ->orderBy('id DESC')
                    ->one();

                if ($purchase) {
                    $this->sendMail($users[$i], $purchase);
                }

                usleep(1000);
                Console::updateProgress($i + 1, count($users));
            }
            Console::endProgress();
        }

        return ExitCode::OK;
    }

    /**
     * Sends a recent purchase message to a phone number
     * @return int
     */
    public function actionSms()
    {

        $users = $this->findUsers();

        if (count($users)) {
            Console::startProgress(1, count($users));
            for ($i = 0; $i < count($users); $i++) {

                $purchase = Buy::find()
                    ->where(['user_id' => $users[$i]->id])
                    ->orderBy('id DESC')
                    ->one();

                if ($purchase) {
                    $this->sendSms($users[$i], $purchase);
                }

                usleep(1000);
                Console::updateProgress($i + 1, count($users));
            }
            Console::endProgress();
        }

        return ExitCode::OK;
    }

    private function findUsers()
    {
        if ($this->user) {
            if (($model = User::findOne($this->user)) !== null) {
                return [$model];
            }

            $this->stdout("user with such id does not exist\n", Console::FG_RED);

            return [];
        }

        return User::find()->all();
    }

    private function sendMail(User $user, Buy $purchase)
    {
        $text = '<b>You have been bought<br>' .
            'product: ' . $purchase->product . '<br>' .
            'with price: ' . $purchase->price . '$</b>';

        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['mail'])
            ->setTo($user->email)
            ->setSubject('Purchase of product')
            ->setHtmlBody($text)
            ->send();
    }

    private function sendSms(User $user, Buy $purchase)
    {
        $text = '<b>You have been bought<br>' .
            'product: ' . $purchase->product . '<br>' .
            'with price: ' . $purchase->price . '$</b>';


        Yii::$app->sms->compose()
            ->setFrom(Yii::$app->params['phone'])
            ->setTo($user->phone)
            ->setMessage($text)
            ->send();
    }
}