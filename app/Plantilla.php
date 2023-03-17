<?php

class Plantilla
{
    public static function listado_familias($familias, $familiaSeleccionada = null){
        $html_select = "<select name='familia'>";
        foreach ($familias as $familia){
            $selected = "";
            if ($familiaSeleccionada !== null && $familiaSeleccionada == $familia['cod']) {
                $selected = "selected";
            }
            $html_select.="<option value='{$familia['cod']}' $selected>{$familia['nombre']}</option>";
        }
        $html_select .= "</select>";
        return $html_select;
    }
    public static function listado_productos($productos){
        $html_list = "<ul>";
        foreach ($productos as $producto){
            $html_list.=" <form method='post' action='editar.php'>";
            $html_list.="<li value='{$producto['cod']}'>
            {$producto['nombre_corto']} 
            {$producto['PVP']}
            <input type='hidden' name='familia' value='{$producto['familia']}'>
            <input type='hidden' name='producto' value='{$producto['cod']}'>
             <button class='btn btn-info btn-sm' type='submit' name='submit' value='Editar'>Editar</button>
            </form>
            </li>";
        }
        $html_list .="</ul>";
        return $html_list;
    }
}