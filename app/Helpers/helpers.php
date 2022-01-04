<?php

function setActive($nameView){
    return request()->routeIs($nameView) ? 'active' : '';
}

function MenuActive($urls){
    foreach ($urls as $u) {
        if(request()->routeIs($u)){
            return 'open';
        }
    }
}

function isA($rol){
    if($rol == 'Administrador'){
        return true;
    }
    return false;
}

function isG($rol){
    if($rol == 'Gerente General'){
        return true;
    }
    return false;
}

function isJA($rol){
    if($rol == 'Jefe de Almacen'){
        return true;
    }
    return false;
}

function isJC($rol){
    if($rol == 'Jefe Comercial'){
        return true;
    }
    return false;
}

function isJL($rol){
    if($rol == 'Jefe de Logistica'){
        return true;
    }
    return false;
}

function isJCT($rol){
    if($rol == 'Jefe de Contabilidad'){
        return true;
    }
    return false;
}

function isC($rol){
    if($rol == 'Colaborador'){
        return true;
    }
    return false;
}
