<?php  function nav_item(string $link,  string $title, string $linkClass = "" ): string {

    $class = "nav-item";
    if($_SERVER['SCRIPT_NAME'] === 'index.php') {

        $class .= "active";
    }
    return  <<<HTML

    <li class ="$class">
    <a class="$linkClass" href="$link">$title</a></li>

HTML;    
}    

function nav_menu(string $linkClass): string {

    return      nav_item('/index.php', 'Home',$linkClass).
    nav_item('/contact.php', 'Contact', $linkClass);
}

function dump($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
}
?>



