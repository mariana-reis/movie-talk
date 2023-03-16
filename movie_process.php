<?php 
  
  require_once("models/Movie.php");
  require_once("models/Message.php");
  require_once("dao/MovieDAO.php");
  require_once("dao/UserDAO.php");
  require_once("globals.php");
  require_once("db.php");
  
  $message = new Message($BASE_URL);
  $userDAO = new UserDAO($conn, $BASE_URL);
  $movieDao = new movieDAO($conn, $BASE_URL);
  
  $type = filter_input(INPUT_POST, "type");
  
  $userData = $userDAO->verifyToken();
  
  if($type === "create") {
    
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    
    $movie = new Movie();
    
    if(!empty($title) && !empty($description) && !empty($category)) {
      
      $movie->title = $title;
      $movie->description = $description;
      $movie->trailer = $trailer;
      $movie->category = $category;
      $movie->length = $length;
      $movie->users_id = $userData->id;
      
      
      if(isset($_FILES['image'])) {
        $image = $_FILES["image"];
      
        $ext = strtolower(substr($_FILES['image']['name'],-4));
        $new_name = date("Y.m.d-H.i.s") . $ext; 
        $dir = './img/movies/'; 
        move_uploaded_file($_FILES['image']['tmp_name'], $dir.$new_name); 
    
        $movie->image = $new_name;
      }
            
      $movieDao->create($movie);
      
    } else {
      $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria", "error", "back");
    }
  
  
  } else if ($type === "delete") {
    
    $id = filter_input(INPUT_POST, "id");
    
    $movie = $movieDao->findById($id);
    
    if($movie) {
      
      if($movie->users_id === $userData->id) {
        
        $movieDao->destroy($movie->id);
      
      } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
      }
      
    } else {
      $message->setMessage("Informações inválidas!", "error", "index.php");
    }
  
  } else if ($type === "update") {
    
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    $id = filter_input(INPUT_POST, "id");
    
    $movieData = $movieDao->findById($id);
    
    if($movieData) {
      
      if($movieData->users_id === $userData->id) {
        
        if(!empty($title) && !empty($description) && !empty($category)) {
        
          $movieData->title = $title;
          $movieData->description = $description;
          $movieData->trailer = $trailer;
          $movieData->category = $category;
          $movieData->length = $length;
          
          if(isset($_FILES['image'])) {
            $image = $_FILES["image"];
          
            $ext = strtolower(substr($_FILES['image']['name'],-4)); 
            $new_name = date("Y.m.d-H.i.s") . $ext; 
            $dir = './img/movies/';
     
            move_uploaded_file($_FILES['image']['tmp_name'], $dir.$new_name); 
            
            $movieData->image = $new_name;
          }      

        
          $movieDao->update($movieData);
          
        } else {
          $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria", "error", "back");
        }
        
      } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
      }
    
    } else {
      $message->setMessage("Informações inválidas!", "error", "index.php");
    }
  
  } else {
  
    $message->setMessage("Informações inválidas!", "error", "index.php");
    
  }