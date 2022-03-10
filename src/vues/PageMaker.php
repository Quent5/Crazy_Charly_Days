<?php

namespace custombox\vue;

class PageMaker {
    public static function startPage($title): string {
        $style = file_get_contents("./style.css");
        return '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    '. $style .'
    </style>
    <title>'.$title.'</title>
</head>
<body>';
    }

    public static function endPage(): string {
        return '</body></html>';
    }

    public static function card($content, $style="width: fit-content;") {
        $str = "<div class=\"card\" style=\"$style\">";
        $str .= "<div class=\"card-body\">";
        $str .= $content;
        $str .= "</div></div>";
        return $str;
    }

    public static function inline($content) {
        $str = "<div class=\"inline\">";
        $str .= $content;
        $str .= "</div>";
        return $str;
    }

    public static function setLeft($content) {
        $str = "<div class=\"left\">";
        $str .= $content;
        $str .= "</div>";
        return $str;
    }

    public static function setRight($content) {
        $str = "<div class=\"right\">";
        $str .= $content;
        $str .= "</div>";
        return $str;
    }

    public static function date($content) {
        return "<div class=\"date\">$content</div>";
    }

    public static function scroll($content) {
        return "<div class=\"scroll\">$content</div>";
    }

    public static function startHeader() {
        return "<header>";
    }

    public static function endHeader() {
        return "</header>";
    }

    public static function button($label, $path, $disabled=false) {
        return "<a href=\"" . ($disabled? "": $path) . "\" class=\"button btn btn-primary " . ($disabled? "disabled": "") . "\" >$label</a>";
    }

    public static function form($action, $method, $content, $other="") {
        $c = PageMaker::card($content);
        return "<div class=\"formDiv\"><div class=\"inBetween\"><form class=\"superForm\" action=\"$action\" method=\"$method\" $other>$c</form></div></div>";
    }

    public static function input($type, $name, $value, $placeholder="titre", $disabled = false, $other="") {
        return "<p class=\"inputLabel\">$placeholder:</p>" .
            "<input class=\"inputZone\" type=\"$type\" name=\"$name\" value=\"$value\" placeholder=\"$placeholder\" ". ($disabled? "disabled=\"disabled\"": "") ." " . $other . " />\n"
        ;
    }

    public static function script($script) {
        return "<script>$script</script>";
    }

    public static function hiddenInput($type, $name, $value) {
        return "<input type=\"$type\" name=\"$name\" value=\"$value\" style=\"display: none;\"/>\n";
    }

    public static function centerX($content) {
        $str = "<div class=\"centerX\">";
        $str .= $content;
        $str .= "</div>";
        return $str;
    }

    public static function centerY($content) {
        $str = "<div class=\"centerY\">";
        $str .= $content;
        $str .= "</div>";
        return $str;
    }

    public static function line() {
        return "<hr>";
    }

    public static function submit($value, $disabled=false) {
        return "<br><button type=\"submit\" class=\"button btn btn-primary\" " . ($disabled? "disabled=\"disabled\"": "") . ">$value</button>";
    }

    public static function text($value) {
        return "<p class=\"p\">$value</p>";
    }

    public static function title($value, $style="") {
        return "<h3 style=\"$style\">$value</h3>";
    }

    public static function subtitle($value, $style="") {
        return "<h4 style=\"$style\">$value</h4>";
    }

    public static function icon($value) {
        return "<img src=\"$value\" style=\"width: 30px; margin: 4px;\"/>";
    }
}