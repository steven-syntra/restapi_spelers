<?php
function DBText2Textarea ( $dbtext )
{
    $retval = str_replace("<br>", chr(13) . chr(10), $dbtext );
    $retval = html_entity_decode($retval, ENT_QUOTES) ;
    return $retval;
}

function Textarea2DBText ( $text )
{
    $retval = $text;
    $retval = strip_tags ( $text );
    $retval = htmlentities( $retval, ENT_QUOTES );
    $retval = str_replace( chr(13) . chr(10), "<br>", $retval);
    return $retval;
}