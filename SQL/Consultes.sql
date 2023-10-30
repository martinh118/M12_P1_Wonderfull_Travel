-- Seleccionar llista de paisos amb els corresponents continents
SELECT c.nom AS "Continent", p.nom AS "Pais"
FROM wonderfull_travel.pais p
RIGHT JOIN wonderfull_travel.continent c ON p.continent_id  = c.id;

-- Resultat
-- Continent   Pais
-- --------------------------
-- Europa      espanya
-- América     Estados Unidos
-- América     Canadá
-- Europa      Francia
-- Europa      Alemania
-- Asia        China
-- Asia        Japón

-- Mostrar la llista d'ofertes
SELECT c.nom AS "Continent", p.nom AS "Pais", o.preu AS "Preu", o.imatges AS "Ruta Imatges", o.durada_dies AS "Durada", o.valida AS "Activa"
FROM wonderfull_travel.pais p
RIGHT JOIN wonderfull_travel.continent c ON p.continent_id  = c.id
INNER JOIN wonderfull_travel.ofertes o ON p.id = o.pais_id;

-- Resultat
-- Continent	Pais				Preu		Imatge Petita	Durada	Activa
-- ------------------------------------------------------------------
-- Africa		Angola			199,99	angola			9			1
-- Europa		Belgica			99,99		belgica			3			1

