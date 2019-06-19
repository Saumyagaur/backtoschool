<?php
// connect to database
include "./includes/connection.php";

$q = "SELECT * FROM `products`";
$prepared = $pdo->prepare($q);
$prepared->execute();

// Reference: 
// https://www.php.net/manual/en/pdostatement.fetchall.php
// https://stackoverflow.com/questions/16846531/how-to-read-fetchpdofetch-assoc
$products = $prepared->fetchAll(PDO::FETCH_ASSOC);
?>


<?php
// including $products array to this file

// prepare array for the chosen items by user
$selectedItems = [];

// check if $_GET array has any element!
if (sizeof($_GET) > 0) {
    for($i = 0; $i < sizeof($products); $i++){
        if (isset($_GET["prod-id"]) &&  $_GET["prod-id"] === $products[$i]["id"]) {
            // Reference: http://php.net/manual/en/function.array-push.php
            array_push($selectedItems, $products[$i]);
        }
    }
}


//declare a variable that will store initial value for markup
$markup = NULL;

// check if the number of elements is greater than 0
if (sizeof($selectedItems) > 0) {
    
    /*
    echo "<pre>\$selectedItems ";
    print_r($selectedItems);
    echo "</pre>";
    */
   
    // create markup and populate the markup with data 
    // loop through $selectedItems
    for($a = 0; $a < sizeof($selectedItems); $a++) {
        $markup .= "<figure>
                        <img id=\"thumb\" src=\"{$selectedItems[$a]["thumbnail"]}\" alt=\"{$selectedItems[$a]["type"]}\">
                        <figcaption>
                            <ul>
                                <li id=\"type\">{$selectedItems[$a]["type"]}</li>
                                <li id=\"price\">{$selectedItems[$a]["price"]}</li>
                            </ul>
                        </figcaption>
                    </figure>";
    }
}
 else if (sizeof($products) > 0){
    // do the same as in if-block, only difference is 
    // that you are going to loop through $products
    for($a = 0; $a < sizeof($products); $a++) {
    $markup .= "<figure>
                    <img id=\"thumb\" src=\"{$products[$a]["thumbnail"]}\" alt=\"{$products[$a]["type"]}\">
                        <figcaption>
                            <ul>
                                <li id=\"type\">Product: &nbsp &nbsp &nbsp{$products[$a]["type"]}</li>
                                <li id=\"price\">Price:&nbsp &nbsp &nbsp $  {$products[$a]["price"]}</li>
                            </ul>
                        </figcaption>
                    </figure>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Lato|Lora" rel="stylesheet">
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <header>
          <div class="brand">
             <img id="logo" src="images/logo.png" />
            
            <h1 id="name">School World</h1>
           </div>
           <hr id="first-line">
           
                <nav>
                    <ul>
                        <li><a href="./store.php">Home</a></li>
                        <li><a href="#">About</a></li>      
                        <li class="dropdown">
                            <a href="./store.php">Store</a>
                            <ul>
                                <li><a href="./store.php?prod-id=pn">Pens</a></li>
                                <li><a href="./store.php?prod-id=nb">Notebooks</a></li>
                                <li><a href="./store.php?prod-id=cl">Colours</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            <hr id="second-line">
        </header>
        <main>
           <div class="intro">
               <h1>
                   Welcome to School World!
               </h1>
               <h3>
                   Your one stop for all the school supplies. Select from the vast range of products we offer with the best price in the market.
                   <br/>
                   We understand how important it is to find the perfect stationary for your precious time in school. Afterall, it's all about confidence.
               </h3>
           </div>
            <div class="store">
                <?php
                    if(isset($markup)){
                        echo $markup;
                     }
                ?>
            </div>
        </main>
        <footer>
           <div class="social">
                <ul>
                    <li>
                        <i class="fab fa-facebook-f"></i>
                    </li>
                
                    <li>
                        <i class="fab fa-instagram"></i>
                    </li>
                
                    <li>
                        <i class="fab fa-pinterest-p"></i>
                    </li>
                </ul>
            </div>
        </footer>
    </body>
</html>