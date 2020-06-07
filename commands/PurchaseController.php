<?php


namespace app\commands;


use app\models\Buy;
use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class PurchaseController extends Controller
{
    /**
     * @var int required, user id in `user` table (example: --user=1)
     */
    public $user;
    /**
     * @var string required, product name (example: --product="milk")
     */
    public $product;

    /**
     * @var int required, product price in dollars (example: --price="5")
     */
    public $price;

    public function options($actionID)
    {
        if ($actionID == 'create') {
            return ['user', 'product', 'price'];
        }

        return [];
    }

    /**
     * Creates purchase by user id, product name and product price
     * @return int
     */
    public function actionCreate()
    {
        if ($this->user && $this->product && $this->price) {
            $user = User::findOne($this->user);

            if (!$user) {
                $this->stdout("user with such id does not exist\n", Console::FG_RED);
                return ExitCode::UNSPECIFIED_ERROR;
            }

            $model = new Buy();
            $model->user_id = $user->id;
            $model->product = $this->product;
            $model->price = $this->price;

            if ($model->save()) {
                $this->stdout("purchase has been added\n", Console::FG_GREEN);
                return ExitCode::OK;
            }

            $this->stdout("purchase has not been not added\n", Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $user = $this->ansiFormat('--user', Console::FG_RED);
        $productRed = $this->ansiFormat('--product', Console::FG_RED);
        $priceRed = $this->ansiFormat('--price', Console::FG_RED);

        echo "$user, $productRed and $priceRed parameters required\n";

        return ExitCode::UNSPECIFIED_ERROR;
    }

    /**
     * Shows all purchases
     */
    public function actionShow()
    {
        $id = $this->ansiFormat('id', Console::FG_YELLOW);
        $user_id = $this->ansiFormat('user_id', Console::FG_BLUE);
        $product = $this->ansiFormat('product', Console::FG_GREEN);
        $price = $this->ansiFormat('price', Console::FG_PURPLE);

        echo "$id\t\t$user_id\t\t$product\t\t$price\n\n";

        $purchases = Buy::find()->all();

        foreach ($purchases as $purchase) {
            $id = $this->ansiFormat($purchase->id, Console::FG_YELLOW);
            $user_id = $this->ansiFormat($purchase->user_id, Console::FG_BLUE);
            $product = $this->ansiFormat($purchase->product, Console::FG_GREEN);
            $price = $this->ansiFormat($purchase->price, Console::FG_PURPLE);

            echo "$id\t\t$user_id\t\t$product\t\t$price\n";
        }

        return ExitCode::OK;
    }
}