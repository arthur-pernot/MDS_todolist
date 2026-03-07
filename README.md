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
