<?php
  require_once("globals.php");
  require_once("db.php");
  require_once("dao/UserDAO.php");
  
  $userDAO = new UserDAO($conn, $BASE_URL);
  
  $userData = $userDAO->verifyToken();

?>


<footer id="footer">
    <div id="social-container">
      <ul>
        <li>
          <a href="#"><i class="fab fa-facebook-square"></i></a>
        </li>
        <li>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </li>
        <li>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </li>
      </ul>
    </div>
    <div id="footer-links-container">
      <ul>
        <li><a href="<?= $BASE_URL ?>index.php">Home</a></li>
        <?php if( $userData == true): ?>
          <li><a href="<?= $BASE_URL ?>newmovie.php">Adicionar filme</a></li>
          <li><a href="<?= $BASE_URL ?>dashboard.php">Meus Filmes</a></li>
        <?php else: ?>
          <li><a href="<?= $BASE_URL ?>auth.php">Entrar / Registrar</a></li>
        <?php endif ?>
      </ul>
    </div>
    <p>&copy; 2023 Mariana Silva</p>
  </footer>
  <!-- bootstrap js  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.js" integrity="sha512-L6XANV6sOsx9N9c787eDN1pjB2Pzautd3xDgn4cMKuoleHSuCJi5pCDGPCtwE3Bd4A1Olnr0k0aQXbczYzg+wg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- end bootstrap js  -->
</body>
</html>
