<?php

/**
 * Grupo dos enpoints iniciados por v1
 */
$app->group('/api-aelt', function() {

    /**
     * Dentro de api, o recurso /user
     */
    $this->group('/user', function() {
        $this->get('', '\App\Controllers\UserController:listUser');
        $this->post('', '\App\Controllers\UserController:createUser');
        
        /**
         * Validando se tem um integer no final da URL
         */
        $this->get('/{id:[0-9]+}', '\App\Controllers\UserController:viewUser');
        $this->put('/{id:[0-9]+}', '\App\Controllers\UserController:updateUser');
        $this->delete('/{id:[0-9]+}', '\App\Controllers\UserController:deleteUser');
    });

    /**
     * Dentro de api, o recurso /auth
     */
    $this->group('/auth', function() {
        $this->get('', \App\Controllers\AuthController::class);
    });
});
