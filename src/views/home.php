<h1>This is the Main Page</h1>
<span style="font-size: 18px">My name is <?= $userinfo["fname"] ?> <?= $userinfo["lname"] ?></span><br>
<span style="font-size: 10px">Im a <?= $userinfo["former"] ?> in <?= $userinfo["movie"] ?> movie</span>
<hr style="margin: 10px 0;">
<div class="main-form-div">
    <span class="main-form-title">Join our Community ! :D</span>
    <br>
    <form class="main-form" action="contact" method="post">
        <input class="form-input" name="username" type="text" placeholder="username">
        <br>
        <input class="form-input" name="password" type="password" placeholder="password">
        <br>
        <input class="form-input" name="address" type="text" placeholder="address">
        <br>
        <button class="form-button" name="submit" type="submit">Submit</button>
    </form>
</div>