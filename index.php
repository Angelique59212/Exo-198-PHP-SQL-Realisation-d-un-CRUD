<?php
require 'Connect.php';
require 'Config.php';

/**
 * @param string $nom
 * @param string $prenom
 * @param int $age
 * @return void
 */
function createStudent(string $nom,string $prenom,int $age) {
    $stmt = Connect::dbConnect()->prepare("
        INSERT INTO mdf58_eleves (nom,prenom,age)
        VALUES (:nom,:prenom,:age)
    ");
    $stmt->bindParam(':nom',$nom);
    $stmt->bindParam(':prenom',$prenom);
    $stmt->bindParam(':age',$age);

    $stmt->execute();
    echo "Utilisateur ajouté"."<br>";
}
createStudent('Dehainaut','Angélique',33);

/**
 * @return void
 */
function readStudent() {
    $stmt = Connect::dbConnect()->prepare("SELECT * FROM mdf58_eleves");
    $state = $stmt->execute();

    if ($state){
        foreach ($stmt->fetchAll() as $student) {
            echo "Elèves: ".$student['nom']. " ".$student['prenom']." ".$student['age']."<br>";
        }
    }
}
readStudent();

/**
 * @param string $prenom
 * @param string $nom
 * @param int $age
 * @param int $idEleve
 * @return void
 */
function updateStudent(string $prenom, string $nom, int $age, int $idEleve) {
    $stmt = Connect::dbConnect()->prepare("
        UPDATE mdf58_eleves SET prenom = :prenom, nom = :nom, age = :age WHERE id = :id;
    ");
    $stmt->bindParam(':prenom',$prenom);
    $stmt->bindParam(':id',$idEleve);
    $stmt->bindParam(':nom',$nom);
    $stmt->bindParam('age',$age);

    $stmt->execute();
}
updateStudent('Angelika','Dehainaut','33',1);


function deleteStudent() {
    $stmt = Connect::dbConnect()->prepare("
        DELETE FROM mdf58_eleves WHERE id > 1;
    ");
    $stmt->execute();
}
deleteStudent();
