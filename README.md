# Stack Elastic Search | Moteur de recherche


## Fonctionnalités

- Recherche de documents en full-text
 ```
'localhost:9200/search_engine/_search?query='facebook''
 ```

- Crawling de site web via CURL en PHP

- Indexiation de document après du site (url du site , nom de la page web , contenu de la page)
 ```
'localhost:9200/search_engine/_doc/
{
 'link':'...' ,
 'title':'...' ,
 'content':'...'   
}
 ```

## Installation

composer install

## Démarrage 

Avoir un noeud d'elastic search qui tourne sur le port 9200 puis faire les commandes dans ce répertoire ES

bin/elasticsearch

Démarrer un serveur PHP 

php -S localhost:3200 (ou une autre port si vous souhaitez)


# Sites à indexer avant de tester

Facebook spoils the cryptocurrency party
https://www.axios.com/facebook-libra-cryptocurrencies-government-scrutiny-fb60173d-b3be-41bf-b675-f097a98d2843.html

TikTok is China's next big weapon in the battle for personal data - Axios
https://www.axios.com/tiktok-china-online-privacy-personal-data-6b251d22-61f4-47e1-a58d-b167435472e3.html

The cost of bail for immigrants is surging
https://www.axios.com/immigrant-bail-bonds-costs-rising-ice-judges-2e3a06b6-9802-4157-a282-ac9e9587a10d.html

Instagram head: Here's why Facebook shouldn't be broken up
https://www.axios.com/instagram-head-at-code-conference-fc7d8b58-8f36-4e86-b1e7-b61f2e814143.html


Pence: NASA ready for final preparations for U.S. manned Moon mission
https://www.axios.com/mike-pence-nasa-to-prepare-for-us-moon-mission-907db435-cc75-4e7a-ad00-a9d6ec0204e3.html

All the Moon landings, from Luna to Apollo to Chang'e
https://www.axios.com/all-moon-landings-luna-apollo-change-cd188920-abeb-4508-8107-a249fd850d91.html


NASA's long trip back to the Moon
https://www.axios.com/nasas-long-trip-back-moon-c95f5085-eac6-47a4-9e4a-39cc697c3b31.html