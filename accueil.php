<?php
session_start(); 
if($_SESSION['user_email']==""){
	header('location:index.php');

}
include_once('conn/connection.php');
include ('classDocMat.php');


include ('mail.php');
$sql = "SELECT * FROM Materiel";

try{
    
  $stmt = $conn->query($sql);
  
  if($stmt === false){
   die("Erreur");
  }
  
 }catch (PDOException $e){
   echo $e->getMessage();
 }

 $sql_autre_table = "SELECT * FROM Document"; // Remplacez AutreTable par le nom de votre deuxième table
try {
  $stmt2 = $conn->query($sql_autre_table);
  
  if($stmt2 === false) {
      die("Erreur lors de la sélection de la deuxième table");
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
$mat= new Materiel();
if (isset($_GET['search'])) {
  $searchTerm = $_GET['search'];
  $searchResults = $mat->retrieve($searchTerm);
} else {
  $sql = "SELECT * FROM Materiel";
}

$sql = "SELECT COUNT(*) AS total FROM Materiel";
$sql1 = "SELECT COUNT(*) AS total FROM Document";
$result = $conn->query($sql);
$result1 = $conn->query($sql1);

// Vérifier si la requête a réussi

    // Récupérer la somme
    $row = $result->fetch();
    $row1 = $result1->fetch();
    $total = $row['total'] + $row1['total'];
?>
<!DOCTYPE html> 
<html lang="en"> 
  <head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge"> 
    <meta name="viewport" 
          content="width=device-width,  
                   initial-scale=1.0"> 
    <title>RappelTout</title> 
   
    
    <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
    
    <link rel="stylesheet" 
          href="style.css"> 
    <link rel="stylesheet" 
          href="responsive.css"> 
          <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,600,0,0" />
          <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head> 
  <style>
    @import url( 
"https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"); 
  
* { 
  margin: 0; 
  padding: 0; 
  box-sizing: border-box; 
  font-family: "Poppins", sans-serif; 
} 
:root { 
  --background-color1: #08232f; 
  --background-color2: #ffffff; 
  --background-color3: #ededed; 
  --background-color4: #a4a6ad5b; 
  --primary-color: #4b49ac; 
  --secondary-color: #0c007d; 
  --Border-color: #08232f; 
  --one-use-color: #08232f; 
  --two-use-color: #08232f; 
} 
body { 
  background-color: var(--background-color4); 
  max-width: 100%; 
  overflow-x: hidden; 
} 
  
header { 
  height: 70px; 
  width: 100vw; 
  padding: 0 30px; 
  background-color: var(--background-color1); 
  position: fixed; 
  z-index: 100; 
  box-shadow: 1px 1px 15px rgba(161, 182, 253, 0.825); 
  display: flex; 
  justify-content: space-between; 
  align-items: center; 
} 
  
.logo { 
  font-size: 27px; 
  font-weight: 600; 
  color: #fff; 
} 
  
.icn { 
  height: 30px; 
} 
.menuicn { 
  cursor: pointer; 
} 
  
.searchbar, 
.message, 
.logosec { 
  display: flex; 
  align-items: center; 
  justify-content: center; 
} 
  
.searchbar2 { 
  display: none; 
} 
  
.logosec { 
  gap: 60px; 
} 
  
.searchbar input { 
  width: 250px; 
  height: 42px; 
  border-radius: 50px 0 0 50px; 
  background-color: var(--background-color3); 
  padding: 0 20px; 
  font-size: 15px; 
  outline: none; 
  border: none; 
} 
.searchbtn { 
  width: 50px; 
  height: 42px; 
  display: flex; 
  align-items: center; 
  justify-content: center; 
  border-radius: 0px 50px 50px 0px; 
  background-color: var(--secondary-color); 
  cursor: pointer; 
} 
  
.message { 
  gap: 40px; 
  position: relative; 
  cursor: pointer; 
} 
.circle { 
  height: 7px; 
  width: 7px; 
  position: absolute; 
  background-color: #ff2222; 
  border-radius: 50%; 
  left: 19px; 
  top: 8px; 
} 
.dp { 
  height: 40px; 
  width: 40px; 
  background-color: #626262; 
  border-radius: 50%; 
  display: flex; 
  align-items: center; 
  justify-content: center; 
  overflow: hidden; 
} 
.main-container { 
  display: flex; 
  width: 100vw; 
  position: relative; 
  top: 70px; 
  z-index: 1; 
} 
.dpicn { 
  height: 42px; 
} 
  
.main { 
  height: calc(100vh - 70px); 
  width: 100%; 
  overflow-y: scroll; 
  overflow-x: hidden; 
  padding: 40px 30px 30px 30px; 
} 

h3{
  font-size: 18px;
 
}
  
.main::-webkit-scrollbar-thumb { 
  background-image:  
        linear-gradient(to bottom, rgb(0, 0, 85), rgb(0, 0, 50)); 
} 
.main::-webkit-scrollbar { 
  width: 5px; 
} 
.main::-webkit-scrollbar-track { 
  background-color: #9e9e9eb2; 
} 
  
.box-container { 
  display: flex; 
  justify-content: space-evenly; 
  align-items: center; 
  flex-wrap: wrap; 
  gap: 50px; 
} 
.nav { 
  min-height: 91vh; 
  width: 250px; 
  background-color: var(--background-color2); 
  position: absolute; 
  top: 0px; 
  left: 00; 
  box-shadow: 1px 1px 10px rgba(198, 189, 248, 0.825); 
  display: flex; 
  flex-direction: column; 
  justify-content: space-between; 
  overflow: hidden; 
  padding: 30px 0 20px 10px; 
} 
.navcontainer { 
  height: calc(100vh - 70px); 
  width: 350px; 
  position: relative; 
  overflow-y: scroll; 
  overflow-x: hidden; 
  transition: all 0.5s ease-in-out; 
} 
.navcontainer::-webkit-scrollbar { 
  display: none; 
} 
.navclose { 
  width: 70px; 
} 
.nav-option { 

  width: 300px; 
  height: 60px; 
  display: flex; 
  align-items: center; 
  padding: 0 30px 0 20px; 
  gap: 20px; 
  transition: all 0.1s ease-in-out; 
} 
.logout { 

  width: 255px;
  height: 60px; 
  display: flex; 
  align-items: center; 
  padding: 0 30px 0 20px; 
  gap: 20px; 
  transition: all 0.1s ease-in-out; 
} 
.logout:hover { 
  border-left: 5px solid #a2a2a2; 
  background-color: #dadada; 
  cursor: pointer; 
} 
.tablinks { 
  font-size: 4px;
  
  width: 500px; 
  height: 60px; 
  display: flex; 
  align-items: center; 
  padding: 0 30px 0 20px; 
  gap: 25px;
  transition: all 0.1s ease-in-out; 
  
} 
.tablinks:hover { 
  border-left: 5px solid #a2a2a2; 
  background-color: #dadada; 
  cursor: pointer; 
} 
.nav-img { 
  height: 30px; 
} 
  
.nav-upper-options { 
  display: flex; 
  flex-direction: column; 
  align-items: center; 
  gap: 30px; 
} 
.nav-upper-options  .nav-option .tablinks.active
 { 
  border-left: 5px solid #010058af; 
  background-color: var(--Border-color); 
  color: white; 
  cursor: pointer; 

  border-left: 5px solid #010058af; 
  background-color: var(--Border-color); 
} 
.box { 
  height: 130px; 
  width: 230px; 
  border-radius: 20px; 
  box-shadow: 3px 3px 10px rgba(0, 30, 87, 0.751); 
  padding: 20px; 
  display: flex; 
  align-items: center; 
  justify-content: space-around; 
  cursor: pointer; 
  transition: transform 0.3s ease-in-out; 
} 

  
.box:nth-child(1) { 
  background-color: var(--one-use-color); 
} 
.box:nth-child(2) { 
  background-color: var(--two-use-color); 
} 
.box:nth-child(3) { 
  background-color: var(--one-use-color); 
} 

  
.box img { 
  height: 50px; 
} 
.box .text { 
  color: white; 
} 
.topic { 
  font-size: 13px; 
  font-weight: 400; 
  letter-spacing: 1px; 
} 
  
.topic-heading { 
  font-size: 30px; 
  letter-spacing: 3px; 
} 
  
.report-container { 
  min-height: 300px; 
  max-width: 1200px; 
  margin: 70px auto 0px auto; 
  background-color: #ffffff; 
  border-radius: 30px; 
  box-shadow: 3px 3px 10px rgb(188, 188, 188); 
  padding: 0px 20px 20px 20px; 
} 
.report-header { 
  height: 80px; 
  width: 100%; 
  display: flex; 
  align-items: center; 
  justify-content: space-between; 
  padding: 20px 20px 10px 20px; 
  border-bottom: 2px solid rgba(0, 20, 151, 0.59); 
} 
  
.recent-Articles { 
  font-size: 30px; 
  font-weight: 600; 
  color: #010058af; 
} 
  
.view { 
  height: 35px; 
  width: 90px; 
  border-radius: 8px; 
  background-color: #5500cb; 
  color: white; 
  font-size: 15px; 
  border: none; 
  cursor: pointer; 
} 
  
.report-body { 
  max-width: 1200px; 
  overflow-x: auto; 
 
} 
.report-topic-heading, 
.item1 { 
  width: 1120px; 
  display: flex; 
  justify-content: space-between; 
  align-items: center; 
} 
.t-op { 
  font-size: 18px; 
  letter-spacing: 0px; 
} 
  
.items { 
  width: 1160px; 
  
} 
  
.item1 { 
  margin-top: 20px; 
} 
.t-op-nextlvl { 
  font-size: 14px; 
  letter-spacing: 0px; 
  font-weight: 600; 
} 
  
.label-tag { 
  width: 100px; 
  text-align: center; 
  background-color: rgb(0, 177, 0); 
  color: white; 
  border-radius: 4px; 
}

.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 600,
  'GRAD' 0,
  'opsz' 24
}


        /* Style pour la modale */
        .modal {
            display: none; /* Cachée par défaut */
            position: fixed; /* Position fixe pour couvrir tout l'écran */
            z-index: 1; /* Empilement au-dessus de tout */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Activer le défilement si nécessaire */
            background-color: rgb(0,0,0); /* Fond noir avec un peu de transparence */
            background-color: rgba(0,0,0,0.4); /* Fond noir avec un peu de transparence */
        }
        
        /* Contenu de la modale */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* Centré verticalement et horizontalement */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Largeur de la modale */
        }
        
        /* Bouton de fermeture */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

            .search-container {
            float: right;
            }

            .search-container input[type=text] {
            padding: 6px;
            margin-top: 8px;
            font-size: 17px;
            border: none;
            }

             .search-container button {
            float: right;
            padding: 6px 10px;
            margin-top: 8px;
            margin-right: 16px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
            }

             .search-container button:hover {
            background: #ccc;
            }

            
        .hidden {
            display: none;
        }

        table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
      }
      table th,
