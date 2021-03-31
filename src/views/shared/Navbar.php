<nav class="nav">
    <div class="brand item">
        <a href="/">Company Name</a>
    </div>
    <ul class="navlist">
        <?php if (isset($_SESSION['uid'])): ?>
            <li class="item">
                <a href="/logout">Log Out</a>
            </li>
        <?php else: ?>
            <li class="item">
                <a href="/login">Log In</a>
            </li>
            <li class="item">
                <a href="/register">Register</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
