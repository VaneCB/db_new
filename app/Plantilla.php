<?php

class Plantilla
{
 public static function listado_familias($familias){
     $html_select = "<select name='familia'>";
     foreach ($familias as $familia){
         $html_select.="<option value={$familia['cod']}>{$familia['nombre']}</option>";
     }
         $html_select .="</select>";
     return $html_select;
 }

    public static function listado_productos($productos){
        $html_list = "<ul name='producto'>";
        foreach ($productos as $producto){
            $html_list.="<li value={$producto['cod']}>{$producto['nombre_corto']}{$producto['descripcion']}{$producto['PVP']}></li>";
        }
        $html_list .="</ul>";
        return $html_list;
    }
}