table td {
  padding: .625em;
  text-align: center;
}
table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}
        table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35em;
      }

      .alert {
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    animation: fadeOut 5s forwards;
}

.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.icon {
    margin-right: 10px;
    font-size: 20px;
    vertical-align: middle;
}

.icons a{
  text-decoration: none;
  color: black;
}

.icons a:visited{
  color: black;
}

.icons .box::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
  border-radius: 5px
}

.icons .box::-webkit-scrollbar
{
	width: 10px;
	background-color: #F5F5F5;
  border-radius: 5px
}

.icons .box::-webkit-scrollbar-thumb
{
	background-color: black;
	border: 2px solid black;
  border-radius: 5px
}





.icons{
  display: inline;
  float: right
}

.icons .notification{
  padding-top: 30px;
  position: relative;
  display: inline-block;
}

.icons .number{
  height: 22px;
  width:  22px;
  background-color: #d63031;
  border-radius: 20px;
  color: white;
  text-align: center;
  position: absolute;
  top: 23px;
  left: 60px;
  padding: 3px;
  border-style: solid;
  border-width: 2px;
}

.icons .number:empty {
   display: none;
}

.icons .notBtn{
  transition: 0.5s;
  cursor: pointer
}

.icons .fas{
  font-size: 25pt;
  padding-bottom: 10px;
  color: black;
  margin-right: 40px;
  margin-left: 40px;
}

