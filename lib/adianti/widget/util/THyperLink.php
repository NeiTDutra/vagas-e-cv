<?php
namespace Adianti\Widget\Util;

use Adianti\Widget\Base\TElement;

/**
 * File Link
 *
 * @version    5.6
 * @package    widget
 * @subpackage util
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class THyperLink extends TTextDisplay
{
    /**
     * Class Constructor
     * @param  $value    text content
     * @param  $location link location
     * @param  $color    text color
     * @param  $size     text size
     * @param  $decoration text decorations (b=bold, i=italic, u=underline)
     */
    public function __construct($value, $location, $color = null, $size = null, $decoration = null, $icon = null, $target = null, $title = null, $classcss = null)
    {
        if ($icon)
        {
            $value = new TImage($icon) . $value;
        }
        
        parent::__construct($value, $color, $size, $decoration);
        parent::setName('a');
        
        if (file_exists($value))
        {
            $this->{'href'} = 'download.php?file='.$location;
        }
        else
        {
            $this->{'href'} = $location;
        }
        
        if ($target === null) {
            $this->{'target'} = 'newwindow';
        } else {
            $this->{'target'} = $target;
        }

        if ($title !== null) {
            $this->{'title'} = $title;
        }

        if ($classcss !== null) {
            $this->{'class'} = $classcss;
        }
    }
}
