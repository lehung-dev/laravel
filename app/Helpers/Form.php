<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Config;


class Form
{

    public static function show($elements)
    {
        $output = null;
        foreach ($elements as $element) {
            $output .= self::formGroup($element);
        }
        return $output;
    }

    public static function formGroup($element, $params = null)
    {
        $output = null;
        $type = (isset($element['type'])) ? $element['type'] : 'input';
        switch($type)
        {
            case 'input' :
                $output .= sprintf('<div class="form-group">
                                    %s
                                    <div class="col-md-6 col-sm-6 col-xs-12"> %s </div>
                                </div>', $element['label'], $element['element']);
            break; 
            case 'btn-submit' :
                $output .= sprintf('<div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> %s </div>
                                    </div>', $element['element']);
            break; 
            case 'thumb' :
                $output .= sprintf('<div class="form-group">
                                        %s
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                             %s 
                                            <p style="margin-top: 30px">%s</p>
                                        </div>
                                    </div>', $element['label'], $element['element'], $element['thumb']);
            break; 
            case 'btn-submit' :
                $output .= sprintf('<div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> %s </div>
                                    </div>', $element['element']);
            break; 
            
            default:
                $output .= sprintf('<div class="form-group">
                                    %s
                                    <div class="col-md-6 col-sm-6 col-xs-12"> %s </div>
                                </div>', $element['label'], $element['element']);
            break; 
        };

        return $output;
    }
    
    public static function label($for, $text, $option = null)
    {
        $output = sprintf('<label for="%s" class="%s">%s</label>', $for, $option['class'], $text);
        return $output;
    }
    
    public static function text($name, $value, $option = null)
    {
        $id = (isset($option['id'])) ? $option['id'] : $name;
        $output = sprintf('<input type="text" name="%s" value="%s" id="%s" class="%s">', $name, $value, $id, $option['class']);
        return $output;
    }
    
    public static function hidden($name, $value, $option = null)
    {
        $output = sprintf('<input type="hidden" name="%s" value="%s" >', $name, $value);
        return $output;
    }
    

    public static function select($name, $list = array(), $selected = null, $options = null)
    {
        $id = (isset($options['id'])) ? $options['id'] : $name;
        $listOption = null;
        if(!empty($list))
        {
            foreach ($list as $key => $value) {
                $active = ($key == $selected) ? ' selected="selected"' : '';
                $listOption .= sprintf('<option value="%s"%s>%s</option>',$key,  $active, $value);
            }
        }
        $output = sprintf('<select class="%s" id="%s" name="%s">%s</select>',$options['class'], $id, $name, $listOption );
        return $output;
    }
    
    public static function submit($text, $options = null)
    {
        $class = (isset($options['class'])) ? 'class="'.$options['class'].'"' : '';
        $output = sprintf('<input %s type="submit" value="%s">',$class, $text);
        return $output;
    }
    
    public static function file($name, $options = null)
    {
        $class = (isset($options['class'])) ? 'class="'.$options['class'].'"' : '';

        $output = sprintf('<input %s type="file" name="%s">',$class, $name);
        return $output;
    }

}
