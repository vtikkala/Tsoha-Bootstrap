INSERT INTO asiakas(id, henkilotunnus, sukunimi, etunimi, katuosoite, postinumero, postitoimipaikka, puhelinnumero, tila) VALUES ('1', '010199-010A', 'Meikäläinen', 'Matti', 'Testikatu 1', '00000', 'HELSINKI', '050-0101010', 'aktiivi');
INSERT INTO kayttaja(id, kayttajatunnus, salasana, rooli, tila) VALUES ('1', 'testi1', 'salasana1', 'asiakas', 'aktiivi');
INSERT INTO tuote(id, tuotetunnus, tuotenimi) VALUES ('1', '100', 'Pariturva');
INSERT INTO sopimus(id, sopimustunnus, tuotetunnus, vakuutuksenottaja, vakuutettu1, tila, turvanSuuruus, vakuutusmaksu) VALUES ('1', '9999', '100', '1', '1', 'aktiivi', '1000.00', '100.00');
