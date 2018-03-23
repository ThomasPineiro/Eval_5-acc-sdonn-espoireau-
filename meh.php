<?php
//connection
$bd = "host=localhost port=5432 dbname=bdpoireau user=admin password=admin";
$connect = pg_connect($bd);

// Requête n°1 : afficher le stock
$selec_tab = pg_query("SELECT pro_nom, sum(st) 
FROM (SELECT pro_leg,pro_nom, -sto_qte as st
FROM stock
INNER JOIN produit ON pro_id=spro_id
WHERE sto_pert = True
UNION
SELECT pro_leg, pro_nom, sto_qte as st
FROM stock
INNER JOIN produit ON pro_id=spro_id
WHERE sto_pert = False
UNION 
SELECT pro_leg, pro_nom, -con_qte as st
FROM contenu
INNER JOIN produit ON cpro_id = pro_id) as s
GROUP BY pro_leg,pro_nom
ORDER BY pro_leg,pro_nom");

//Afficher uniquement le stock de fruits
$selec_tab_f = pg_query("SELECT pro_nom, sum(st) 
FROM (SELECT pro_leg,pro_nom, -sto_qte as st
FROM stock
INNER JOIN produit ON pro_id=spro_id
WHERE sto_pert = True AND pro_leg = False
UNION
SELECT pro_leg, pro_nom, sto_qte as st
FROM stock
INNER JOIN produit ON pro_id=spro_id
WHERE sto_pert = False AND pro_leg = False
UNION 
SELECT pro_leg, pro_nom, -con_qte as st
FROM contenu
INNER JOIN produit ON cpro_id = pro_id) as s
GROUP BY pro_leg,pro_nom
ORDER BY pro_leg,pro_nom");

//Afficher uniquement le stock de légumes
$selec_tab_l = pg_query("SELECT pro_nom, sum(st) 
FROM (SELECT pro_leg,pro_nom, -sto_qte as st
FROM stock
INNER JOIN produit ON pro_id=spro_id
WHERE sto_pert = True AND pro_leg = True
UNION
SELECT pro_leg, pro_nom, sto_qte as st
FROM stock
INNER JOIN produit ON pro_id=spro_id
WHERE sto_pert = False AND pro_leg = True
UNION 
SELECT pro_leg, pro_nom, -con_qte as st
FROM contenu
INNER JOIN produit ON cpro_id = pro_id) as s
GROUP BY pro_leg,pro_nom
ORDER BY pro_leg,pro_nom");

//Requête n°4 : ajouter du stock sur un produit
$recup_stock = pg_query("SELECT sto_qte FROM stock WHERE ")

?>