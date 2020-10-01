<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\rbac\UserGroupRule;
use common\models\User;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        //APPLY THE RULE
        $rule = new UserGroupRule(); //Apply our Rule that use the user roles from user table
        $auth->add($rule);

        // добавляем разрешение "createPost"
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // добавляем разрешение "updatePost"
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // добавляем разрешение "perAdminBack"
        $perAdminBack = $auth->createPermission('per_admin_back');
        $perAdminBack->description = 'can access backend';
        $auth->add($perAdminBack);

         // добавляем разрешение "viewPost"
         $viewPost = $auth->createPermission('viewPost');
         $viewPost->description = 'View post';
         $auth->add($viewPost);

        // добавляем разрешение "viewPost"
        $viewPost = $auth->createPermission('deletePost');
        $viewPost->description = 'Delete post';
        $auth->add($viewPost);

        // добавляем роль "author" и даём роли разрешение "createPost"
        $author = $auth->createRole('author');
        $auth->add($author);
        $author->ruleName = $rule->name;
        $auth->addChild($author, $createPost);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $admin->ruleName = $rule->name;
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $perAdminBack);
        $auth->addChild($admin, $author);

        //Создание пользователя с ролю admin
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@admin.com';
        $user->setPassword('12121212');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();

        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $user->getId());

        //Создание пользователя с ролю author
        $user = new User();
        $user->username = 'user';
        $user->email = 'user@mail.com';
        $user->setPassword('12121212');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();

        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('author');
        $auth->assign($authorRole, $user->getId());

    }
}