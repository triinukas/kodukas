<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
  <a class="navbar-brand" href="index.php">
        <img src="images/T.svg" alt="T" width="auto">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="search.php">Otsing</a>
        </li>
        <?php   
            if(!isset($_SESSION["username"])){ 
                echo "<li class='nav-item'>";
                echo "<a class='nav-link' href='signIn.php'>Logi sisse</a>";
                echo "</li>";
            }
        ?>
        <!-- <li class="nav-item">
          <a class="nav-link" href="signIn.php">Logi sisse</a>
        </li> -->
        <?php   
            if(!isset($_SESSION["username"])){ 
                echo "<li class='nav-item'>";
                echo "<a class='nav-link' href='signUp.php'>Registreeri</a>";
                echo "</li>";
            }
        ?>
        <!-- <li class="nav-item">
          <a class="nav-link" href="signUp.php">Registreeri</a>
        </li> --> 
        <?php   
            if(!isset($_SESSION["isTutor"]) || $_SESSION["isTutor"] == false){ 
                echo "<li class='nav-item'>";
                echo "<a class='nav-link' href='joinToTutors.php'>Liitu õpetajana</a>";
                echo "</li>";
            }
        ?>
        <!-- <li class="nav-item">  
          <a class="nav-link" href="joinToTutors.php">Liitu õpetajana</a>
        </li> -->
        <?php   
            if(isset($_SESSION["username"])){ 
                echo "<li class='nav-item'>";
                echo "<a class='nav-link' href='profile.php'>Profiil</a>";
                echo "</li>";
            }
        ?>
        <!-- <li class="nav-item">
          <a class="nav-link" href="profile.php">Profiil</a>
        </li> -->
        <?php
            if(isset($_SESSION["username"])){ 
                echo "<li class='nav-item'>";
                echo "<a id='btnLogout' class='nav-link' href='signIn.php'>Logi välja</a>";
                echo "</li>";
            }
        ?>
      </ul>
    </div>
</nav>
<script>
    //logout
    $("#btnLogout").click(function(){
        $.ajax({
            type: "GET",
            url: 'logout.php',
            data: ({ logout : 1 }),
            dataType: "html"
        });
    });
</script>


