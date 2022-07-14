<?php
require_once 'init.php';
$theme  = $ini['general']['theme'];
$class  = isset($_REQUEST['class']) ? $_REQUEST['class'] : '';
$public = in_array($class, $ini['permission']['public_classes']);
new TSession;

if ( TSession::getValue('logged') )
{
    $content     = file_get_contents("app/templates/{$theme}/layout.html");
    $menu_string = AdiantiMenuBuilder::parse('menu.xml', $theme);
    $content     = str_replace('{MENU}', $menu_string, $content);
}
else
{
    $content = file_get_contents("app/templates/{$theme}/login.html");
}

$content = ApplicationTranslator::translateTemplate($content);
$content = AdiantiTemplateParser::parse($content);

echo $content;

if (TSession::getValue('logged') OR $public)
{
    if (TSession::getValue('logged') &&
        TSession::getValue('idvaga') > 0 && 
        TSession::getValue('login') !== 'admin' && 
        TSession::getValue('login') !== 'agroadmin') {
        $class = 'ListaVagasDisponiveis';
        $_REQUEST['method'] = 'onCandidatar';
        $_REQUEST['id'] = TSession::getValue('idvaga');
        $_REQUEST['key'] = TSession::getValue('idvaga');
    }
    if ($class)
    {
        $method = isset($_REQUEST['method']) ? $_REQUEST['method'] : NULL;
        AdiantiCoreApplication::loadPage($class, $method, $_REQUEST);
    }
}
else
{
    if ($class === '') {
        /*=== Verifica vagas abertas ===*/
        TTransaction::open('permission');
        $vaga = new Vagas;
        $objs = $vaga->getVagasAbertas();
        TTransaction::close();
        
        if ($objs) {
            TSession::setValue('vg','VagasListPublica');
            AdiantiCoreApplication::loadPage('VagasListPublica', '', $_REQUEST);
        } else {
            TSession::setValue('vg','LoginForm');
            AdiantiCoreApplication::loadPage('LoginForm', '', $_REQUEST);
        }
    } else {
        AdiantiCoreApplication::loadPage($class, '', $_REQUEST);
    }
}
