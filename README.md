# SAE 3-01 : ApprentiStage

## auteur  
- Daret Tom (dare0005)
- Cordier Eugene (cord0048)
- Rolin Enzo (roli0007)
- Pazze Thomas (pazz0001)
- Sahin Ferdi (sahi0015)

## Installation / Configuration

configuration de composer
``` bash
composer install
```
## Serveur Web local

### Lancer le serveur web
Lancez le serveur Web local avec cette commande :
```bash
composer start
```
### Accès au serveur Web
Naviguez alors à partir de cette adresse : <http://localhost:8000>

## les tests
lancer tout les tests développé si dessous :
```shell
composer test
```

### Style de codage

Le code suit la recommandation [Symfony](https://symfony.com/doc/current/contributing/code/standards.html) :
- il peut être contrôlé avec 
```shell
composer test:cs
```
- il peut être reformaté automatiquement avec :
```shell 
composer fix:cs
```

### les tests codeception
lance la construction de codeception avec :
```shell
composer build:codeception
```

Lance les tests codeception qui génère une nouvelle base avec :
```shell
composer test:codeception
```

## génération de la base de donnée
détruit l'ancienne et génère une nouvelle :
```shell
composer db
```
## accès au site
http://10.31.32.184:8000/site