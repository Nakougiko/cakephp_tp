# CakePHP TP - Gestion du sommeil

## 📌 Description
Ce projet a été réalisé dans le cadre de mes études en Licence Professionnelle. Il s'agit d'une application web développée avec **CakePHP**, comprenant :

- Une **page de connexion** (login)
- Un **trackeur de sommeil** avec affichage graphique et comptage des cycles de sommeil
- Une **gestion des menus** avec un système de **drag & drop**
- Une **gestion des utilisateurs** (affichage, modification et suppression de comptes)

## 🛠️ Technologies utilisées
- **CakePHP** (framework PHP)
- **MySQL / MariaDB** (base de données)
- **JavaScript** (interactions dynamiques, notamment pour le drag & drop)
- **Bootstrap** (mise en page et design)
- **Chart.js** (visualisation des données du sommeil)

## 📂 Structure du projet

```
.
├── app/
│   ├── Controller/
│   ├── Model/
│   ├── View/
│   ├── Template/
│   └── Config/
├── webroot/
│   ├── css/
│   ├── js/
│   └── img/
├── logs/
├── tmp/
└── README.md
```

## 🚀 Installation

1. **Cloner le dépôt** :
   ```sh
   git clone https://github.com/Nakougiko/cakephp_tp.git
   cd cakephp_tp
   ```

2. **Installer les dépendances via Composer** :
   ```sh
   composer install
   ```

3. **Configurer la base de données** :
   - Modifier `config/app.php` avec vos paramètres MySQL / MariaDB
   - Importer le fichier SQL (s'il est fourni) dans votre base de données

4. **Lancer le serveur de développement** :
   ```sh
   bin/cake server
   ```
   L'application sera accessible sur `http://localhost:8765`

## 📌 Fonctionnalités principales

### 🔐 Authentification
- Système de connexion sécurisé avec email et mot de passe.
- Gestion des sessions utilisateur.

### 🌙 Suivi du sommeil
- Interface permettant d'ajouter et de suivre ses cycles de sommeil.
- Affichage de graphiques via **Chart.js**.
- Calcul automatique des cycles de sommeil.

### 📋 Gestion des menus (Drag & Drop)
- Interface intuitive pour organiser les menus.
- Drag & Drop pour réordonner les éléments.
- Sauvegarde des modifications en base de données.

### 👤 Gestion des utilisateurs
- Affichage de la liste des utilisateurs.
- Modification des informations utilisateur.
- Suppression des comptes.

## 🌐 Hébergement
Ce projet est hébergé sur **Alwaysdata** : [gouloislukas.alwaysdata.net](https://gouloislukas.alwaysdata.net/).

### 📢 Instructions de déploiement sur Alwaysdata
1. **Créer un compte sur [Alwaysdata](https://www.alwaysdata.com/en/)**.
2. **Déployer les fichiers CakePHP sur le serveur distant**.
3. **Configurer la base de données** dans l'interface Alwaysdata.
4. **Mettre à jour le fichier `config/app.php`** avec les informations de connexion à la base de données distante.
5. **S'assurer que les permissions des fichiers et dossiers sont bien définies**.
6. **Accéder au site via l'URL fournie par Alwaysdata**.

## 🖼️ Aperçu
![Capture d'écran 2025-03-04 234448](https://github.com/user-attachments/assets/f6e3e61d-4c78-4c56-b147-91e598ca00fe)
---
![Capture d'écran 2025-03-04 234542](https://github.com/user-attachments/assets/a3bc7d07-a3c4-4d4a-847e-c72348c2b2fe)


## 📝 To-Do / Améliorations possibles
- ✅ Page de connexion
- ✅ Suivi du sommeil avec graphique
- ✅ Gestion dynamique des menus
- ✅ Gestion des utilisateurs
- 🔲 Améliorer l'interface utilisateur
- 🔲 Ajouter un mode sombre
- 🔲 Ajouter des statistiques avancées sur le sommeil

## 📜 Licence
Ce projet est sous licence MIT.

## ✉️ Contact
Si vous avez des questions ou des suggestions, vous pouvez me contacter via **[GitHub](https://github.com/Nakougiko)** ou via l'email disponible sur le site.
