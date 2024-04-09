<?php


class Document {
    public function addDocument($refDoc, $dateDoc, $dateExpirationDoc, $refMatDoc) {
        include_once('conn/connection.php');
        $stmtAddDoc = $conn->prepare("INSERT INTO Document (refDoc, dateDoc, dateExpirationDoc, refMat) VALUES (:refDoc, :dateDoc, :dateExpirationDoc, :refMat)");
        $stmtAddDoc->bindParam(':refDoc', $refDoc);
        $stmtAddDoc->bindParam(':dateDoc', $dateDoc);
        $stmtAddDoc->bindParam(':dateExpirationDoc', $dateExpirationDoc);
        $stmtAddDoc->bindParam(':refMat', $refMatDoc);
        $stmtAddDoc->execute();
    }
}
?>
