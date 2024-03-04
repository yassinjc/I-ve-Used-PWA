# S3-IveUsed-PWA

## Over dit project
I've Used is een progressieve web applicatie. I've Used genereerd een overzicht en laat de gebruiker weten wanneer ze op een veilige, legale en verantwoorde manier weer deel kunnen nemen aan het verkeer na het consumeren van gebruiksmiddelen.

I've Used informeert gebruikers ook over verkeersongevallen in de nabijen omgeving die betrekking hebben tot de consumatie van gebruiksmiddelen. Mocht een gebruiker niet meer in staat zijn om in om zichzelf naar huis te vervoeren, zal I've Used een overzicht aanbieden van andere beschikbare transporteer-opties.

## Installatie handleiding
Om deze volledig zelf gerealiseerde web applicatie te kunnen runnen heb je twee verschillende externe programma's nodig:

- Node.js voor gebruik van de Node Package Manager (https://nodejs.org/en/download/)
- Een lokale webserver dat voorzien is met een databasebeheerder zoals PhpMyAdmin (voorbeelden: Xampp of Laragon)

Onze web-app gebruikt Laravel-Mix (een Node-pakketje) om alle Vue bestanden te converteren naar leesbare Javascript, daarom hebben we Node nodig. Daarnaast hebben we de lokale webserver met databasebeheerder nodig omdat onze applicatie informatie gaat opslaan in een database, daarom hebben een databasebeheerder nodig met bijbehorende webserver.

### Stap 1
Clone deze git-repository in de HTDOCS folder je lokale webserver (meestal is dit: "C://xampp/htdocs" of "C://laragon/dist").

### Stap 2
Open in je terminal de zojuist aangemaakte reposity-folder genaamd: "s3-iveused-pwa" (dit doe je door: "cd s3-iveused-pwa" te typen in de terminal)

### Stap 3
Verander in het bestand: "variables.php", de variabel die heet: "$baseUrl" met het pad naar je daadwerkelijke website. Dit zal iets zijn in de richting van: "http://localhost/s3-iveused-pwa". Deze is voor iedereen anders en is gebasseerd op waar je het project specifiek gecloned hebt.

### Stap 4
Voer in de terminal het commando: "npm i" in

De installatie is nu voltooid :)

## Hoe pas ik bestanden aan
Open je terminal elke keer als je aan het project wilt werken en run het commando: "npx mix watch" (dit zorgt ervoor dat de bestanden in de "resources" folder worden omgezet naar bestanden die leesbaar zijn voor de browser en deze zullen vervolgens in de "dist" folder worden geplaatst).