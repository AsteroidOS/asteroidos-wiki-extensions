# AsteroidOS MediaWiki Extensions

## Installation and configuration

This assumes you're using a `docker-compose.yml` solution!

### Installation

Clone this extension:
```
git clone https://github.com/MagneFire/asteroidos-wiki-extensions.git
```

Mount the extension using `docker-compose.yml`:
```
…
services:
  wiki:
    …
    volumes:
      - ./asteroidos-wiki-extensions:/var/www/html/extensions/AsteroidOS
…
```

### LocalSettings.php

Change your `LocalSettings.php` file to include:
```
$wgDefaultSkin = "vector-2022";

$wgArchNavBar = [
        "Watches" => "https://asteroidos.org/watches/",
        "FAQ" => "https://asteroidos.org/faq/",
        "Documentation" => "https://wiki.asteroidos.org/",
        "News" => "https://asteroidos.org/news/",
        "Get Involved" => "https://asteroidos.org/community/",
        "Contact" => "https://asteroidos.org/contact/",
];

$wgArchNavBarSelectedDefault = "Documentation";

$wgVectorResponsive = true;

wfLoadExtension( 'AsteroidOS' );

```