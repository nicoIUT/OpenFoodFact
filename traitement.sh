#!/bin/bash

dbname='pg_cellieai'
host='servbdd'
username='cellieai'
password='hv4gp26!'

nom='openfoodfacts'

# étape 1 : les additifs

echo 'Insertion des additifs...'

#cut -f 46 "$1" | tail -n +2 | tr ',' '\n' | sort | uniq | sed '/^\s*$/d' | while read line
#do
#	id=$(echo "$line" | awk -F' - ' '{$0=$1}1' -)
#	id=${id//"'"/"''"}
#	nom=$(echo "$line" | awk -F' - ' '{$0=$2}1' -)
#	nom=${nom//"'"/"''"}
#
#	PGPASSWORD=$password psql -h "$host" -U "$username" -d "$dbname" -c "insert into openfoodfacts._additif values ('$id', '$nom');" > /dev/null
#done

# étape 2 : les ingrédients

echo 'Insertion des ingrédients...'

echo 'Veuillez utiliser le programme go.'

echo 'OK'

# étape 3 : les marques

echo 'Insertion des marques...'

#cut -f 13 "$1" | tail -n +2 | sort | uniq | sed '/^\s*$/d' | while read line
#do
#	line=${line//"'"/"''"}
#	PGPASSWORD=$password psql -h "$host" -U "$username" -d "$dbname" -c "insert into openfoodfacts._marque values ('$line');" > /dev/null
#done

echo 'OK'

# étape 4 : les pays

echo 'Insertion des pays...'

#cut -f 34 "$1" | tail -n +2 | tr ',' '\n' | sort | uniq | sed '/^\s*$/d' | while read line
#do
#	PGPASSWORD=$password psql -h "$host" -U "$username" -d "$dbname" -c "insert into openfoodfacts._pays values ('$line');" > /dev/null
#done

echo 'OK'

# étape 4 : le reste

echo 'Insertion des produits...'

