<?php
/**
 * Plugin Name:     Vinylkeks
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     vinylkeks
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Vinylkeks
 */

// Your code starts here.
include( plugin_dir_path( __FILE__ ) . 'post-types/disc.php');

 
/**
 * Central location to create all shortcodes.
 */
function vinylkeks_shortcodes_init() {
    add_shortcode( 'vinylkeks', 'render_disc' );
}
 
add_action( 'init', 'vinylkeks_shortcodes_init' );


function render_disc ($hnum=4580051150214){
    $hnum=4580051150214;
    $url="https://www.jpc.de/home/xml?task=detail&hnum=".$hnum;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
    
    $data = curl_exec($ch); // execute curl request
    curl_close($ch);
    
    $xml = simplexml_load_string($data);


    ?>
    <div class="buybox">
    <style>
    .buybox {

        display:flex;
    }
    .buybox  div  {
    margin: 1em 0 30px;
} 
.buybox  div:first-of-type {
    flex:2;
}
    </style>
    <div><table>
    <tr>
    <td>Veröffentlichung
    </td>
    <td>
<?php     print_r($xml->artikel->voe_datum[0]->__toString());
 ?>
    </td>
    </tr>
    <tr>
    <td>
    Label:
    </td>
    <td>
    <?php  print_r($xml->artikel->label[0]->__toString());?>
    </td>
    </tr>
    </table>
    </div>
    <div>
<p> Preis:  <?php print_r($xml->artikel->preis[0]->__toString()); ?></p>
  <p><a href="<?php print_r($xml->artikel->canonicallink[0]->__toString());  https://pastebin.com/S6QQzbdV ?>" class="button btn"> Button</a></p>

    </div>

    </div>
 <?php   
}

//render_disc ($hnum=4580051150214);