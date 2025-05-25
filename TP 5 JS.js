
let premierNombre = parseFloat(prompt("Veuillez saisir le premier nombre :"));

let deuxiemeNombre = parseFloat(prompt("Veuillez saisir le deuxième nombre :"));

let somme = premierNombre + deuxiemeNombre;
let difference = premierNombre - deuxiemeNombre;
let produit = premierNombre * deuxiemeNombre;
let quotient = deuxiemeNombre !== 0 ? premierNombre / deuxiemeNombre : "Erreur : Division par zéro";

console.log("Somme : " + somme);
console.log("Différence : " + difference);
console.log("Produit : " + produit);
console.log("Quotient : " + quotient);