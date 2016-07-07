<?php
    namespace app\commands;
    use Yii;
    use yii\console\Controller;

    class RbacController extends Controller{
        public function actionInit()
        {
            $auth = Yii::$app->authManager;

            // добавляем разрешение "createPost"
            $createPost = $auth->createPermission('createStock');
            $createPost->description = 'Create a stock';
            $auth->add($createPost);

            // добавляем разрешение "updateStock"
            $updateStock = $auth->createPermission('updateStock');
            $updateStock->description = 'Update stock';
            $auth->add($updateStock);

            // добавляем роль "partner" и даём роли разрешение "createPost"
            $partner = $auth->createRole('partner');
            $auth->add($partner);
            $auth->addChild($partner, $createPost);

            // добавляем роль "moderator" и даём роли разрешение "updateStock"
            $moderator = $auth->createRole('moderator');
            $auth->add($moderator);
            $auth->addChild($moderator, $updateStock);

            $admin = $auth->createRole('admin');
            $auth->add($admin);
            $auth->addChild($admin, $updateStock);
            $auth->addChild($admin, $createPost);



        }
    }