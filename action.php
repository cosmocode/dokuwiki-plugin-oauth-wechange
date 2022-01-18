<?php

use dokuwiki\plugin\oauthwechange\Wechange;

/**
 * Service Implementation for oAuth WECHANGE authentication
 */
class action_plugin_oauthwechange extends \dokuwiki\plugin\oauth\Adapter
{

    /** @inheritdoc */
    public function registerServiceClass()
    {
        return Wechange::class;
    }

    /** * @inheritDoc */
    public function getUser()
    {
        $oauth = $this->getOAuthService();
        $data = [];

        // basic user data
        $json = $oauth->request($this->getConf('baseurl') . '/o/me?format=json');
        $result = json_decode($json, true);
        $data['user'] = $result['id'];
        $data['name'] = $result['name'];
        $data['mail'] = $result['email'];

        if (isset($result['group']) && is_array($result['group'])) {
            foreach ($result['group'] as $id => $slug) {
                $data['grps'][] = "$id-$slug";
            }
        }

        return $data;
    }

    /** @inheritDoc */
    public function getScopes()
    {
        return ['read'];
    }

    /** @inheritDoc */
    public function getLabel()
    {
        return $this->getConf('label', 'WECHANGE');
    }

    /** @inheritDoc */
    public function getColor()
    {
        return '#34b4b5';
    }

}
