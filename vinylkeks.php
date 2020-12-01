<?php

/**
 * Plugin Name:     Vinylkeks
 * Plugin URI:      www.lightweb-media.de
 * Description:     show buybox for jpc Affiliate Links
 * Author:          Sebastian Weiss
 * Author URI:      www.lightweb-media.de
 * Text Domain:     vinylkeks
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Vinylkeks
 */

// Your code starts here.
include(plugin_dir_path(__FILE__) . 'post-types/disc.php');


/**
 * Central location to create all shortcodes.
 */
function vinylkeks_shortcodes_init()
{
    add_shortcode('vinylkeks_jpc_buybox', 'jpc_buybox');
    add_shortcode('vinylkeks_jpc_tracklist', 'jpc_tracklist');
}

add_action('init', 'vinylkeks_shortcodes_init');

function jpc_tracklist($hnum = 4580051150214)
{

    //  $url = "https://www.jpc.de/home/xml?task=detail&hnum=" . $hnum;
    //  $ch = curl_init();
    //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //  curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

    // $data = curl_exec($ch); // execute curl request
    // curl_close($ch);

    // $xml = simplexml_load_string($data);

    // ob_start();
    // var_dump($xml->artikel->trackinfos);
    // $tracklist = $xml->artikel->trackinfos->disk->track;
    // var_dump($xml->artikel->trackinfos);
    // var_dump(gettype($tracklist->track[0]));
    // foreach ($xml->artikel->trackinfos->disk as $tracklist) :
    // var_dump($xml->artikel->trackinfos->disk[0]disk']);
    //     foreach ($tracklist as $track) {
    //var_dump($track);
    //   var_dump($track->number->__toString());
    //  var_dump($track->titel->__toString());
    //   }
    // endforeach;
}

function jpc_buybox($atts = array(), $content = null, $tag = '')
{

    $jpc_atts = shortcode_atts(
        array(
            'hnum' => '',
        ),
        $atts,
        $tag
    );


    $url = "https://www.jpc.de/home/xml?task=detail&hnum=" . $jpc_atts['hnum'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

    $data = curl_exec($ch); // execute curl request
    curl_close($ch);

    $xml = simplexml_load_string($data);

    ob_start();
?>
    <div class="buybox">
        <style>
            .buybox {
                /*  display: flex; */
            }

            .buybox>div {
                margin: 1em 0 30px;
                margin-top: auto;
            }

            .buybox>div table {
                margin: 0em 0 0px;
                width: 100%;

            }

            .buybox>div table tr td:first-of-type {
                padding: 8px 0px;
            }

            .buybox div:first-of-type {
                flex: 2;
            }

            .vinylkeks_btn {
                background-color: black;
                border-radius: 28px;
                display: block;
                cursor: pointer;
                color: #ffffff;

                font-size: 17px;
                padding: 16px 31px;
                text-decoration: none;
                line-height: 10px;
                text-shadow: 0px 1px 0px #2f6627;
                text-align: center;
            }

            .vinylkeks_btn span {
                color: white !important;
            }

            .vinylkeks_btn:hover {
                background-color: black;
            }

            .vinylkeks_btn:active {
                position: relative;
                top: 1px;
            }

            .price {
                text-align: right;
            }
        </style>
        <div>



            <table>
                <tr>
                    <td>Interpret
                    </td>
                    <td>
                        <?php
                        try {
                            echo $xml->artikel->interpret[0]->__toString();
                        } catch (\Throwable $t) {
                            echo 'Keine Daten vorhanden';
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td>Titel
                    </td>
                    <td>
                        <?php
                        try {
                            echo $xml->artikel->tidisplkern[0]->__toString();
                        } catch (\Throwable $t) {
                            echo 'Keine Daten vorhanden';
                        } ?>

                    </td>
                </tr>


                <tr>
                    <td>Veröffentlichung
                    </td>
                    <td>
                        <?php
                        try {
                            echo $xml->artikel->voe_datum[0]->__toString();
                        } catch (\Throwable $t) {
                            echo 'Keine Daten vorhanden';
                        } ?>
                        <?php
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Label:
                    </td>
                    <td>
                        <?php
                        try {
                            echo $xml->artikel->label[0]->__toString();
                        } catch (\Throwable $t) {
                            echo 'Keine Daten vorhanden';
                        } ?>
                        <?php ?>
                    </td>
                </tr>
            </table>
        </div>
        <div>

            <?php
            try {
                $link = build_jpc_link($xml->artikel->canonicallink[0]->__toString());
            } catch (\Throwable $t) {
                $link = build_jpc_link('https://jpc.de');
            } ?>

            <p><a href="<?php echo $link; ?>" class="button btn vinylkeks_btn"><span> zu jpc</span></a></p>

        </div>

    </div>
<?php
    $output = ob_get_clean();

    return $output;
}

//render_disc ($hnum=4580051150214);

function build_jpc_link($link)
{
    $base_url = "https://partner.jpc.de/go.cgi?pid=179&wmid=cc&cpid=1&target=" . $link;

    return $base_url;
}