cut -f 2,4,6,8,13,34-35,41,46,54,64,66-67,100-103,112-113,117-118,120,125,139,141,160 "$1" | tail -n +2 | while read row
do
	url=$(echo "$row" | cut -f 1 -)
	url=${url//"'"/"''"}
	url="'$url'"

	if [ -z "$url" ]; then
		url="null"
	fi

	created_t=$(echo "$row" | cut -f 2 -)

	if [ -z "$created_t" ]; then
		created_t="null"
	else
		created_t="to_timestamp($created_t)"
	fi

	last_modified_t=$(echo "$row" | cut -f 3 -)

	if [ -z "$last_modified_t" ]; then
		last_modified_t="null"
	else
		last_modified_t="to_timestamp($last_modified_t)"
	fi

	product_name=$(echo "$row" | cut -f 4 -)
	product_name=${product_name//"'"/"''"}

	if [ -z "$product_name" ]; then
		product_name="null"
	else
		product_name="'$product_name'"
	fi

	brands=$(echo "$row" | cut -f 5 -)
	brands=${brands//"'"/"''"}

	if [ -z "$brands" ]; then
		brands="null"
	else
		brands="'$brands'"
	fi

	countries_fr=$(echo "$row" | cut -f 6 -)
	countries_fr=${countries_fr//"'"/"''"}

	if [ -z "$countries_fr" ]; then
		countries_fr="null"
	else
		countries_fr="'$countries_fr'"
	fi

	ingtxt=$(echo "$row" | cut -f 7 -)
	ingtxt=${ingtxt//"'"/"''"}

	if [ -z "$ingtxt" ]; then
		ingtxt="null"
	else
		ingtxt="'$ingtxt'"
	fi

	serving_size=$(echo "$row" | cut -f 8 -)
	serving_size=${serving_size//"'"/"''"}

	if [ -z "$serving_size" ]; then
		serving_size="null"
	else
		serving_size="'$serving_size'"
	fi

	nutrition_grade_fr=$(echo "$row" | cut -f 10 -)
	nutrition_grade_fr=${nutrition_grade_fr//"'"/"''"}

	if [ -z "$nutrition_grade_fr" ]; then
		nutrition_grade_fr="null"
	else
		nutrition_grade_fr="'$nutrition_grade_fr'"
	fi

	energy_100g=$(echo "$row" | cut -f 11 -)

	if [ -z "$energy_100g" ]; then
		energy_100g="null"
	fi

	fat_100g=$(echo "$row" | cut -f 12 -)

	if [ -z "$fat_100g" ]; then
		fat_100g="null"
	fi

	satured_fat_100g=$(echo "$row" | cut -f 13 -)

	if [ -z "$satured_fat_100g" ]; then
		satured_fat_100g="null"
	fi

	trans_fat_100g=$(echo "$row" | cut -f 14 -)

	if [ -z "$trans_fat_100g" ]; then
		trans_fat_100g="null"
	fi

	cholesterol_100g=$(echo "$row" | cut -f 15 -)

	if [ -z "$cholesterol_100g" ]; then
		cholesterol_100g="null"
	fi
	url=$(echo "$row" | cut -f 1 -)
	url=${url//"'"/"''"}
	url="'$url'"

	if [ -z "$url" ]; then
		url="null"
	fi
	carbohydrates_100g=$(echo "$row" | cut -f 16 -)

	if [ -z "$carbohydrates_100g" ]; then
		carbohydrates_100g="null"
	fi

	sugars_100g=$(echo "$row" | cut -f 17 -)

	if [ -z "$sugars_100g" ]; then
		sugars_100g="null"
	fi

	fibers_100g=$(echo "$row" | cut -f 18 -)

	if [ -z "$fibers_100g" ]; then
		fibers_100g="null"
	fi

	proteins_100g=$(echo "$row" | cut -f 19 -)

	if [ -z "$proteins_100g" ]; then
		proteins_100g="null"
	fi

	salt_100g=$(echo "$row" | cut -f 20 -)

	if [ -z "$salt_100g" ]; then
		salt_100g="null"
	fi

	sodium_100g=$(echo "$row" | cut -f 21 -)

	if [ -z "$sodium_100g" ]; then
		sodium_100g="null"
	fi

	vitamin_a_100g=$(echo "$row" | cut -f 22 -)

	if [ -z "$vitamin_a_100g" ]; then
		vitamin_a_100g="null"
	fi

	vitamin_c_100g=$(echo "$row" | cut -f 23 -)

	if [ -z "$vitamin_c_100g" ]; then
		vitamin_c_100g="null"
	fi

	calcium_100g=$(echo "$row" | cut -f 24 -)

	if [ -z "$calcium_100g" ]; then
		calcium_100g="null"
	fi

	iron_100g=$(echo "$row" | cut -f 25 -)

	if [ -z "$iron_100g" ]; then
		iron_100g="null"
	fi

	nutrition_score_fr_100g=$(echo "$row" | cut -f 26 -)

	if [ -z "$nutrition_score_fr_100g" ]; then
		nutrition_score_fr_100g="null"
	fi

	idproduit=$( PGPASSWORD=$password psql -A -h "$host" -U "$username" -d "$dbname" -c "insert into openfoodfacts._produit(created_t, last_modified_t, product_name, brands, serving_size, nutrition_grade_fr, energy_100g, fat_100g, satured_fat_100g, trans_fat_100g, cholesterol_100g, carbohydrates_100g, sugars_100g, fibers_100g, proteins_100g, salt_100g, sodium_100g, vitamin_a_100g, vitamin_c_100g, calcium_100g, iron_100g, nutrition_score_fr_100g) values ($created_t, $last_modified_t, $product_name, $brands, $serving_size, $nutrition_grade_fr, $energy_100g, $fat_100g, $satured_fat_100g, $trans_fat_100g, $cholesterol_100g, $carbohydrates_100g, $sugars_100g, $fibers_100g, $proteins_100g, $salt_100g, $sodium_100g, $vitamin_a_100g, $vitamin_c_100g, $calcium_100g, $iron_100g, $nutrition_score_fr_100g) RETURNING id_produit;" )

	idproduit=$( echo "$idproduit" | head -n 2 | tail -n 1)

	PGPASSWORD=$password psql -h "$host" -U "$username" -d "$dbname" -c "insert into openfoodfacts._reference values ($idproduit, $url, 'openfoodfacts');"

	PGPASSWORD=$password psql -h "$host" -U "$username" -d "$dbname" -c "insert into openfoodfacts._ingredienttexte values($idproduit, $ingtxt)"

	echo "$row" | cut -f 9 - | tr ',' '\n' | sort | uniq | sed '/^\s*$/d' | while read linee
	do
		id=$(echo "$linee" | awk -F' - ' '{$0=$1}1' -)
		id=${id//"'"/"''"}
		id="'$id'"
		PGPASSWORD=$password psql -h "$host" -U "$username" -d "$dbname" -c "insert into openfoodfacts._additifcontenus values($id, $idproduit)"
	done

	echo "$row" | cut -f 6 - | tr ',' '\n' | sort | uniq | sed '/^\s*$/d' | while read linee
	do
		linee=${linee//"'"/"''"}
		linee="'$linee'"
		PGPASSWORD=$password psql -h "$host" -U "$username" -d "$dbname" -c "insert into openfoodfacts._payscommercialiseproduit values($idproduit, $linee)"
	done
done
