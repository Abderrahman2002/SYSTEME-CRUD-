<?php
class Etudiant {
    // Propriétés
    private $nom;
    private $numero;
    private $nomFamille;
    private $prenom;
    private $moyenne;

    // Constructeur
    public function __construct($nom, $numero, $nomFamille, $prenom, $moyenne) {
        $this->nom = $nom;
        $this->numero = $numero;
        $this->nomFamille = $nomFamille;
        $this->prenom = $prenom;
        $this->moyenne = $moyenne;
    }
}
