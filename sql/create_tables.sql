CREATE TABLE Asiakas(
  id SERIAL PRIMARY KEY,
  henkilotunnus varchar(11) NOT NULL,
  sukunimi varchar(30) NOT NULL,
  etunimi varchar(30) NOT NULL,
  katuosoite varchar(30) NOT NULL,
  postinumero INTEGER NOT NULL,
  postitoimipaikka varchar(30) NOT NULL,
  puhelinnumero varchar(20) NOT NULL,
  tila varchar(10) NOT NULL
);

CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY,
  kayttajatunnus varchar(12) NOT NULL,
  salasana varchar(100) NOT NULL,
  rooli varchar(10) NOT NULL,
  asiakastunnus INTEGER REFERENCES Asiakas(id),
  tila varchar(10) NOT NULL
);

CREATE TABLE Tuote(
  id SERIAL PRIMARY KEY,
  tuotetunnus varchar(8) NOT NULL UNIQUE,
  tuotenimi varchar(20) NOT NULL
);

CREATE TABLE Sopimus(
  id SERIAL PRIMARY KEY,
  sopimustunnus varchar(12) NOT NULL,
  tuotetunnus varchar(8) REFERENCES Tuote(tuotetunnus),
  vakuutuksenottaja INTEGER NOT NULL REFERENCES Asiakas(id),
  vakuutettu1 INTEGER NOT NULL REFERENCES Asiakas(id),
  vakuutettu2 INTEGER REFERENCES Asiakas(id),
  tila varchar(10) NOT NULL,
  turvanSuuruus float(10) NOT NULL,
  vakuutusmaksu float(10) NOT NULL
);
