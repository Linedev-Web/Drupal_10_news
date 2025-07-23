# Test Technique : Drupal 10

## Objectif
Construire les fondations d'un site d'actualités.

- **Durée** : 2 heures
- **Critères d'évaluation** : Qualité du code, respect des bonnes pratiques Drupal, capacité à interpréter les exigences.

---

## 1. Configuration Initiale

- Installer Drupal 10 (profil minimal) via Composer et installer Drush 12.
- S'assurer que le répertoire de configuration est situé en dehors du répertoire web public.
- Créer les rôles :
    - **Administrateur** (tous les droits)
    - **Contributeur** (droit de contribution au contenu)
    - **Internaute**
- Gérer les modules par environnement :
    - **Devel** : Actif en local uniquement
    - **Metatag** : Actif en production uniquement

## 2. Structure du Contenu "Actualité"

Créer un type de contenu **Actualité** avec les champs suivants :

- **Titre**
- **Description** : Champ texte riche configuré pour autoriser l'insertion de médias, de listes à puces et l'utilisation des couleurs de police suivantes : `#8C1F28`, `#044040`.
- **Date** : La date de l'événement ou de l'actualité.
- **Date d’auto-publication** : Un champ permettant de programmer la publication future du contenu, avec le système d'auto-publication fonctionnel.
- **Média** : Champ pour l'image principale.
- **Tag** : Champ de taxonomie.
- Générer 200 contenus "Actualité" pour les tests.

## 3. Module Custom `news`

- Créer un module custom `news` qui déclare une page à l'URL `/news` via un contrôleur (ne pas utiliser le module Views).
- La requête dans le contrôleur doit récupérer les actualités publiées, accessibles à tous les rôles, et dont la date est supérieure à la date du jour.
- **Tri** : Les résultats doivent être triés par date ascendante.
- La page doit afficher 10 résultats et disposer d'une pagination.

## 4. Thème Custom `test_news` et Frontend

- Créer un thème `test_news` avec ses fichiers CSS et JS.
- Créer les templates Twig nécessaires (teaser, vue détaillée, page de liste).
- **JavaScript** : Un clic sur un teaser redirige vers la page de détail (en JS vanilla).
- **Style et Layout** :
    - La liste des actualités doit être affichée sur 2 colonnes avec 2rem de marge (desktop) et 1 colonne avec 1rem de marge (mobile).
    - L'ordre visuel des actualités sur la page doit être descendant (du plus récent au plus ancien).
- **Couleur du titre** :
    - Le titre doit utiliser une classe helper qui s'appuie sur une variable CSS. La valeur de cette variable doit changer en fonction du contexte (ex: `.card-news` vs `.page-news`).
    - La couleur résultante est `#8C1F28` sur desktop et `#044040` sur mobile.

---

## Rapport et Explications

Si vous avez des explications à fournir sur vos choix techniques, sur une tâche non terminée, ou toute autre information pertinente, vous pouvez les écrire dans un fichier `rapport.md` à la racine de votre projet.

## Rendu Final

Une fois le test terminé, merci d'envoyer votre travail en poussant votre code sur le dépôt Git qui vous a été communiqué. Si vous rencontrez un problème, une archive `.zip` de votre projet sera acceptée.

> **Note** : Ce test a pour unique but de vous évaluer pour un entretien et ne sera bien entendu pas utilisé par notre équipe.
