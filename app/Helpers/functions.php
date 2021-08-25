<?php

if (!function_exists('gerateAdditionalStylesheet')) {
    /**
     * @throws \ScssPhp\ScssPhp\Exception\SassException
     */
    function gerateAdditionalStylesheet()
    {
        $buttons = \App\Models\Link::where('active', true)->get();
        $compiler = new \ScssPhp\ScssPhp\Compiler();
        $compiler->setOutputStyle(\ScssPhp\ScssPhp\OutputStyle::COMPRESSED);

        $source = '.btn {';
        foreach ($buttons as $button) {
            $source.= '&.btn-'.$button->id.' {';
            $source.= 'background-color: '.$button->color.';';
            $source.= ' &:hover { background-color: lighten('.$button->color.', 10%); }';
            $source.= '}';
        }
        $source.= '}';

        $result = $compiler->compileString($source);

        file_put_contents(public_path('css/buttons.map'), $result->getSourceMap());
        file_put_contents(public_path('css/buttons.css'), $result->getCss());

    }
}

if (!function_exists('systemLog')) {
    function systemLog(mixed $message, string $severity = 'error')
    {
        $severity = severityCheck($severity);

        if (is_array($message) || is_object($message)) {
            $message = print_r($message, true);
        }

        \Illuminate\Support\Facades\Log::$severity($message);
    }
}

if(!function_exists('severityCheck')) {
    function severityCheck($severity): string
    {
        $severities = [
            'emergency',
            'alert',
            'critical',
            'error',
            'warning',
            'notice',
            'info',
            'debug',
        ];

        return in_array($severity, $severities) ? $severity : 'error';
    }
}

function lastAnd(string $string, string $word = 'und', string $glue = ','): string
{
    if (!preg_match('/,/', $string)) {
        return $string;
    }
    return substr_replace($string, ' '.$word, strrpos($string, $glue), 1);
}
