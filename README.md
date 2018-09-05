# Cover Text
PHP text,number,array vs vs

----------
## Installation

### Using Composer

```sh
composer require atiksoftware/php-class-cover
```

```php
require __DIR__.'/../vendor/autoload.php';

use Atiksoftware\Cover\Text; 
```
#### _Text Functions_
```php
echo Text::toHex(100000); # 186A0
echo "\n";

echo Text::toDec(AFAAB); # 719531
echo "\n";

echo Text::toUpper("mansur atik"); # MANSUR ATİK
echo "\n";

echo Text::toLower("MANSUR ATİK"); # mansur atik
echo "\n";

echo Text::toUpFirst("MANSUR ATİK"); # Mansur Atik
echo "\n";

echo Text::fixChars("Üzümü ye bağını sorma"); # Uzumu ye bagini sorma
echo "\n";

echo Text::clearSpecialChars("Amiral & Bristol ! _"); # Amiral  Bristol
echo "\n";

echo Text::Truncate("Lorem ipsum dolor sit amet, consectetur adipisicing elit.",30); # Lorem ipsum dolor sit amet, consectetur
echo "\n";

echo Text::formatFirstName("mansur"); # Mansur
echo "\n";

echo Text::formatLastName("atik"); # ATİK
echo "\n";

echo Text::formatFullName("mansur amiral atik"); # Mansur Amiral ATİK
echo "\n";

echo Text::formatPhone("6325252"); # 632-5252
echo "\n";

echo Text::formatPhone("2642655254"); # 0264 265 5254
echo "\n";

echo Text::formatPhone("5414855652"); # 0541 485 5652
echo "\n";
```