.icons .box{
  width: 400px;
  height: 0px;
  border-radius: 10px;
  transition: 0.5s;
  position: absolute;
  overflow-y: scroll;
  padding: 0px;
  left: -300px;
  margin-top: 5px;
  background-color: #F4F4F4;
  -webkit-box-shadow: 10px 10px 23px 0px rgba(0,0,0,0.2);
  -moz-box-shadow: 10px 10px 23px 0px rgba(0,0,0,0.1);
  box-shadow: 10px 10px 23px 0px rgba(0,0,0,0.1);
  cursor: context-menu;
}

.icons .fas:hover {
  color: #d63031;
}

.icons .notBtn:hover > .box{
  height: 60vh
}


.icons .gry{
  background-color: #F4F4F4;
}

.icons .top{
  color: black;
  padding: 10px
}

.icons .display{
  position: relative;
}

.icons .cont{
  display: flex;
  flex-direction: column;
  width: 100%;
  height: 100%;
  background-color: #F4F4F4;
}

.icons .cont:empty{
  display: none;
}

.icons .stick{
  text-align: center;  
  display: block;
  font-size: 50pt;
  
}

.icons .stick:hover{
  color: black;
}

.icons .cent{
  text-align: center;
  display: block;
}

 .sec{
  padding: 25px 10px;
  background-color: #F4F4F4;
  transition: 0.5s;
}

