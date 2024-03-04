<?php
    // Include Twig-templating engine
    require_once 'vendor/autoload.php';

    // Include personal enviorment variables
    include 'variables.php';

    // Get the URL of the current requested page
    $pageUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    // Store the page-specifier from the URL
    $page = $pageSpecifier = str_replace($baseUrl, "", $pageUrl);

    // Arrow of all active pages
    $pages = array(
        "home" => array(
            "active" => false,
            "navIcon" => '<svg width="32" height="26" viewBox="0 0 32 26"><path class="a" d="M15.575,9,5.333,17.812v9.513a.909.909,0,0,0,.889.929l6.225-.017a.91.91,0,0,0,.884-.929V21.753a.909.909,0,0,1,.889-.929h3.555a.909.909,0,0,1,.889.929V27.3a.95.95,0,0,0,.259.659.87.87,0,0,0,.629.273l6.223.018a.909.909,0,0,0,.889-.929V17.806L16.425,9A.655.655,0,0,0,15.575,9Zm16.178,5.991-4.644-4V2.95a.682.682,0,0,0-.667-.7H23.331a.682.682,0,0,0-.667.7V7.164L17.691,2.889a2.579,2.579,0,0,0-3.389,0L.241,14.989a.718.718,0,0,0-.089.981l1.417,1.8a.659.659,0,0,0,.451.251.647.647,0,0,0,.488-.156L15.575,6.619a.655.655,0,0,1,.85,0L29.492,17.864a.647.647,0,0,0,.939-.093l1.417-1.8A.718.718,0,0,0,32,15.46a.706.706,0,0,0-.243-.471Z" transform="translate(0.001 -2.254)" /></svg>'),
        "incident-map" => array(
            "active" => false,
            "navIcon" => '<svg width="20" height="28" viewBox="0 0 20 28"><path class="a" d="M8.972,27.435C1.4,15.916,0,14.734,0,10.5A10.259,10.259,0,0,1,10,0,10.259,10.259,0,0,1,20,10.5c0,4.234-1.4,5.416-8.972,16.935a1.217,1.217,0,0,1-2.055,0ZM10,14.875A4.275,4.275,0,0,0,14.167,10.5,4.275,4.275,0,0,0,10,6.125,4.275,4.275,0,0,0,5.833,10.5,4.275,4.275,0,0,0,10,14.875Z" /></svg>'),
        "travel-options" => array(
            "active" => false,
            "navIcon" => '<svg width="30" height="24" viewBox="0 0 30 24"><path class="a" d="M27.416,13.771l-.7-1.756L25.468,8.9a6.966,6.966,0,0,0-6.5-4.4H11.031a6.967,6.967,0,0,0-6.5,4.4L3.286,12.014l-.7,1.756A3.991,3.991,0,0,0,0,17.5v3a3.967,3.967,0,0,0,1,2.621V26.5a2,2,0,0,0,2,2H5a2,2,0,0,0,2-2v-2H23v2a2,2,0,0,0,2,2h2a2,2,0,0,0,2-2V23.121A3.965,3.965,0,0,0,30,20.5v-3A3.991,3.991,0,0,0,27.416,13.771ZM8.246,10.386A3,3,0,0,1,11.031,8.5h7.937a3,3,0,0,1,2.786,1.886L23,13.5H7l1.246-3.114ZM5,20.488a1.887,1.887,0,0,1-2-1.994A1.887,1.887,0,0,1,5,16.5a3.848,3.848,0,0,1,3,2.991C8,20.687,6.2,20.488,5,20.488Zm20,0c-1.2,0-3,.2-3-1A3.848,3.848,0,0,1,25,16.5a1.887,1.887,0,0,1,2,1.994,1.887,1.887,0,0,1-2,1.994Z" transform="translate(0 -4.5)" /></svg>'),
        "settings" => array(
            "active" => false,
            "navIcon" => '<svg width="28" height="28" viewBox="0 0 28 28"><path class="a" d="M30.189,18.5A3.6,3.6,0,0,1,32.5,15.136a14.276,14.276,0,0,0-1.728-4.162,3.652,3.652,0,0,1-1.466.313,3.594,3.594,0,0,1-3.289-5.059A14.241,14.241,0,0,0,21.861,4.5a3.6,3.6,0,0,1-6.723,0,14.284,14.284,0,0,0-4.164,1.728,3.594,3.594,0,0,1-3.289,5.059,3.533,3.533,0,0,1-1.466-.313A14.592,14.592,0,0,0,4.5,15.143a3.6,3.6,0,0,1,.007,6.721,14.276,14.276,0,0,0,1.728,4.162,3.6,3.6,0,0,1,4.747,4.746A14.367,14.367,0,0,0,15.146,32.5a3.594,3.594,0,0,1,6.708,0,14.284,14.284,0,0,0,4.164-1.728,3.6,3.6,0,0,1,4.747-4.746,14.359,14.359,0,0,0,1.728-4.162A3.619,3.619,0,0,1,30.189,18.5ZM18.566,24.321A5.832,5.832,0,1,1,24.4,18.489,5.831,5.831,0,0,1,18.566,24.321Z" transform="translate(-4.5 -4.5)" /></svg>'),
        "account" => array(
            "active" => false,
            "navIcon" => '<svg width="28" height="28" viewBox="0 0 28 28"><path class="a" d="M17,3A14,14,0,1,0,31,17,14.005,14.005,0,0,0,17,3Zm0,4.2a4.2,4.2,0,1,1-4.2,4.2A4.194,4.194,0,0,1,17,7.2Zm0,19.88a10.081,10.081,0,0,1-8.4-4.508c.042-2.786,5.6-4.312,8.4-4.312s8.358,1.526,8.4,4.312A10.081,10.081,0,0,1,17,27.08Z" transform="translate(-3 -3)" /></svg>')
    );

    // All odd URL occasians specification
    switch ($pageSpecifier) {
        case "":
            $page = "home";
        break;

        case "map":
            $page = "incident-map";
        break;
    }

    // Set page to active for navigation
    $pages[$page]["active"] = true;

    $accidents = array(
        array(
            "latitude" => 51.44083,
            "longitude" => 5.47778,
            "title" => "Eindhoven centrum",
            "labels" => array(
                "Alcoholgebruik",
                "Ongeval"
            ),
            "image" => "dist/img/accidents/accident-1.jpg",
            "paragraph" => "Het ongeval gebeurde rond 3 uur afgelopen nacht. Op de E17 in Haasdonk bij Beveren reed een spookrijder frontaal in op een taxi met vijf mensen in. Door de klap zaten de taxichauffeur en zijn vier passagiers gekneld in het wrak. De brandweer moest hen bevrijden. Ze raakten allemaal gewond bij het ongeval. Vooral de passagier die vooraan in de taxi zat is er erg aan toe. Hij is in kritieke toestand naar het ziekenhuis gebracht. De autobestuurder die al spookrijdend het ongeval veroorzaakte, is lichtgewond naar het ziekenhuis overgebracht. Het gaat om een jongeman van 24. Hij had te veel gedronken en had ook drugs gebruikt. Het parket onderzoekt het ongeval maar er is geen verkeersdeskundige aangesteld omdat het verloop van de gebeurtenissen duidelijk was. Het rijbewijs van de benevelde bestuurder is ingetrokken en de man zal zich moeten verantwoorden voor de politierechter."
        ),
        array(
            "latitude" => 51.50083,
            "longitude" => 5.48778,
            "title" => "Son en Breugel",
            "labels" => array(
                "Alcoholgebruik",
                "Ongeval"
            ),
            "image" => "dist/img/accidents/accident-1.jpg",
            "paragraph" => "Het ongeval gebeurde rond 3 uur afgelopen nacht. Op de E17 in Haasdonk bij Beveren reed een spookrijder frontaal in op een taxi met vijf mensen in. Door de klap zaten de taxichauffeur en zijn vier passagiers gekneld in het wrak. De brandweer moest hen bevrijden. Ze raakten allemaal gewond bij het ongeval. Vooral de passagier die vooraan in de taxi zat is er erg aan toe. Hij is in kritieke toestand naar het ziekenhuis gebracht. De autobestuurder die al spookrijdend het ongeval veroorzaakte, is lichtgewond naar het ziekenhuis overgebracht. Het gaat om een jongeman van 24. Hij had te veel gedronken en had ook drugs gebruikt. Het parket onderzoekt het ongeval maar er is geen verkeersdeskundige aangesteld omdat het verloop van de gebeurtenissen duidelijk was. Het rijbewijs van de benevelde bestuurder is ingetrokken en de man zal zich moeten verantwoorden voor de politierechter."
        )
    );

    // die(var_dump($pageSpecifier));
    
    // Let twig read the templates folder
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    // Create a new Twig envirorment (workspace)
    $twig = new \Twig\Environment($loader);
    // Render the base twig-file
    echo $twig->render('/layouts/base.twig', ['page' => $page, 'pages' => $pages, 'accidents' => json_encode($accidents)]);
?>
