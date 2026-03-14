# TP PHP — Jeux Web

## Jeu 1 — Pierre Feuille Ciseaux

### Objectif

Créer un jeu **Pierre / Feuille / Ciseaux** jouable dans un navigateur avec PHP.

---

## Version 1 — Jeu minimal

### Features

- Afficher un titre
- Afficher trois boutons :
  - Pierre
  - Feuille
  - Ciseaux
- Récupérer le choix du joueur via un formulaire `POST`
- Générer un choix aléatoire pour l'ordinateur
- Afficher :
  - le choix du joueur
  - le choix de l'ordinateur
  - le résultat : victoire / défaite / égalité

---

## Version 2 — Structurer le code

### Features

- Créer une fonction `getComputerChoice()`
- Créer une fonction `getResult($player, $computer)`
- Éviter de dupliquer le code des conditions
- Gérer les cas invalides

---

## Version 3 — Ajouter un score

### Features

- Ajouter un score pour le joueur
- Ajouter un score pour l'ordinateur
- Conserver les scores avec `$_SESSION`
- Ajouter un bouton **Réinitialiser la partie**

---

## Version 4 — Historique des manches

### Features

- Afficher la liste des manches précédentes
- Pour chaque manche afficher :
  - choix du joueur
  - choix de l'ordinateur
  - résultat
- Stocker l'historique dans `$_SESSION`

---

## Version 5 — Interface améliorée

### Features

- Afficher les choix avec des boutons ou cartes
- Colorer le résultat :
  - vert → victoire
  - rouge → défaite
  - gris → égalité
- Afficher le numéro de manche

---

## Bonus

- Premier joueur à **3 victoires** gagne la partie
- Statistiques de victoire

---

# Jeu 2 — Pendu simplifié

### Objectif

Créer un jeu du **Pendu** dans lequel le joueur doit deviner un mot lettre par lettre.

---

## Version 1 — Mot fixe

### Features

- Définir un mot dans le code
- Afficher le mot sous forme masquée :

```
_ _ _ _ _
```

- Permettre au joueur de proposer une lettre via un formulaire
- Vérifier si la lettre est dans le mot
- Réafficher le mot avec les lettres découvertes

---

## Version 2 — État de jeu

### Features

- Stocker les lettres déjà proposées
- Empêcher de proposer deux fois la même lettre
- Afficher :
  - lettres trouvées
  - lettres ratées

---

## Version 3 — Ajouter des vies

### Features

- Ajouter un nombre d'essais restants
- Si la lettre n'est pas dans le mot :
  - diminuer le nombre de vies
- Conditions de fin :
  - victoire si le mot est trouvé
  - défaite si les vies arrivent à 0

---

## Version 4 — Mot aléatoire

### Features

- Créer un tableau de mots
- Choisir un mot aléatoire au début de la partie
- Stocker le mot en `$_SESSION`

---

## Version 5 — Nouvelle partie

### Features

- Ajouter un bouton **Rejouer**
- Réinitialiser :
  - le mot
  - les lettres proposées
  - les erreurs
  - les vies

---

## Version 6 — Affichage amélioré

### Features

- Afficher le mot avec espaces :

```
P _ _ D _
```

- Afficher clairement :
  - lettres déjà proposées
  - erreurs
  - vies restantes
- Désactiver le formulaire quand la partie est terminée

---

## Bonus

- Afficher un **pendu ASCII** selon le nombre d'erreurs
- Choisir un thème de mots (animaux, pays, etc.)
- Ignorer les majuscules/minuscules
- Simplifier la gestion des accents

# Jeu 3 — Machine à sous (Slot Machine)

### Objectif

Créer une **machine à sous simple** dans laquelle le joueur lance la machine et obtient trois symboles aléatoires.

---

## Version 1 — Jeu minimal

### Features

* Afficher un titre
* Ajouter un bouton **Lancer**
* Générer **3 symboles aléatoires** parmi une liste (ex : 🍒 ⭐ 🔔 🍋)
* Afficher les trois symboles obtenus

---

## Version 2 — Résultat de la manche

### Features

* Vérifier si les trois symboles sont identiques
* Afficher le résultat :

  * **gagné**
  * **perdu**
* Mettre en évidence une victoire

---

## Version 3 — Ajouter des crédits

### Features

* Donner un nombre de **crédits au joueur**
* Chaque lancer coûte **1 crédit**
* Si le joueur gagne :

  * ajouter des crédits
* Stocker les crédits dans `$_SESSION`

---

## Version 4 — Historique

### Features

* Afficher les **manches précédentes**
* Pour chaque manche afficher :

  * les trois symboles
  * le résultat
* Stocker l’historique dans `$_SESSION`

---

## Version 5 — Interface améliorée

### Features

* Afficher les symboles sous forme de **cartes**
* Mettre en évidence les victoires
* Afficher clairement :

  * crédits restants
  * nombre de manches jouées

---

## Bonus

* Ajouter **des gains différents selon les symboles**
* Ajouter un **jackpot**
* Ajouter une animation simple de tirage

---

# Jeu 4 — Morpion simplifié

### Objectif

Créer un **jeu du morpion (Tic Tac Toe)** jouable contre l’ordinateur.

---

## Version 1 — Grille minimale

### Features

* Afficher une **grille 3 × 3**
* Chaque case est un bouton
* Quand le joueur clique :

  * placer un **X**
* Empêcher de jouer dans une case déjà occupée

---

## Version 2 — Tour de l’ordinateur

### Features

* Après le joueur :

  * l’ordinateur joue automatiquement
* L’ordinateur choisit **une case libre au hasard**
* Placer un **O**

---

## Version 3 — Vérification de victoire

### Features

* Vérifier si un joueur a gagné :

  * ligne
  * colonne
  * diagonale
* Afficher :

  * victoire joueur
  * victoire ordinateur
  * égalité

---

## Version 4 — État de jeu

### Features

* Stocker la grille dans `$_SESSION`
* Conserver l’état de la partie entre les requêtes
* Bloquer les clics si la partie est terminée

---

## Version 5 — Nouvelle partie

### Features

* Ajouter un bouton **Rejouer**
* Réinitialiser :

  * la grille
  * le résultat
  * le tour de jeu

---

## Bonus

* Afficher **qui doit jouer**
* Ajouter un **score joueur / ordinateur**
* Améliorer l’IA (bloquer une victoire possible)
