<?php
include_once('conn/connection.php');
$mat= new Materiel();
	if(ISSET($_POST['search'])){
        ?>
        
            
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
                <?php
                $keyword = $_POST['keyword'];
				$query = $conn->prepare("SELECT * FROM `Materiel` WHERE `Refe` LIKE '%$keyword%' or `Descrip` LIKE '%$keyword%'");
				$query->execute();
                 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            
                            <td><?= $row['Refe'] ?></td>
                          
                            <td><?= $row['Descrip'] ?></td>
                            </tr>
                            <?php endwhile; ?>
                    	</tbody>
	                </table>
                    <?php		
	}
?>