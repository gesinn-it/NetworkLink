<?php

namespace MediaWiki\Extension\NetworkLink;

use Parser;
use PPFrame;
use MediaWiki\MediaWikiServices;

class NetworkLink {

    /**
     * Register the <networklink> tag during the parser setup
     */
    public static function onParserFirstCallInit( Parser $parser ) {
        // Register the tag hook for <networklink>
        $parser->setHook( 'networklink', [ __CLASS__, 'renderLink' ] );
    }

    /**
     * Callback function to handle <networklink> tag
     *
     * @param string $input Content inside the <networklink> tag
     * @param array $args Arguments passed to the tag
     * @param Parser $parser The parser object
     * @param PPFrame $frame The parser frame
     * @return string Rendered HTML link
     */
    public static function renderLink( $input, array $args, Parser $parser, PPFrame $frame ) {
        // Extract the 'path' argument if present
        $path = isset( $args['path'] ) ? $args['path'] : $input;

        // Sanitize the file path to prevent any security issues
        $sanitizedPath = htmlspecialchars( $path, ENT_QUOTES, 'UTF-8' );

        // Return an HTML link that opens the file with a 'file://' protocol
        return "<a href='file://$sanitizedPath' target='_blank'>$sanitizedPath</a>";
    }
}
