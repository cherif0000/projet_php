CREATE DATABASE PHP_projet;

USE PHP_projet ;

CREATE TABLE Utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('client','proprietaire','admin') NOT NULL
);

CREATE TABLE Logement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    adresse VARCHAR(255),
    titre VARCHAR(150),
    prix FLOAT,
    statut ENUM('disponible','reserve','indisponible'),

    user_id INT NOT NULL,

    FOREIGN KEY (user_id)
    REFERENCES Utilisateur(id)
    ON DELETE CASCADE
);

CREATE TABLE ImgLogement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url_image VARCHAR(255),

    logement_id INT NOT NULL,

    FOREIGN KEY (logement_id)
    REFERENCES logement(id)
    ON DELETE CASCADE
);

CREATE TABLE ReservationLogement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_debut DATE,
    date_fin DATE,
    statut ENUM('en_attente','confirmee','annulee'),

    user_id INT NOT NULL,
    logement_id INT NOT NULL,

    FOREIGN KEY (user_id)
    REFERENCES Utilisateur(id)
    ON DELETE CASCADE,

    FOREIGN KEY (logement_id)
    REFERENCES Logement(id)
    ON DELETE CASCADE
);

CREATE TABLE Avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commentaire TEXT,
    note INT CHECK (note BETWEEN 1 AND 5),
    date DATE,

    user_id INT NOT NULL,
    logement_id INT NOT NULL,

    FOREIGN KEY (user_id)
    REFERENCES Utilisateur(id)
    ON DELETE CASCADE,

    FOREIGN KEY (logement_id)
    REFERENCES Logement(id)
    ON DELETE CASCADE
);

CREATE TABLE Excursion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150),
    description TEXT,
    adresse VARCHAR(255),
    date DATE,
    prix FLOAT,
    image VARCHAR(255),

    user_id INT NOT NULL,

    FOREIGN KEY (user_id)
    REFERENCES Utilisateur(id)
    ON DELETE CASCADE
);

CREATE TABLE ReservationExcursion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_reservation DATE,
    nombre_personne INT,
    montant FLOAT,

    user_id INT NOT NULL,
    excursion_id INT NOT NULL,

    FOREIGN KEY (user_id)
    REFERENCES Utilisateur(id)
    ON DELETE CASCADE,

    FOREIGN KEY (excursion_id)
    REFERENCES Excursion(id)
    ON DELETE CASCADE
);

CREATE TABLE DemandeProprietaire (
    id INT AUTO_INCREMENT PRIMARY KEY,
    statut ENUM('en_attente','acceptee','refusee'),
    date DATE,
    description TEXT,

    user_id INT UNIQUE NOT NULL,

    FOREIGN KEY (user_id)
    REFERENCES Utilisateur(id)
    ON DELETE CASCADE
);
