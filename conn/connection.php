<?php 




$username="martial";
        $psswd="martial";

        try 
        {
          
            $conn=new PDO('mysql:host=localhost;dbname=rplto',$username,$psswd);
            

        }
        catch (PDOexception $e)
        {
            echo "Erreur :".$e->getMessage();
        }
?>