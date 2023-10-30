-- Insertar algunos continentes y obtener sus IDs
INSERT INTO wonderfull_travel.continent (nom)
VALUES ('Africa'),
    ('Asia'),
    ('Europa'),
    ('Nord América'),
    ('Oceania'),
    ('Sud América');
    
-- Obtener los IDs de los continentes recién insertados
SET @idAfrica = LAST_INSERT_ID();
SET @idAsia = @idAfrica + 1;
SET @idEuropa = @idAsia + 1;
SET @idNordAmerica = @idEuropa + 1;
SET @idOceania = @idNordAmerica + 1;
SET @idSudAmerica = @idOceania + 1;

-- Insertar algunos países asociados a los continentes
INSERT INTO wonderfull_travel.pais (continent_id, nom)
VALUES (@idAfrica, "Kenia"),
    (@idAfrica, "Nigeria"),
    (@idAfrica, "Sudán"),
    (@idAfrica, "Botswana"),
    (@idAfrica, "Burkina Faso"),
    (@idAsia, "China"),
    (@idAsia, "India"),
    (@idAsia, "Rusia"),
    (@idAsia, "Pakistan"),
    (@idAsia, "Bangladesh"),
    (@idEuropa, "Spain"),
    (@idEuropa, "Holand"),
    (@idEuropa, "Italy"),
    (@idEuropa, "Croatia"),
    (@idEuropa, "Cyprus"),
    (@idNordAmerica, "United States"),
    (@idNordAmerica, "Mexico"),
    (@idNordAmerica, "Barbados"),
    (@idNordAmerica, "Belize"),
    (@idNordAmerica, "Canada"),
    (@idOceania, "Australia"),
    (@idOceania, "Fiji"),
    (@idOceania, "New Zealand"),
    (@idOceania, "Marshall Islands"),
    (@idOceania, "Micronesia"),
    (@idSudAmerica, "Argentina"),
    (@idSudAmerica, "Bolivia"),
    (@idSudAmerica, "Brazil"),
    (@idSudAmerica, "Peru"),
    (@idSudAmerica, "Colombia");