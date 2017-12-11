CREATE SCHEMA openfoodfacts;

CREATE TABLE openfoodfacts._additif(
id_additif varchar(10),
nom Varchar(255) NOT NULL,
CONSTRAINT _additifs_pk PRIMARY KEY (id_additif)
);

CREATE TABLE openfoodfacts._compte(
id_compte serial,
pseudo varchar(50) NOT NULL,
pass varchar(255) NOT NULL,
email varchar(100) NOT NULL,
CONSTRAINT _compte_pk PRIMARY KEY (id_compte));

CREATE TABLE openfoodfacts._marque(
nom varchar(100),
CONSTRAINT _marque_pk PRIMARY KEY (nom));

CREATE TABLE openfoodfacts._ingredient(
ingredients_text text,
CONSTRAINT _ingredient_pk PRIMARY KEY (ingredients_text));

CREATE TABLE openfoodfacts._pays(
nom VARCHAR(100),
CONSTRAINT _pays_pk PRIMARY KEY (nom));

CREATE TABLE openfoodfacts._produit(
id_produit serial,
created_t timestamp,
last_modified_t timestamp,
product_name varchar(100),
brands varchar(100),
countries_fr varchar(100),
serving_size varchar(100),
nutrition_grade_fr varchar(1),
energy_100g decimal,
fat_100g decimal,
satured_fat_100g decimal,
trans_fat_100g decimal,
cholesterol_100g decimal,
carbohydrates_100g decimal,
sugars_100g decimal,
fibers_100g decimal,
proteins_100g decimal,
salt_100g decimal,
sodium_100g decimal,
vitamin_a_100g decimal,
vitamin_c_100g decimal,
calcium_100g decimal,
iron_100g decimal,
nutrition_score_fr_100g int,
CONSTRAINT _produit_pk PRIMARY KEY (id_produit),
CONSTRAINT _produit_fk1 FOREIGN KEY (brands) REFERENCES openfoodfacts._marque(nom),
CONSTRAINT _produit_fk2 FOREIGN KEY (countries_fr) REFERENCES openfoodfacts._pays(nom));

CREATE TABLE openfoodfacts._ingredientTexte(
id_produit int,
ingredient_text text,
CONSTRAINT _ingredientTexte_pk PRIMARY KEY (ingredient_text),
CONSTRAINT _ingredientTexte_fk FOREIGN KEY (id_produit) REFERENCES openfoodfacts._produit(id_produit));

CREATE TABLE openfoodfacts._reference(
id_reference int,
url varchar(255),
nom varchar(100),
CONSTRAINT _reference_pk PRIMARY KEY (id_reference),
CONSTRAINT _reference_fk1 FOREIGN KEY (id_reference) REFERENCES openfoodfacts._produit(id_produit));

CREATE TABLE openfoodfacts._contributeur(
id_produit int,
id_compte int,
CONSTRAINT _constributeur_pk PRIMARY KEY (id_produit),
CONSTRAINT _contributeur_fk1 FOREIGN KEY (id_produit) REFERENCES openfoodfacts._produit(id_produit),
CONSTRAINT _contributeur_fk2 FOREIGN KEY (id_compte) REFERENCES openfoodfacts._compte(id_compte));

CREATE TABLE openfoodfacts._additifcontenus(
id_additif varchar(10),
id_produit int,
CONSTRAINT _additifcontenus_pk PRIMARY KEY (id_produit, id_additif),
CONSTRAINT _additifcontenus_fk1 FOREIGN KEY (id_produit) REFERENCES openfoodfacts._produit(id_produit),
CONSTRAINT _additifcontenus_fk2 FOREIGN KEY (id_additif) REFERENCES openfoodfacts._additif(id_additif));

CREATE TABLE openfoodfacts._ingredientcontenusproduit(
id_produit int,
ingredients_text text,
CONSTRAINT _ingredientcontenusproduit_pk PRIMARY KEY (id_produit, ingredients_text),
CONSTRAINT _ingredientcontenus_fk1 FOREIGN KEY (id_produit) REFERENCES openfoodfacts._produit(id_produit),
CONSTRAINT _ingredientcontenus_fk2 FOREIGN KEY (ingredients_text) REFERENCES openfoodfacts._ingredient(ingredients_text)
);

CREATE TABLE openfoodfacts._ingredientcontenusingredient(
ingredients_contenant text,
ingredients_contenu text,
CONSTRAINT _ingredientcontenusingredient_pk PRIMARY KEY (ingredients_contenu, ingredients_contenant),
CONSTRAINT _ingredientcontenus_fk1 FOREIGN KEY (ingredients_contenu) REFERENCES openfoodfacts._ingredient(ingredients_text),
CONSTRAINT _ingredientcontenus_fk2 FOREIGN KEY (ingredients_contenant) REFERENCES openfoodfacts._ingredient(ingredients_text)
);


/*
INSERT INTO openfoodfacts._produit(
created_t,
last_modified_t,
product_name,
brands,
countries_fr,
serving_size,
nutrition_grade_fr,
energy_100g,
fat_100g,
satured_fat_100g,
trans_fat_100g,
cholesterol_100g,
carbohydrates_100g,
sugars_100g,
fibers_100g,
proteins_100g,
salt_100g,
sodium_100g,
vitamin_a_100g,
vitamin_c_100g,
calcium_100g,
iron_100g,
nutrition_score_fr_100g)
VALUES(
now(),
now(),
'Spagheti',
'Panzani',
'france',
'paquet',
'f',
1,
2,
3,
4,
5,
6,
7,
8,
9,
10,
11,
12,
13,
14,
15,
16
);

http://localhost/OpenFoodFact/CodeIgniter/index.php/Produits/display/1
*/