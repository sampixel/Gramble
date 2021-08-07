<div>
    <?php if (!empty($submitted)): ?>
        <h3>Cogratulations <?= $submitted["username"] ?> !</h3>
        <span>These are your credentials:</span>
        <br>
        <ul>
            <li>Password: <?= $submitted["password"] ?></span></li>
            <li>Address: <?= $submitted["address"] ?></span></li>
        </ul>
    <?php else: ?>
        <span>Cannot get post data</span>
    <?php endif ?>
</div>