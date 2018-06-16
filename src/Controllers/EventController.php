<?php
namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Event;

/**
 * Controller de Events
 */
class EventController {

    /**
     * Container Class
     * @var [object]
     */
    private $container;

    /**
     * Undocumented function
     * @param [object] $container
     */
    public function __construct($container) {
        $this->container = $container;
    }
    
    /**
     * Listagem de Events Clean
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function listEvent($request, $response, $args) {
        $entityManager = $this->container->get('em');
        $EventsRepository = $entityManager->getRepository('App\Models\Event');
        $Events = $EventsRepository->findAll();
        $return = $response->withJson($Events, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;        
    }
    
    /**
     * Cria um event
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function createEvent($request, $response, $args) {
        $params = (object) $request->getParams();
        /**
         * Pega o Entity Manager do nosso Container
         */
        $entityManager = $this->container->get('em');

        /**
         * Instância da nossa Entidade preenchida com nossos parametros do post
         */
        $Event = (new Event())->setCompany($params->company)
            ->setNameEvent($params->nameEvent)->setCreatedAt($params->createdAt)->setDate($params->date)
            ->setEmail($params->email)->setFirstName($params->firstName)->setLastName($params->lastName)
            ->setAdress($params->adress)->setCity($params->city)->setCountry($params->country)
            ->setTags($params->tags)->setAbout($params->about);

        
        
        /**
         * Registra a criação do event
         */
        $logger = $this->container->get('logger');
        $logger->info('Event Created!', $Event->getValues());

        /**
         * Persiste a entidade no banco de dados
         */
        $entityManager->persist($Event);
        $entityManager->flush();


        $return = $response->withJson($Event, 201)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }

    /**
     * Exibe as informações de um event 
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function viewEvent($request, $response, $args) {

        $id = (int) $args['id'];

        $entityManager = $this->container->get('em');
        $EventsRepository = $entityManager->getRepository('App\Models\Event');
        $Event = $EventsRepository->find($id); 

        /**
         * Verifica se existe um event com a ID informada
         */
        if (!$Event) {
            $logger = $this->container->get('logger');
            $logger->warning("Event {$id} Not Found");
            throw new \Exception("Event not Found", 404);
        }
        
        /**
         * Registra a visualização do event
         */
        $logger = $this->container->get('logger');
        $logger->info('Event View!', $Event->getValues());

        $return = $response->withJson($Event, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;   
    }

    /**
     * Atualiza um event
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function updateEvent($request, $response, $args) {

        $id = (int) $args['id'];

        /**
         * Encontra o event no Banco
         */ 
        $entityManager = $this->container->get('em');
        $EventsRepository = $entityManager->getRepository('App\Models\Event');
        $Event = $EventsRepository->find($id);   

        /**
         * Verifica se existe um event com a ID informada
         */
        if (!$Event) {
            $logger = $this->container->get('logger');
            $logger->warning("Event {$id} Not Found");
            throw new \Exception("Event not Found", 404);
        }  

        /**
         * Atualiza e Persiste o event com os parâmetros recebidos no request
         */
        $Event->setName($request->getParam('name'))
            ->setPassword($request->getParam('password'));

        /**
         * Persiste a entidade no banco de dados
         */
        $entityManager->persist($Event);
        $entityManager->flush();      
        
        /**
         * Registra a criação do event
         */
        $logger = $this->container->get('logger');
        $logger->info('Event Update!', $Event->getValues());
        
        $return = $response->withJson($Event, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }

    /**
     * Deleta um event
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function deleteEvent($request, $response, $args) {

        $id = (int) $args['id'];

        /**
         * Encontra o event no Banco
         */ 
        $entityManager = $this->container->get('em');
        $EventsRepository = $entityManager->getRepository('App\Models\Event');
        $Event = $EventsRepository->find($id);   

        /**
         * Verifica se existe um event com a ID informada
         */
        if (!$Event) {
            $logger = $this->container->get('logger');
            $logger->warning("Event {$id} Not Found");
            throw new \Exception("Event not Found", 404);
        }  

        /**
         * Remove a entidade
         */
        $entityManager->remove($Event);
        $entityManager->flush(); 
        $return = $response->withJson(['msg' => "Deletando o event {$id}"], 204)
            ->withHeader('Content-type', 'application/json');
        return $return;    
    }
    
}