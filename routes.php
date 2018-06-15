<?php

/**
 * Grupo dos enpoints iniciados por v1
 */
$app->group('/v1', function() {

    /**
     * Dentro de v1, o recurso /user
     */
    $this->group('/user', function() {
        $this->get('', '\App\v1\Controllers\UserController:listUser');
        $this->post('', '\App\v1\Controllers\UserController:createUser');
        
        /**
         * Validando se tem um integer no final da URL
         */
        $this->get('/{id:[0-9]+}', '\App\v1\Controllers\UserController:viewUser');
        $this->put('/{id:[0-9]+}', '\App\v1\Controllers\UserController:updateUser');
        $this->delete('/{id:[0-9]+}', '\App\v1\Controllers\UserController:deleteUser');
    });

    /**
     * Dentro de v1, o recurso /auth
     */
    $this->group('/auth', function() {
        $this->get('', \App\v1\Controllers\AuthController::class);
    });
});
