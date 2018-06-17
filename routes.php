<?php

/**
 * Grupo dos enpoints iniciados por /api-aelt
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

        /**
         * Others methods
         */
        $this->post('/login', '\App\Controllers\UserController:loginUser');
    });


    /**
     * Dentro de api, o recurso /event
     */
    $this->group('/event', function() {
        $this->get('', '\App\Controllers\EventController:listEvent');
        $this->post('', '\App\Controllers\EventController:createEvent');
        
        /**
         * Validando se tem um integer no final da URL
         */
        $this->get('/{id:[0-9]+}', '\App\Controllers\EventController:viewEvent');
        $this->put('/{id:[0-9]+}', '\App\Controllers\EventController:updateEvent');
        $this->delete('/{id:[0-9]+}', '\App\Controllers\EventController:deleteEvent');       

    });

    /**
     * Dentro de api, o recurso /Participation
     */
    $this->group('/participation', function() {
        $this->get('', '\App\Controllers\ParticipationController:listParticipation');
        $this->post('', '\App\Controllers\ParticipationController:createParticipation');
        
        /**
         * Validando se tem um integer no final da URL
         */
        $this->get('/{id:[0-9]+}', '\App\Controllers\ParticipationController:viewParticipation');
        $this->put('/{id:[0-9]+}', '\App\Controllers\ParticipationController:updateParticipation');
        $this->delete('/{id:[0-9]+}', '\App\Controllers\ParticipationController:deleteParticipation');


        /**
         * Others methods
         */
        $this->group('/status', function() {

            $this->get('/pending', '\App\Controllers\ParticipationController:listParticipationPending');
            $this->get('/reject', '\App\Controllers\ParticipationController:listParticipationReject');
            $this->get('/aprove', '\App\Controllers\ParticipationController:listParticipationAprove');
            


        });
    });

    /**
     * Dentro de api, o recurso /auth
     */
    $this->group('/auth', function() {
        $this->get('', \App\Controllers\AuthController::class);
    });
});
