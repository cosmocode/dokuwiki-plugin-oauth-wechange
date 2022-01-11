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
        $result = json_decode($oauth->request('o/me'), true);
        $data['user'] = $result['name'];
        $data['name'] = $result['name'];
        $data['mail'] = $result['email'];

        if (isset($result['group'])) {
            $groups = json_decode($result['group'], true);
            foreach ($groups as $id => $slug) {
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
        return 'WECHANGE';
    }

    /** @inheritDoc */
    public function getColor()
    {
        return '#34b4b5';
    }

}
