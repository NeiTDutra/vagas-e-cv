<?php
namespace Adianti\Core;

use Adianti\Control\TPage;
use Adianti\Registry\TSession;
use Exception;

/**
 * Template parser
 *
 * @version    5.6
 * @package    core
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class AdiantiTemplateParser
{
    /**
     * Parse template and replace basic system variables
     * @param $content raw template
     */
    public static function parse($content)
    {
        $ini       = AdiantiApplicationConfig::get();
        $theme     = $ini['general']['theme'];
        $appname   = $ini['general']['application'];
        $site      = $ini['general']['site'];
        $nomecurto = $ini['general']['nomecurto'];
        $logo      = $ini['general']['logo'];
        $libraries = file_get_contents("app/templates/{$theme}/libraries.html");
        $class     = isset($_REQUEST['class']) ? $_REQUEST['class'] : '';
        
        if ((TSession::getValue('login') == 'admin') && !empty($ini['general']['token']))
        {
            if (file_exists("app/templates/{$theme}/builder-menu.html"))
            {
                $builder_menu = file_get_contents("app/templates/{$theme}/builder-menu.html");
                $content = str_replace('<!--{BUILDER-MENU}-->', $builder_menu, $content);
            }
        }
        
        if ($class == 'LoginForm' or ($class == '' and TSession::getValue('vg') == 'LoginForm'))
        {
            $content = str_replace(['<!--[RETURN-LOGIN]-->', '<!--[RETURN-LOGIN]-->'], ['<!--', '-->'], $content);
        }
        
        if ($class == 'SystemRequestPasswordResetForm' or $class === 'VagasListPublica' or ($class == '' and TSession::getValue('vg') == 'VagasListPublica'))
        {
            $content = str_replace(['<!--[RESET-PASSWORD]-->', '<!--[RESET-PASSWORD]-->'], ['<!--', '-->'], $content);
        }

        if ($class == 'VagasListPublica' or ($class == '' and TSession::getValue('vg') == 'VagasListPublica'))
        {
            $content = str_replace(['<!--[RETURN-VAGAS]-->', '<!--[RETURN-VAGAS]-->'], ['<!--', '-->'], $content);
        }

        if ($logo == '') {
            $content = str_replace('<div id="logo"></div>', '', $content);
        } else {
            $content = str_replace('##LOGO##', $logo, $content);
        }
        TSession::delValue('vg');

        $login = TSession::getValue('login');

        $files = glob('app/images/photos/' . $login . '*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                //unlink($file); // delete file
                $content = str_replace('app/images/photos/{login}.jpg',$file, $content);
            }
        }

        /*if (file_exists('app/images/photos/'.$login.'.jpg')) {
            $content = str_replace('app/images/photos/{login}.jpg','app/images/photos/'.$login.'.jpg', $content);
        } else if (file_exists('app/images/photos/'.$login.'.png')) {
            $content = str_replace('app/images/photos/{login}.jpg','app/images/photos/'.$login.'.png', $content);
        } else {
            $content = str_replace('app/images/photos/{login}.jpg','app/templates/'.$theme.'/img/avatar5.png', $content);
        }*/
        
        $content   = str_replace('{LIBRARIES}', $libraries, $content);
        $content   = str_replace('{appname}', $appname, $content);
        $content   = str_replace('{site}', $site, $content);
        $content   = str_replace('{nomecurto}', $nomecurto, $content);
        $content   = str_replace('{class}',     $class, $content);
        $content   = str_replace('{template}',  $theme, $content);
        $content   = str_replace('{login}',     TSession::getValue('login'), $content);
        $content   = str_replace('{cache}',     date('dmYHis'), $content);
        $content   = str_replace('{username}',  TSession::getValue('username'), $content);
        $content   = str_replace('{usermail}',  TSession::getValue('usermail'), $content);
        $content   = str_replace('{frontpage}', TSession::getValue('frontpage'), $content);
        $content   = str_replace('{query_string}', $_SERVER["QUERY_STRING"], $content);
        
        $css       = TPage::getLoadedCSS();
        $js        = TPage::getLoadedJS();
        $content   = str_replace('{HEAD}', $css.$js, $content);
        
        return $content;
    }
}
