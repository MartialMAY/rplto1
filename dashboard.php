
<?php
session_start(); 
if($_SESSION['user_email']==""){
	header('location:index.php');

}
include ('classDocMat.php');
include_once('conn/connection.php');
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
 ?>

 


 

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>App RappelTout</title>

    <style>
            .form3 {
                background: #fff;
                
                width: 80%;
                max-width: 100%;
                height: 700px;
                display: flex;
                justify-content: center;
                align-items: center;
                align-items: center;
            }
                    .formulaire {
            background: #cacaca;
            padding: 30px;
            width: 900px;
                max-width: 100%;
                height: 600px;
            border-radius: 30px;
            display: flex;
                justify-content: center;
            }

            .form2-3 .form2 ul li.active {
                background-color: #fff;
                color: black;
                padding: 8px;
            }
            .form2-3 .form2 ul li {
               
                padding: 8px;
            }
            .form2-3 .form2 ul li:hover {
                background-color: #fff;
                color: black;
                padding: 8px;
            }

            div ul li {
            text-decoration: none;
            list-style: none;
            color: #FFFDFA;
            font-size: 15px;

            
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .btn-modifier, .btn-supprimer {
                padding: 5px 10px;
                margin-right: 5px;
                cursor: pointer;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 3px;
            }

            .btn-supprimer {
                background-color: #f44336;
            }

                                .button-delete {
                    background-color: #f44336;
                    color: white;
                    padding: 5px 10px;
                margin-right: 5px;
                    border: none;
                    cursor: pointer;
                   
                    opacity: 0.9;
                    }

                    .button-delete:hover {
                    opacity:1;
                    }

                    /* Float cancel and delete buttons and add an equal width */
                    .cancelbtn, .deletebtn {
                    float: left;
                    width: 50%;
                    }

                    /* Add a color to the cancel button */
                    .cancelbtn {
                    background-color: #ccc;
                    color: black;
                    }

                    /* Add a color to the delete button */
                    .deletebtn {
                    background-color: #f44336;
                    }

                    /* Add padding and center-align text to the container */
                    .container {
                    padding: 16px;
                    text-align: center;
                    }

                    /* The Modal (background) */
                    .modal {
                    display: none; /* Hidden by default */
                    position: fixed; /* Stay in place */
                    z-index: 1; /* Sit on top */
                    left: 0;
                    top: 0;
                    width: 100%; /* Full width */
                    height: 100%; /* Full height */
                    overflow: auto; /* Enable scroll if needed */
                    
                    padding-top: 50px;
                    }

                    /* Modal Content/Box */
                    .modal-content {
                        color:white;
                    background-color: #fefefe;
                    margin: 15% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
                    border: 1px solid #888;
                    width: 30%; /* Could be more or less, depending on screen size */
                    }

                    /* Style the horizontal ruler */
                    hr {
                    border: 1px solid #f1f1f1;
                    margin-bottom: 25px;
                    }
                    
                    /* The Modal Close Button (x) */
                    .close {
                    position: absolute;
                    right: 205px;
                    top: 145px;
                    font-size: 40px;
                    font-weight: bold;
                    color: #f1f1f1;
                    }

                    .close:hover,
                    .close:focus {
                    color: #f44336;
                    cursor: pointer;
                    }

                    /* Clear floats */
                    .clearfix::after {
                    content: "";
                    clear: both;
                    display: table;
                    }
    </style>
    <style>
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
    </style>

    </style>
</head>
<body>
    

    <div class="container">
        <div class="form1">
           <div class="deconnexion">
             
                       <p> Bienvenue <span> <?php echo $_SESSION['user_email']; ?> </span> |  <a href="logout.php" tite="Deconnexion">  Se déconecter </a> </p>   
                        
           </div>
               
        <div class="form2-3">
            <div class="form2">
                <ul>
                    <li class="tablinks" onclick="openTab(event, 'page1')" id="defaultOpen"><h2>Dashboard</h2></li>
                    <li class="tablinks" onclick="openTab(event, 'page2')" ><h2>Materiel</h2></li>
                    <li class="tablinks" onclick="openTab(event, 'page3')" ><h2>Document</h2></li>
                </ul>
                

            </div>

            <div class="form3">
                <div id="page1" class="tabcontent">
                <div class="search-container">
                    <form method="post" action="">
                    <input type="text" placeholder="Recherche..." name="search">
                    <button type="submit" ><i class="fa fa-search"></i></button>
                    </form>
                </div>
                
                                    <div class="formulaire">
                    
                        <h1>Tableau de bord</h1>

                    <table>
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
                            <form method="post" >
                                <input type="hidden" name="id" value="ID_DE_L_ELEMENT_A_SUPPRIMER">
                                <a href="supprimer_materiel.php?id=<?= $row['ID'] ?>">Confirmer la suppression</a>
                                
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
                                                <input type="date" name="date_creat" value="<?php echo  $row['date_creat']; ?>"><br>
                                                
                                                <label for="date_exp" style="color: black">Date d'expiration :</label>
                                                <input type="date" name="date_exp" value="<?php echo  $row['date_exp']; ?>"><br>
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
                <div id="page2" class="tabcontent">
                    <div class="formulaire">
                        <h1>Ajouter un materiel</h1>
                    
                        <form action="result_mat.php" method="POST">
                            

                            <label for="">Reference</label>
                            <input type="text" placeholder="Reference du materiel" name="Ref_mat" />

                            <label for="">Description</label>
                            <input type="text" placeholder="Description du materiel" name="Description_mat" />

                            <label for="">Date de creation </label>
                            <input type="date" placeholder="" name="date_creation" />

                            <label for="">Date d'expiration </label>
                            <input type="date" placeholder="" name="date_exp" />

                           

                            <input type="submit" id='submit' value='VALIDER'  >
                        </form>
                    </div>
                    
                </div>
                <div id="page3" class="tabcontent">
                    <div class="formulaire">
                        <h1>Ajouter un document</h1>
                    
                        <form action="result_doc.php" method="POST">
                            

                            <label for="">Reference</label>
                            <input type="text" placeholder="Reference du document" name="Ref_doc" />

                            <label for="">Fichier</label>
                            <input type="file" placeholder="Fichier" name="fichier" accept=".pdf"/>
                            <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/> <!--64 MB's worth in bytes-->
                            

                            <label for="">Date de creation </label>
                            <input type="date" placeholder="" name="date_creation" />

                            <label for="">Date d'expiration </label>
                            <input type="date" placeholder="" name="date_exp" />

                           

                            <input type="submit" id='submit' value='VALIDER'  >
                        </form>
                    </div>
                    
                </div>
            </div>
            
        </div>
        <div class="form4">
    </div>
    <div class="tab">
  
</div>

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
</body>
</html>
 