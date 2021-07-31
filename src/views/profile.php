<h1 class="main-title">This is my profile</h1>
<br>
<span class="main-description">
    My name is <?= $userinfo["name"] ?>, i was born in <?= $userinfo["born"] ?> and my previous jobs were:
    <ul>
        <?php foreach ($userinfo["jobs"] as $job): ?>
            <li><?= $job ?></li>
        <?php endforeach ?>
    </ul>
</span>