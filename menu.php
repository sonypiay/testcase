<?php
$dirpath = basename( realpath( __DIR__ ) );

$link = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $dirpath;
?>
<header class="uk-navbar-container">
  <div class="uk-container">
    <nav class="uk-navbar">
      <ul class="uk-navbar-nav">
        <li><a href="<?php echo $link . '/fakultas'; ?>">Fakultas</a></li>
        <li><a href="<?php echo $link . '/student'; ?>">Mahasiswa</a></li>
      </ul>
    </nav>
  </div>
</header>
