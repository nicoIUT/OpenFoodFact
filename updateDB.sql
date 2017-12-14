DROP TABLE openfoodfacts._ingredientcontenusproduit;
DROP TABLE openfoodfacts._ingredientcontenusingredient;
DROP TABLE openfoodfacts._ingredient;


CREATE TABLE openfoodfacts._ingredient(
id_ingredient serial,
ingredients_text text,
CONSTRAINT _ingredient_pk PRIMARY KEY (id_ingredient));

CREATE TABLE openfoodfacts._ingredientcontenusproduit(
id_produit int,
id_ingredient int,
CONSTRAINT _ingredientcontenusproduit_pk PRIMARY KEY (id_produit, id_ingredient),
CONSTRAINT _ingredientcontenus_fk1 FOREIGN KEY (id_produit) REFERENCES openfoodfacts._produit(id_produit),
CONSTRAINT _ingredientcontenus_fk2 FOREIGN KEY (id_ingredient) REFERENCES openfoodfacts._ingredient(id_ingredient)
);

CREATE TABLE openfoodfacts._ingredientcontenusingredient(
id_ingredient_contenant int,
id_ingredient_contenu int,
CONSTRAINT _ingredientcontenusingredient_pk PRIMARY KEY (id_ingredient_contenu, id_ingredient_contenant),
CONSTRAINT _ingredientcontenus_fk1 FOREIGN KEY (id_ingredient_contenu) REFERENCES openfoodfacts._ingredient(id_ingredient),
CONSTRAINT _ingredientcontenus_fk2 FOREIGN KEY (id_ingredient_contenant) REFERENCES openfoodfacts._ingredient(id_ingredient)
);

INSERT INTO openfoodfacts._ingredient(ingredients_text) VALUES('pate'),('jambon'),('creme'),('farine'),('oeuf'),('lait'),('blé');

INSERT INTO openfoodfacts._ingredientcontenusproduit VALUES(18943,1),(18943,2),(18943,3);

INSERT INTO openfoodfacts._ingredientcontenusingredient VALUES(1,4),(1,5),(3,6),(4,7);

