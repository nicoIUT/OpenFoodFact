CREATE TABLE openfoodfacts._ingredientduproduit(
id_produit int,
id_ingredient int,
CONSTRAINT ingredientduproduit_pk PRIMARY KEY (id_ingredient, id_produit),
CONSTRAINT ingredientduproduit_fk1 FOREIGN KEY (id_ingredient) REFERENCES openfoodfacts._ingredient(id_ingredient),
CONSTRAINT ingredientduproduit_fk2 FOREIGN KEY (id_produit) REFERENCES openfoodfacts._produit(id_produit));

INSERT INTO openfoodfacts._ingredientduproduit VALUES(1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(2,8),(2,9);