.icons .profCont{
  padding-left: 15px;
}

.icons .profile{
  -webkit-clip-path: circle(50% at 50% 50%);
  clip-path: circle(50% at 50% 50%);
  width: 75px;
  float: left;
}

.icons .txt{
  vertical-align: top;
  font-size: 1.25rem;
  padding: 5px 10px 0px 115px;
}

.icons .sub{
  font-size: 1rem;
  color: grey;
}

.icons .new{
  border-style: none none solid none;
  border-color: red;
}

.icons .sec:hover{
  background-color: #BFBFBF;
}
@keyframes fadeOut {
    0% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        opacity: 0;
        display: none;
    }
}
      

@media screen and (max-width: 950px) { 
  .nav-img { 
    height: 25px; 
  } 
  .nav-option { 
    gap: 30px; 
  } 
  .nav-option h3 { 
    font-size: 15px; 
  } 
  .report-topic-heading, 
  .item1, 
  .items { 
    width: 800px; 
  } 
} 
  
@media screen and (max-width: 850px) { 
  .nav-img { 
    height: 30px; 
  } 
  .nav-option { 
    gap: 30px; 
  } 
  .nav-option h3 { 
    font-size: 20px; 
  } 
  .report-topic-heading, 
  .item1, 
  .items { 
    width: 700px; 
  } 
  .navcontainer { 
    width: 100vw; 
    position: absolute; 
    transition: all 0.6s ease-in-out; 
    top: 0; 
    left: -100vw; 
  } 
  .nav { 
    width: 100%; 
    position: absolute; 
  } 
  .navclose { 
    left: 00px; 
  } 
  .searchbar { 
    display: none; 
  } 
  .main { 
    padding: 40px 30px 30px 30px; 
  } 
  .searchbar2 { 
    width: 100%; 
    display: flex; 
    margin: 0 0 40px 0; 
    justify-content: center; 
  } 
  .searchbar2 input { 
    width: 250px; 
    height: 42px; 
    border-radius: 50px 0 0 50px; 
    background-color: var(--background-color3); 
    padding: 0 20px; 
    font-size: 15px; 
    border: 2px solid var(--secondary-color); 
  } 
} 
  
@media screen and (max-width: 490px) { 
  .message { 
    display: none; 
  } 
  .logosec { 
    width: 100%; 
    justify-content: space-between; 
  } 
  .logo { 
    font-size: 20px; 
  } 
  .menuicn { 
    height: 25px; 
  } 
  .nav-img { 
    height: 25px; 
  } 
  .nav-option { 
    gap: 25px; 
  } 
  .nav-option h3 { 
    font-size: 12px; 
  } 
  .nav-upper-options { 
    gap: 15px; 
  } 
  .recent-Articles { 
    font-size: 20px; 
  } 
  .report-topic-heading, 
  .item1, 
  .items { 
    width: 550px; 
  } 
} 
  
