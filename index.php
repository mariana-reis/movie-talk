<?php
  require_once("templates/header.php");
  require_once("dao/MovieDAO.php");

  $movieDao = new MovieDAO($conn, $BASE_URL);
  
  $userData = $userDAO->verifyToken();
    
  $latestMovies = $movieDao->getLatestMovies();

  $actionMovies = $movieDao->getMoviesByCategory("Ação");

  $comedyMovies = $movieDao->getMoviesByCategory("Comédia");
  
  $fantasyMovies =  $movieDao->getMoviesByCategory("Fantasia / Ficção");
  
  $dramaMovies =  $movieDao->getMoviesByCategory("Drama");
  
  $romanceMovies =  $movieDao->getMoviesByCategory("Romance");
  
  
?>
  <div id="main-container" class="container-fluid">
    <?php if( $userData == false): ?>
      <h2 class="section-title">Papo de Cinema</h2>
      <p class="section-description">
        <a href="<?= $BASE_URL ?>auth.php" class="link-text">Entrar / Registrar</a> para publicar seus filmes favoritos e acompanhar o catálago de avaliações e críticas sobre Filmes!
      </p>
      <div class="image-home"><img src="<?= $BASE_URL ?>img/img-home.png" alt="MovieStar"></div>
    <?php else: ?>
  
      <?php if(!$latestMovies): ?>
        <h2 class="section-title">Olá <?= $userData->name ?> Cadastre novos filme</h2>
        <p class="section-description">Nenhum filme foi cadastrado pelo usuário!</p>
        <div class="image-home"><img src="<?= $BASE_URL ?>img/img-home.png" alt="MovieStar"></div>     
      <?php else: ?>
        <h2 class="section-title">Filmes novos</h2>
        <p class="section-description">Veja as críticas dos últimos filmes adicionados no MovieStar</p>
        <div class="movies-container">
          <?php foreach($latestMovies as $movie): ?>
            <?php require("templates/movie_card.php"); ?>
          <?php endforeach; ?>
          <?php if(count($latestMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes cadastrados!</p>
          <?php endif; ?>
        </div>
        <h2 class="section-title">Ação</h2>
        <p class="section-description">Veja os melhores filmes de ação</p>
        <div class="movies-container">
          <?php foreach($actionMovies as $movie): ?>
            <?php require("templates/movie_card.php"); ?>
          <?php endforeach; ?>
          <?php if(count($actionMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de ação cadastrados!</p>
          <?php endif; ?>
        </div>
        <h2 class="section-title">Comédia</h2>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <div class="movies-container">
          <?php foreach($comedyMovies as $movie): ?>
            <?php require("templates/movie_card.php"); ?>
          <?php endforeach; ?>
          <?php if(count($comedyMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de comédia cadastrados!</p>
          <?php endif; ?>
        </div>
        <h2 class="section-title">Fantasia / Ficção</h2>
        <p class="section-description">Veja os melhores filmes de Fantasia / Ficção</p>
        <div class="movies-container">
          <?php foreach($fantasyMovies as $movie): ?>
            <?php require("templates/movie_card.php"); ?>
          <?php endforeach; ?>
          <?php if(count($fantasyMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de Fantasia / Ficção cadastrados!</p>
          <?php endif; ?>
        </div>
        <h2 class="section-title">Drama</h2>
        <p class="section-description">Veja os melhores filmes de Drama</p>
        <div class="movies-container">
          <?php foreach($dramaMovies as $movie): ?>
            <?php require("templates/movie_card.php"); ?>
          <?php endforeach; ?>
          <?php if(count($dramaMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de Drama cadastrados!</p>
          <?php endif; ?>
        </div>
        <h2 class="section-title">Romance</h2>
        <p class="section-description">Veja os melhores filmes de Romance</p>
        <div class="movies-container">
          <?php foreach($romanceMovies as $movie): ?>
            <?php require("templates/movie_card.php"); ?>
          <?php endforeach; ?>
          <?php if(count($romanceMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes de Romance cadastrados!</p>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      
    <?php endif ?>
  </div>
<?php
  require_once("templates/footer.php");
?>