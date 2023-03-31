<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM IA_utilisateurs WHERE unique_id = {$_SESSION['unique_id']}");
            // var_dump($sql);
            // echo mysqli_num_rows($sql);
            // if(mysqli_num_rows($sql)){
              $row = mysqli_fetch_assoc($sql);
            // }
          ?>
          <img src="<?php echo $_SESSION['app_baseURL'].$row['photo_profil']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['prenom']. " " . $row['nom'] ?></span>
            <p><?php echo $row['etat'] ? 'Connecté' : 'Déconnecté'; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Selectionnez un médécin disponible</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="users.js"></script>

</body>
</html>
