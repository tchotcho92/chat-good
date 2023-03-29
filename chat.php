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
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM IA_utilisateurs WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql)){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
          $img = $row['photo_profil'] ? $_SESSION['app_baseURL'].$row['photo_profil'] : 'php/images/user.png';
          
        ?>

        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $img ?>" alt="">
        <div class="details">
          <span><?php echo $row['prenom']. " " . $row['nom'] ?></span>
          <p><?php echo $row['etat'] ? 'En Ligne' : 'Hors Ligne' ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
