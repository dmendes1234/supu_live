<?php
$user_id = $_SESSION['user_id'];
$ret = mysqli_query($con, "select * from users where ID='$user_id'");
$row = mysqli_fetch_array($ret)
?>

<div class="navigation">
    <?php if ($_SESSION['user_type'] == 'admin') { ?>
    <a href="all-events.php" class="nav-item">Početna</a>
    <a href="add-event.php" title="Add new event">Novi događaj</a>
    <a href="orders.php">Narudžbe</a>
    <a href="logout.php" style="float: right;">Odjava</a>
    <div class="search-container">
        <form action="search-result.php" method="post" name="search">
            <input type="text" placeholder="Traži.." name="event_title_search">
            <button type="submit" name="search">Traži</button>
        </form>
    </div>
    <?php } else if ($row > 0 && $_SESSION['user_type'] != 'admin') { ?>
    <a href="index.php">Početna</a>
    <a href="all-events.php">Svi događaji</a>
    <a href="view-category.php?event_category=Glazba">Glazba</a>
    <a href="view-category.php?event_category=Film">Film</a>
    <a href="view-category.php?event_category=Kazalište">Kazalište</a>
    <a href="view-category.php?event_category=Sport">Sport</a>
    <a href="view-category.php?event_category=Turizam">Turizam</a>
    <div class="dropdown1">
        <button class="dropbtn1">Hi <?php echo $_SESSION['username'] ?>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content1">
            <a href="my-tickets.php">Moje ulaznice</a>
            <a href="edit-profile.php">Uredi profil</a>
            <a href="logout.php">Odjava</a>
        </div>
    </div>
    <div class="search-container">
        <form action="search-result.php" method="post" name="search">
            <input type="text" placeholder="Traži.." name="event_title_search">
            <button type="submit" name="search">Traži</button>
        </form>
    </div>
    <?php } else { ?>
    <a href="index.php">Početna</a>
    <a href="all-events.php">Svi događaji</a>
    <a href="view-category.php?event_category=Glazba">Glazba</a>
    <a href="view-category.php?event_category=Film">Film</a>
    <a href="view-category.php?event_category=Kazalište">Kazalište</a>
    <a href="view-category.php?event_category=Sport">Sport</a>
    <a href="view-category.php?event_category=Turizam">Turizam</a>
    <a href="register.php" style="float: right;">Registracija</a>
    <a href="login.php" style="float:right">Prijava</a>
    <div class="search-container">
        <form action="search-result.php" method="post" name="search">
            <input type="text" placeholder="Traži.." name="event_title_search">
            <button type="submit" name="search">Traži</button>
        </form>
    </div>
    <?php } ?>
</div>