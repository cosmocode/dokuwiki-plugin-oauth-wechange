<?php

namespace dokuwiki\plugin\oauthwechange;

use dokuwiki\plugin\oauth\Service\AbstractOAuth2Base;
use OAuth\Common\Http\Uri\Uri;

/**
 * Custom Service for WECHANGE
 */
class Wechange extends AbstractOAuth2Base
{

    /** @inheritdoc */
    public function getAuthorizationEndpoint()
    {
        $plugin = plugin_load('action', 'oauthwechange');
        return new Uri($plugin->getConf('baseurl') . '/o/authorize/');
    }

    /** @inheritdoc */
    public function getAccessTokenEndpoint()
    {
        $plugin = plugin_load('action', 'oauthwechange');
        return new Uri($plugin->getConf('baseurl') . '/o/token/');
    }

    /**
     * @inheritdoc
     */
    protected function getAuthorizationMethod()
    {
        return static::AUTHORIZATION_METHOD_HEADER_BEARER;
    }

}
