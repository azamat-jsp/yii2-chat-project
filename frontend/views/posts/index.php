<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php foreach($models as $index => $model): ?>
  <?php if($model->status == 2): ?>
    <div class="containers" style="background-color:#b49dc1">
    
  <?php else: ?>
    <div class="containers">
  <?php endif; ?>
  <?php if($index % 2 == 0): ?>
    <img src="/images/chat.png" alt="Avatar">
  <?php else: ?>
    <img src="/images/chat.png" alt="Avatar" class="right">
  <?php endif; ?>
  <p><?= $model->content ?></p>
  <span class="time-right"><?= $model->user->username ?></span>
</div>
<?php endforeach; ?>

<?php if(\Yii::$app->user->can('createPost')): ?>
  <form action="/posts/create" id="postForm">
  <label for="subject">content</label>
  <textarea id="content" name="content" required placeholder="Write something.." style="height:200px"></textarea>
  <input type="submit" value="Submit">
</form>
<?php endif; ?>

</div>