<?php
include('header.php');
?>
<div>
<form class="post-form" action="data.php" method="POST">
    <h2>Yangi Post</h2>
      <label> for="sarlavha">Sarlavha</label>
      <input type="text" id="sarlavha" name="sarlavha" required>

      <label for="matn">Matn</label>
      <textarea id="matn" name="matn" rows="6" required>

      </textarea>

      <button type="submit">Yuborish</button>
    </form>
    </div>