@media screen and (max-width: 400px) { 
  .recent-Articles { 
    font-size: 17px; 
  } 
  .view { 
    width: 60px; 
    font-size: 10px; 
    height: 27px; 
  } 
  .report-header { 
    height: 60px; 
    padding: 10px 10px 5px 10px; 
  } 
  .searchbtn img { 
    height: 20px; 
  } 
} 
  
@media screen and (max-width: 320px) { 
  .recent-Articles { 
    font-size: 12px; 
  } 
  .view { 
    width: 50px; 
    font-size: 8px; 
    height: 27px; 
  } 
  .report-header { 
    height: 60px; 
    padding: 10px 5px 5px 5px; 
  } 
  .t-op { 
    font-size: 12px; 
  } 
  .t-op-nextlvl { 
    font-size: 10px; 
  } 
  .report-topic-heading, 
  .item1, 
  .items { 
    width: 300px; 
  } 
  .report-body { 
    padding: 10px; 
  } 
  .label-tag { 
    width: 70px; 
  } 
  .searchbtn { 
    width: 40px; 
  } 
  .searchbar2 input { 
    width: 180px; 
  } 
}
  </style>
<body> 
    
    <!-- for header part -->
    <header> 
  
        <div class="logosec"> 
            <div class="logo">RappelTout</div> 
            <img src= 
"./img/icons8-menu-64.png"
                class="icn menuicn" 
                id="menuicn" 
                alt="menu-icon"> 
        </div> 
  
        <!-- <div class="searchbar"> 
            <input type="text" 
                   placeholder="Search"> 
            <div class="searchbtn"> 
              <img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                    class="icn srchicn" 
                    alt="search-icon"> 
              </div> 
        </div>  --> 
        <?php

                    // Vérifier si un message d'alerte est défini
                    if(isset($_SESSION['alert_message'])) {
                        // Afficher le message d'alerte avec le style CSS
                        echo '<div class="alert success"><span class="icon">&#x2714;</span>' . $_SESSION['alert_message'] . '</div>';

                        // Supprimer le message d'alerte de la session une fois affiché
                        unset($_SESSION['alert_message']);
                    }
                    ?>
        <div class="deconnexion">
             
                         <a href="logout.php" tite="Deconnexion">  </a>    
                        
           </div>
           <div class = "icons">
    <a href = "#"><i class="fas fa-archive"></i></a>
    <div class = "notification">
      <a href = "#">
      <div class = "notBtn" href = "#">
        <!--Number supports double digets and automaticly hides itself when there is nothing between divs -->
        <div class = "number">2</div>
        <i class="fas fa-bell"></i>
          <div class = "box">
            <div class = "display">
              <div class = "nothing"> 
                <i class="fas fa-child stick"></i> 
                <div class = "cent">Looks Like your all caught up!</div>
              </div>
              <div class="cont">
    <div>
        <?php
        if (isset($_SESSION['matériel'])) {
            $materiel_messages = explode('<br>', $_SESSION['matériel']); // Séparer les messages par saut de ligne
            foreach ($materiel_messages as $message) {
                echo "<div class='sec new'>$message</div>"; // Afficher chaque message dans une balise <div>
            }
       
        }
        ?>
   
        <?php
        if (isset($_SESSION['document'])) {
            $document_messages = explode('<br>', $_SESSION['document']); // Séparer les messages par saut de ligne
            foreach ($document_messages as $message) {
                echo "<div class='sec new'>$message</div>"; // Afficher chaque message dans une balise <div>
            }
           
        }
        ?>
    </div>
</div>
                 
                 
             </div>
            </div>
         </div>
      </div>
        </a>
    </div>
    <a href = "#"><i class="fas fa-edit"></i></a>
    </div>
        <div class="message"> 
           
        <p> <span> <?php echo $_SESSION['user_email']; ?> </p>
            <div class="dp"> 
           
              <img src= 
