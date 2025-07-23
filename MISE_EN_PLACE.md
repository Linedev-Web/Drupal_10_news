Voici le contenu complet du fichier **`MISE_EN_PLACE.md`** prêt à être copié-collé **en un seul bloc** :

---

````md
# MISE EN PLACE DU PROJET DRUPAL 10

Ce document explique comment installer et exécuter localement le site Drupal 10 après avoir cloné le dépôt.

---

## 1. Installation des dépendances

Après avoir cloné le projet, exécutez la commande suivante à la racine :

```bash
composer install
````

Cela installera toutes les dépendances nécessaires, y compris Drupal Core, les modules contrib/custom, et Drush.

---

## 2. Configuration du serveur web

Assurez-vous que votre serveur Apache ou Nginx est correctement configuré pour pointer **vers le dossier `/web`** du projet.

### Exemple Apache (Laragon sur Windows) :

```apache
DocumentRoot "C:/workspace/laragon/www/Drupal_10_news/web"
```

### Exemple Nginx :

```nginx
server {
    listen 80;
    server_name drupal_10_news.test;

    root /var/www/Drupal_10_news/web;
    index index.php;

    # Autres directives habituelles...
}
```

Cette configuration garantit que Drupal fonctionne correctement et que les chemins publics sont bien gérés.

---

## 3. Accès au site

Une fois les dépendances installées et le serveur configuré, vous pouvez accéder au site via votre navigateur à l’URL locale de votre choix.

Deux comptes sont déjà configurés pour tester le site avec des rôles différents :

### 🔐 Compte Administrateur

* **Identifiant** : `admin`
* **Mot de passe** : `admin`

Ce compte dispose de **tous les droits**.

### 👤 Compte Utilisateur Lambda

* **Identifiant** : `toto`
* **Mot de passe** : `toto`

Ce compte représente un utilisateur standard sans privilèges administratifs.

---

Le site est désormais prêt à être utilisé.
N'hésitez pas à explorer les fonctionnalités et à personnaliser le contenu selon vos besoins.
````