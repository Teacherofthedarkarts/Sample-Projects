<div class="header">
    <h1>ACME Parking</h1>
    <div>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo "Welcome, " . $_SESSION['username'];
        }
        ?>
    </div>

</div>