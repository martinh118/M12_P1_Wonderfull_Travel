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
VALUES (@idAfrica, "Angola"),
    (@idAfrica, "Algeria"),
    (@idAfrica, "Benin"),
    (@idAfrica, "Botswana"),
    (@idAfrica, "Burkina Faso"),
    (@idAsia, "China"),
    (@idAsia, "India"),
    (@idAsia, "Indonesia"),
    (@idAsia, "Pakistan"),
    (@idAsia, "Bangladesh"),
    (@idEuropa, "Austria"),
    (@idEuropa, "Belgium"),
    (@idEuropa, "Bulgaria"),
    (@idEuropa, "Croatia"),
    (@idEuropa, "Cyprus"),
    (@idNordAmerica, "Antigua and Barbuda"),
    (@idNordAmerica, "Bahamas"),
    (@idNordAmerica, "Barbados"),
    (@idNordAmerica, "Belize"),
    (@idNordAmerica, "Canada"),
    (@idOceania, "Australia"),
    (@idOceania, "Fiji"),
    (@idOceania, "Kiribati"),
    (@idOceania, "Marshall Islands"),
    (@idOceania, "Micronesia"),
    (@idSudAmerica, "Argentina"),
    (@idSudAmerica, "Bolivia"),
    (@idSudAmerica, "Brazil"),
    (@idSudAmerica, "Chile"),
    (@idSudAmerica, "Colombia");