"./img/icons8-male-user-24.png"
                    class="dpicn" 
                    alt="dp"> 

              </div> 
              
        </div> 
  
    </header> 
  
    <div class="main-container"> 
        <div class="navcontainer"> 
            <nav class="nav"> 
                <div class="nav-upper-options"> 
                    <div class="nav-option option"> 
                      <div class="tablinks" onclick="openTab(event, 'page1')" id="defaultOpen">
                          <span class="material-symbols-outlined">
                          grid_view
                          </span>
                         
                          <h3 > Dashboard</h3>
                      </div>
                        
                      
                      
                    </div> 
                    
  
                    <div class="option nav-option"> 
                    <div class="tablinks" onclick="openTab(event, 'page2')">
                   
                        <span class="material-symbols-outlined">
                        description
                        </span>
                        <h3 > Document</h3> 
                    </div>
                      
                    </div> 
  
                    <div class="nav-option option"> 
                      <div class="tablinks" onclick="openTab(event, 'page3')">
                        <span class="material-symbols-outlined">
                        home_repair_service
                        </span>
                        <h3 > Materiel</h3> 
                      </div>
                      
                    </div> 
  
                   
  
                  
  
                  
  
                    <div class="logout"  > 
                      <span class="material-symbols-outlined">
                        logout
                        </span>
                        <a style="text-decoration :none; color:black;" href="logout.php" tite="Deconnexion"><h3>Se déconnecter</h3>  </a> 
                    </div> 
  
                </div> 
            </nav> 
        </div> 
        <div class="main"> 
          <div id="page1" class="tabcontent">
  
            <div class="box-container"> 
  
                <div class="box box1"> 
                    <div class="text"> 
                        <h2 class="topic-heading"><?php echo $total;?></h2> 
                        <h2 class="topic">Au tolal</h2> 
                    </div> 
  
                    <img src= "./img/icons8-chart-64.png"
                        alt="Views"> 
                </div> 
  
                <div class="box box2"> 
                    <div class="text"> 
                        <h2 class="topic-heading"><?php echo $row1['total'];?></h2> 
                        <h2 class="topic">Document(s)</h2> 
                    </div> 
  
                    <img src= "./img/icons8-document-50.png" 
                         alt="likes"> 
                </div> 
  
                <div class="box box3"> 
                    <div class="text"> 
                        <h2 class="topic-heading"><?php echo $row['total'];?></h2> 
                        <h2 class="topic">Materiel(s)</h2> 
                    </div> 
  
                    <img src= "./img/icons8-toolbox-50.png"
                        alt="comments"> 
                </div> 
  
               
            </div> 
  
            <div class="report-container"> 
              <div class="report-header"> 
                  <h1 class="recent-Articles">Activités récentes</h1> 
                  <div class="search-container">
                    <form method="post" action="">
                    <input type="text" placeholder="Recherche..." name="search">
                    <button type="submit" ><i class="fa fa-search"></i></button>
                    </form>
                </div>
              </div> 

              <div class="report-body"> 
                
                    <div class="items"> 
                    <table style=" text-align:center;">
                        <thead>
                            <tr>
                              
                                <th>Référence</th>
                                <th>Description</th>
                                <th>Date de création</th>
                                <th>Date d'expiration</th>
                                <th>Types</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr class="table-row">
                                    
                                    <td><?= $row['Refe'] ?></td>
                                  
                                    <td><?= $row['Descrip'] ?></td>
                                  
                                    <td><?= $row['date_creat'] ?></td>
                                    <td><?= $row['date_exp'] ?></td>
                                    <td><?= $row['type'] ?></td>
                                    <td>
                                        <!-- Bouton Modifier -->
                                        <button onclick="document.getElementById('confirmModifyModal').style.display='block'">Modifier</button>

                                        <!-- Bouton Supprimer -->
                                       <!-- Bouton pour ouvrir la modale de confirmation -->
                                        <button onclick="document.getElementById('confirmDeleteModal').style.display='block'">Supprimer</button>
                                       
                                    </td>
                                </tr>
                                <!-- Modale de confirmation -->
                    <div id="confirmDeleteModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="document.getElementById('confirmDeleteModal').style.display='none'">&times;</span>
                            <p>Êtes-vous sûr de vouloir supprimer cet élément ?</p>
                            <!-- Formulaire pour la suppression -->
                            <form method="post"action="supprimer_materiel.php">
                                <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                
                                <button type="submit" name="btn-del">Confirmer la modification</button>
                                <button type="button" onclick="document.getElementById('confirmDeleteModal').style.display='none'">Annuler</button>
                            </form>
                        </div>
                    </div>
                    <!-- Modale de confirmation -->
                                <div id="confirmModifyModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="document.getElementById('confirmModifyModal').style.display='none'">&times;</span>
                                        <h2 style="color: black">Formulaire de modification</h2>

                                            <form method="post" action="modifier_materiel.php">
                                                <!-- Champ caché pour transmettre l'identifiant de l'élément à modifier -->
                                                <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                <!-- Champ de saisie pour le nom prérempli avec les données actuelles -->
                                                <label for="Refe" style="color: black">Référence :</label>
                                                <input type="text" name="Refe" value="<?php echo $row['Refe']; ?>"><br>
                                                <!-- Champ de saisie pour la description prérempli avec les données actuelles -->
                                                <label for="description" style="color: black">Description :</label>
                                                <input type="text" name="Descrip" value="<?php echo  $row['Descrip']; ?>"><br>

                                                <label for="date_creat" style="color: black">Date de création :</label>
                                                <input
                                                      id="party"
                                                      type="datetime-local"
                                                      
                                                       name="date_creat" value="<?php echo  $row['date_creat']; ?>"/>
                                                <br>
                                                <label for="date_exp" style="color: black">Date d'expiration :</label>
                                                <input
                                                      id="party"
                                                      type="datetime-local"
                                                      
                                                       name="date_exp" value="<?php echo  $row['date_exp']; ?>"/>
                                                <br>
                                                
                                                
                                                
                                                <a href="modifier_materiel.php?id=<?= $row['ID'] ?>">Confirmer la modification</a>
                                            <button type="submit" name="btn-update">Confirmer la modification</button>
                                            <button type="button" onclick="document.getElementById('confirmModifyModal').style.display='none'">Annuler</button>
                                        </form>
                                    </div>
                                </div>

                                <?php endwhile; ?>
                        <?php while($row = $stmt2->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    
                                    <td><?= $row['Reference'] ?></td>
                                  
                                    <td><?= $row['fichier'] ?></td>
                                  
                                    <td><?= $row['Date_creation'] ?></td>
                                    <td><?= $row['Date_Exp'] ?></td>
                                    <td><?= $row['type'] ?></td>
                                    <td>
                                        <!-- Bouton Modifier -->
                                        <a class="btn-modifier">Modifier</a>

                                        <!-- Bouton Supprimer -->
                                       
                                      
                                    </td>
                                </tr>
                               
                                <?php endwhile; ?>
                        </tbody>
                    </table>
                    </div> 
              </div> 
          </div>
          </div> 
       
          <div id="page2" class="tabcontent" >
  <a ></a>
            <div class="report-container"> 
                <div class="report-header"> 
                    <h1 class="recent-Articles">Recent Articles</h1> 
                    
                </div> 
  
                <div class="report-body"> 
                    <div class="report-topic-heading"> 
                        <h3 class="t-op">Article</h3> 
                        <h3 class="t-op">Views</h3> 
                        <h3 class="t-op">Comments</h3> 
                        <h3 class="t-op">Status</h3> 
                    </div> 
  
                      <div class="items"> 
                          <div class="item1"> 
                              <h3 class="t-op-nextlvl">Article 73</h3> 
                              <h3 class="t-op-nextlvl">2.9k</h3> 
                              <h3 class="t-op-nextlvl">210</h3> 
                              <h3 class="t-op-nextlvl label-tag">Published</h3> 
                          </div> 
    
                          <div class="item1"> 
                              <h3 class="t-op-nextlvl">Article 72</h3> 
                              <h3 class="t-op-nextlvl">1.5k</h3> 
                              <h3 class="t-op-nextlvl">360</h3> 
                              <h3 class="t-op-nextlvl label-tag">Published</h3> 
                          </div> 
    
                          <div class="item1"> 
                              <h3 class="t-op-nextlvl">Article 71</h3> 
                              <h3 class="t-op-nextlvl">1.1k</h3> 
                              <h3 class="t-op-nextlvl">150</h3> 
                              <h3 class="t-op-nextlvl label-tag">Published</h3> 
                          </div> 
    
                          <div class="item1"> 
                              <h3 class="t-op-nextlvl">Article 70</h3> 
                              <h3 class="t-op-nextlvl">1.2k</h3> 
                              <h3 class="t-op-nextlvl">420</h3> 
                              <h3 class="t-op-nextlvl label-tag">Published</h3> 
                          </div> 
    
                          <div class="item1"> 
                              <h3 class="t-op-nextlvl">Article 69</h3> 
                              <h3 class="t-op-nextlvl">2.6k</h3> 
                              <h3 class="t-op-nextlvl">190</h3> 
                              <h3 class="t-op-nextlvl label-tag">Published</h3> 
                          </div> 
    
                          <div class="item1"> 
                              <h3 class="t-op-nextlvl">Article 68</h3> 
                              <h3 class="t-op-nextlvl">1.9k</h3> 
                              <h3 class="t-op-nextlvl">390</h3> 
                              <h3 class="t-op-nextlvl label-tag">Published</h3> 
                          </div> 
    
                          <div class="item1"> 
                              <h3 class="t-op-nextlvl">Article 67</h3> 
                              <h3 class="t-op-nextlvl">1.2k</h3> 
                              <h3 class="t-op-nextlvl">580</h3> 
                              <h3 class="t-op-nextlvl label-tag">Published</h3> 
                          </div> 
    
                          <div class="item1"> 
                              <h3 class="t-op-nextlvl">Article 66</h3> 
                              <h3 class="t-op-nextlvl">3.6k</h3> 
                              <h3 class="t-op-nextlvl">160</h3> 
                              <h3 class="t-op-nextlvl label-tag">Published</h3> 
                          </div> 
    
                          <div class="item1"> 
                              <h3 class="t-op-nextlvl">Article 65</h3> 
                              <h3 class="t-op-nextlvl">1.3k</h3> 
                              <h3 class="t-op-nextlvl">220</h3> 
                              <h3 class="t-op-nextlvl label-tag">Published</h3> 
                          </div> 
    
                      </div> 
                </div> 
            </div> 
          </div> 
          <div id="page3"  class="tabcontent">
  
            <div class="report-container" > 
                <div class="report-header"> 
                    <h1 class="recent-Articles">Recent Articles 2</h1> 
                    <button class="view">View All</button> 
                </div> 
                
                <form action="result_mat.php" method="POST">
                            

                            <label for="">Reference</label>
                            <input type="text" placeholder="Reference du materiel" name="Ref_mat" />

                            <label for="">Description</label>
                            <input type="text" placeholder="Description du materiel" name="Description_mat" />

                            <label for="">Date de creation </label>
                            <input type="datetime-local" placeholder="" name="date_creation" />

                            <label for="">Date d'expiration </label>
                            <input type="datetime-local" placeholder="" name="date_exp" />

                           

                            <input type="submit" id='submit' value='VALIDER'  >
                        </form>
            </div> 
          </div> 
        
    </div> 
  
    <script src="./index.js"></script> 
    <script>
      function openTab(evt, tabName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(tabName).style.display = "block";
      evt.currentTarget.className += " active";
      }

      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();
  </script>
  <script>
// Fermer la modale si l'utilisateur clique en dehors de celle-ci
window.onclick = function(event) {
    var modal = document.getElementById('confirmModifyModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script>
// Fermer la modale si l'utilisateur clique en dehors de celle-ci
window.onclick = function(event) {
    var modal = document.getElementById('confirmDeleteModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
    <script>
        function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>

<script>
        // Fonction pour masquer les lignes non pertinentes
        function filterTable(searchTerm) {
            var rows = document.querySelectorAll('.table-row');
            for (var i = 0; i < rows.length; i++) {
                var shouldShow = searchTerm === '' || rows[i].textContent.toLowerCase().includes(searchTerm.toLowerCase());
                rows[i].classList.toggle('hidden', !shouldShow);
            }
        }

        // Écouteur d'événements pour le champ de recherche
        document.querySelector('input[name="search"]').addEventListener('input', function() {
            filterTable(this.value);
        });

        // Au chargement de la page, effectuer une recherche initiale pour masquer les lignes non pertinentes
        filterTable(document.querySelector('input[name="search"]').value);
    </script>
    <script>
  setTimeout(function(){
        var alertBox = document.getElementById('alert');
        alertBox.style.display = 'none';
    }, 5000); // 5000 millisecondes = 5 secondes
    </script>
  
</body> 
</html>