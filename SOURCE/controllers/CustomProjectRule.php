<?php

namespace app\controllers;

use yii\base\BaseObject;
use yii\web\UrlRuleInterface;

class CustomProjectRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        //check case create url with: Url::to()
        if (preg_match('/^(cms\/project)/', $route)) {
            if (preg_match('/(create-project)$|(geoserver-url)$|(download)$/', $route)) {
                return false;
            }
            $routes = explode('/', $route);
            //get hash_slug
            $hash_slug = hash('md5', date("Y-m-d H:i:s")); //fake hash_slug
            if (isset($params['hash_slug'])) {
                $hash_slug = $params['hash_slug'];
                unset($params['hash_slug']);
            }

            //create new route
            $newRoute = 'cms/project/' . $hash_slug;
            for ($i = 2; $i < count($routes); $i++) {
                $newRoute .= '/' . $routes[$i];
            }
            $url = self::createUrlFromRouteAndParams($newRoute, $params);
            return $url;
        }
        return false; // this rule does not apply
    }

    public function createUrlFromRouteAndParams($route, $params)
    {
        $url = $route;
        if ($params) {
            array_walk($params, function (&$val, $key) {
                $val = "$key=$val";
            });
            $valUrl = implode('&', $params);
            $url = $route . '?' . $valUrl;
        }
        return $url;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $params = $request->getQueryParams();
        if (preg_match('/^(cms\/project)/', $pathInfo)) {
            if (preg_match('/(create-project)$|(geoserver-url)$|(download)$/', $pathInfo)) {
                return false;
            }
            $pathItems = explode('/', $pathInfo);
            $params['hash_slug'] = $pathItems[2];
            unset($pathItems[2]);
            return [implode('/', $pathItems), $params];
        }

        return false; // this rule does not apply
    }
}
