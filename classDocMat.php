<?php
 
       
       
        class Materiel{
             
                
                private $Reference;
                private $Description;
                private $Date_creation;
                private $Date_Exp;
              
                

                function __construct($Reference="", $Description="", $Date_creation="", $Date_Exp="", ) {
                    
                
                    $this->Reference = $Reference;
                    $this->Description = $Description;
                    $this->Date_creation = $Date_creation;
                    $this->Date_Exp = $Date_Exp;
                  
                   
                  }


                
                
                  function getReference() {
                    return $this->Reference;
                  }
                  function getDescription() {
                    return $this->Description;
                  }
                  function getDate_creation() {
                    return $this->Date_creation;
                  }
                  function getDate_Exp() {
                    return $this->Date_Exp;
                  }
               
                
               

                
                  function setReference($a) {
                    $this->Reference=$a;
                  }
                
                  function setDescription($a) {
                     $this->Description=$a;
                  }
                  function setDate_creation($a) {
                    $this->Date_creation=$a;
                  }
                  function setDate_Exp($a) {
                    $this->Date_Exp=$a;
                  }
                

                  public function create()
                  {
                    include_once('conn/connection.php');
                    $sql="INSERT INTO Materiel (Refe, Descrip, date_creat, date_exp, type) VALUES(:Refe, :Descrip, NOW(), :date_exp, 'Materiel')";
                    $stmt = $conn->prepare($sql);
                    
                    $stmt->bindparam(":Refe",$this->Reference);
                    $stmt->bindparam(":Descrip",$this->Description);
                   
                    $stmt->bindparam(":date_exp",$this->Date_Exp);
                    $stmt->execute();
                  }

                  public function retrieve($searchTerm){
                    include_once('conn/connection.php');
                    $search = '%' . $searchTerm . '%';
                    $stmt = $conn->prepare("SELECT * FROM Materiel WHERE `Refe` LIKE '%$searchTerm%' or `Descrip` LIKE '%$searchTerm%'");
                    $stmt->execute();
                    $stmt->fetchAll();
                  }
                 
                
                  public function update($id,$Refe,$Descrip, $date_exp)
                  {
                      include_once('conn/connection.php');
                      $sql = "UPDATE Materiel SET Refe = :Refe, Descrip = :Descrip, date_creat = NOW(), date_exp = :date_exp, type = 'Materiel' WHERE ID = :ID ";
                      $stmt = $conn->prepare($sql);

                      
                      $stmt->bindparam(":Refe", $Refe);
                      $stmt->bindparam(":Descrip", $Descrip);
                      $stmt->bindparam(":date_exp", $date_exp);
                      $stmt->bindparam(":ID", $id);
                      // Ajoutez la liaison pour l'ID
                  
                      $stmt->execute();
                  }
                  
                  public function delete($id){

                      include_once('conn/connection.php');

                      $sql = "DELETE FROM Materiel WHERE ID = :ID";
                      $stmt = $conn->prepare($sql);
                      $stmt->bindParam(":ID",$id);
                      $stmt->execute();


                  }
                
        }


        class Document{
          private $Reference;
          private $File;
          private $Date_creation;
          private $Date_Exp;
          

          function __construct($Reference="", $File="", $Date_creation="", $Date_Exp="") {
              
          
              $this->Reference = $Reference;
              $this->File = $File;
              $this->Date_creation = $Date_creation;
              $this->Date_Exp = $Date_Exp;
             
            }


          
          
            function getReference() {
              return $this->Reference;
            }
            function getFile() {
              return $this->File;
            }
            function getDate_creation() {
              return $this->Date_creation;
            }
            function getDate_Exp() {
              return $this->Date_Exp;
            }
         

          
            function setReference($a) {
              $this->Reference=$a;
            }
          
            function setFile($a) {
               $this->File=$a;
            }
            function setDate_creation($a) {
              $this->Date_creation=$a;
            }
            function setDate_Exp($a) {
              $this->Date_Exp=$a;
            }
          

            public function create()
            {
              include_once('conn/connection.php');
              $sql="INSERT INTO Document (Reference, fichier, Date_creation, Date_Exp, type) VALUES(:Reference, :fichier, NOW(), :Date_Exp, 'Document')";
              $stmt = $conn->prepare($sql);
              
              $stmt->bindparam(":Reference",$this->Reference);
              $stmt->bindparam(":fichier",$this->File);
             
              $stmt->bindparam(":Date_Exp",$this->Date_Exp);
              $stmt->execute();
            }

                
        }

?>