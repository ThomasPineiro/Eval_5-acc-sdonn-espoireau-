<?php
echo'meh';

$bd = "host=localhost port=5432 dbname=bdpoireau user=admin password=admin";
$connect = pg_connect($bd);

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
$array_tab = pg_fetch_array($selec_tab);
?>