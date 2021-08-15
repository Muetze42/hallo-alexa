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

//        file_put_contents(public_path('css/buttons.map'), $result->getSourceMap());
        file_put_contents(public_path('css/buttons.css'), $result->getCss());

    }
}
