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

//            $connection = Yii::$app->getDb();
//            $command = $connection->createCommand('INSERT INTO `ss_city` (`name`, `notGhost`) VALUES("Киев", 1);');
//            $command->execute();
//
//            $command = $connection->createCommand('INSERT INTO `ss_stocktype` (`name`) VALUES("Местные услуги");');
//            $command->execute();
//            $command = $connection->createCommand(
//                'INSERT INTO `ss_user`
//            (`email`, `password`, `role`, `confirmed`, `status`, `registrationDate`, `name`, `phone`, `secondPhone`, `stockTypeId`, `cityId`, `inn`, `site`) VALUES
//            ("admin@superdeal.com.ua", "$2y$13$0p7NEpaaTFSQFL/oczGkNupq3Ey/Jgmt4dQSM0YyYIhBFEzoo.jRS", "ADMIN", 1, "ACTIVE", "2016-06-08 15:08:32", "Admin", "+380111111111", NULL, NULL, NULL, NULL, NULL);'
//            );
//            $command->execute();
//            $command = $connection->createCommand(
//                'INSERT INTO `ss_user`
//            (`email`, `password`, `role`, `confirmed`, `status`, `registrationDate`, `name`, `phone`, `secondPhone`, `stockTypeId`, `cityId`, `inn`, `site`) VALUES
//            ("marketing@superdeal.com.ua", "$2y$13$.GzcUvS9rAhFaXDmC9COk.mt9UHhIY4SL/YNMkt5EWjFzpPS7S5US", "MODERATOR", 1, "ACTIVE", "2016-06-08 15:08:32", "Moderator", "+380111111111", NULL, NULL, NULL, NULL, NULL);'
//            );
//            $command->execute();
//            $command = $connection->createCommand('INSERT INTO `ss_auth_assignment` VALUE ("admin", 1, unix_timestamp());');
//            $command->execute();
//            $command = $connection->createCommand('INSERT INTO `ss_auth_assignment` VALUE ("moderator", 2, unix_timestamp());');
//            $command->execute();
//            $connection->close();
            $auth->assign($moderator, 2);
            $auth->assign($admin, 1);

        }
    }