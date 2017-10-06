# Tietokantasovelluksen esittelysivu

## Tilanne viikon 5 jälkeen:

Valitettavasti en ole saanut edistetty sovellusta ja dokumentaatiota siinä tahdissa kun kurssin aikataulu
etenee. Taistelin nyt pari viikkoa kirjautumisen/sessioiden kanssa ja sain sen viimein alustavasti toimimaan
(ei toimi siis vielä täydellisesti). Joudun tekemään jonkin verran refaktorointia suunnitelmaan seuraavan viikon
aikana, kun kurssin edetessä tekemiseen tulee uusia näkökulmia. Joudun mm. toteuttamaan kokonaan erillisen kirjautumisen
"asiakkaalle" ja "toimihenkilölle". Nyt sain valmiiksi tuon asiakkaan kirjautumisen. Uskon kuitenkin, että ensi viikon
demoon saan ihan hyvin toimivan sovelluksen, missä asiakkaan kirjautuminen sisään/ulos toimii sujuvasti sekä asiakas pääsee näkemään ja muuttamaan tietojaan kirjautumisen jälkeen (päivittämisen/poistamisen toteutin jo edellisellä viikolla ilman kirjautumista). Lopulliseen palautukseen lisään myös toimihenkilön tarvitsemat toiminnallisuudet ja tietenkin kattavan dokumentaation.

Asiakkaana pääsee nyt kirjautumaan seuraavasta linkistä:
* [Asiakkaan kirjautuminen](http://vtikkala.users.cs.helsinki.fi/rekisteri/user/login)

Käyttäjätunnus: testi1
Salasana: salasana1

Yleisiä linkkejä:

* [Linkki sovellukseeni](http://vtikkala.users.cs.helsinki.fi/rekisteri/)
* [Linkki dokumentaatiooni](https://github.com/vtikkala/Tsoha-Bootstrap/blob/master/doc/dokumentaatio.pdf)

## Työn aihe

Vakuutusrekisteri -sovellus on yksinkertainen vakuutusten myyntiin ja hoitamiseen liittyvä web-sovellus, jonka kautta
vakuutusyhtiön toimihenkilö voi tehdä asiakkaalle tarjouksia ja muutoksia vakuutuksiin, ja asiakas voi hyväksyä tarjouksia ja muuttaa tietojaan.

## Linkit toimiviin sivuihin

* [Asiahaku](http://vtikkala.users.cs.helsinki.fi/rekisteri/customer)

Asiakashaku hakee nyt kaikki tietokannasta löytyvät asiakkaat. Hakua ei voi vielä rajata käyttöliittymän hakuehdoilla.

* [Asiakkaan luonti](http://vtikkala.users.cs.helsinki.fi/rekisteri/customer/new)

Sivulla voi luoda uuden asiakkaan tietokantaan. Sivu ohjautuu sen jälkeen muokkaus-sivulle, joka on tarkoitus korvata paremmalla ratkaisulla ensi viikolla.

## Linkit alustaviin sivuihin

* [Kirjautuminen](http://vtikkala.users.cs.helsinki.fi/rekisteri/login)
* [Asiakkaan muokkaaminen](http://vtikkala.users.cs.helsinki.fi/rekisteri/customer/modify)
