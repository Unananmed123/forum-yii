<?php
/** @var $sections */
?>

<div class="forumHead">
    <h2 class="title"> Всего разделов сейчас: <?= count($sections) ?> </h2>
    <?php if (!Yii::$app->user->isGuest): ?>
        <a href="/forum/create-section" class="btn">Создать раздел</a>
    <?php endif; ?>
</div>
<div class="forum_sections">
    <?php if ($sections): ?>
        <?php foreach ($sections as $section): ?>
            <a href="/forum/subsections?id=" <?= $section->id ?> class="forum_section">
                <h3><?= $section->title ?></h3>
                <span><?= $section->desc ?></span>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div>Записей пока что нет</div>
    <?php endif; ?>
</div>