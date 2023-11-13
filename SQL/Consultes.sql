-- Seleccionar llista de paisos amb els corresponents continents
SELECT c.nom AS "Continent",
    p.nom AS "Pais"
FROM wonderfull_travel.pais p
    RIGHT JOIN wonderfull_travel.continent c ON p.continent_id = c.id;
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
------------------------------
------------------------------
--||||||||||||||||||||||||||--
------------------------------
-- Mostrar la llista d'ofertes
SELECT c.nom AS "Continent",
    p.nom AS "Pais",
    o.preu AS "Preu",
    o.imatges AS "Ruta Imatges",
    o.durada_dies AS "Durada",
    o.valida AS "Activa"
FROM wonderfull_travel.pais p
    RIGHT JOIN wonderfull_travel.continent c ON p.continent_id = c.id
    INNER JOIN wonderfull_travel.ofertes o ON p.id = o.pais_id;
-- Resultat
-- Continent	Pais        Preu		Imatge Petita	Durada	    Activa
-- -----------------------------------------------------------------------
-- Africa		Angola      199,99      angola			9			1
-- Europa		Belgica      99,99		belgica			3			1
--------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------
--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--
------------------------------------------------------------------------------------------------------
-- Mostrar la llista de reserves (sense fer join amb les ofertes ja que seria una consulta massa gran)
SELECT r.client_nom AS "Nom",
    r.client_telefon AS "Telefon",
    r.quantitat_persones AS "Persones",
    r.data_inici AS "Data Inici",
    r.descompte AS "Descompte",
    r.oferta_id AS "Oferta"
FROM wonderfull_travel.reserva r;
-- Resultat
-- Nom      Telefon     Persones    Descompte   Oferta
------------------------------------------------------
-- Miguel   688949494   2           0           5
-- Pepe     688949494   3           1           2
------------------------------------------------------
--------------------------------------------------------------------------------------------------------
--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--
--------------------------------------------------------------------------------------------------------
-- Mostrar oferta fent servir una subconsulta per cercar el nom del pais. Seria convenient no fer serivr
-- aquesta consulta, i en comptes de cercar per nom, cercar per id directament (emmagatzemant l'id en el 
-- formulari en comptes de emmagatzemar el nom del pais.)
SELECT *
FROM `wonderfull_travel`.`ofertes`
WHERE pais_id = (
        SELECT p.id
        FROM `wonderfull_travel`.`pais` AS p
        WHERE p.nom = 'Belize'
    )
LIMIT 1;
-- Resultat
--------------------------------------------------------------
-- id   pais_id     preu    imatges     durada_dies     valida
-- 19   19          50.00   temp        3               1
--------------------------------------------------------------