<?php require "components/head.php" ?>
<?php require "components/navbar.php" ?>
<h2>Secret ski</h2>
<p><?php echo "Hi, ".($_SESSION["email"] ?? "guest");?></p>
<form action="/logout" method="POST">
    <button>Logout</button>
</form>
<?php require "components/footer.php" ?>