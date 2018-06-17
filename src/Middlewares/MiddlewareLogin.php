<?php 
namespace App\middleware; 

use \Psr\Http\Message\ServerRequestInterface as Request; 
use \Psr\Http\Message\ResponseInterface as Response; 

use Firebase\JWT\JWT; 


/**
 * Controller de Autenticação
 */
class MiddlewareLogin { 

    /**
     * Container
     * @var object s
     */
    protected $container;
   
    /**
     * Undocumented function
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        $this->container = $container;
    }
    
    /**
     * Invokable Method
     * @param Request $request
     * @param Response $response
     * @param [type] $args
     * @return void
     */
    public function __invoke(Request $request, Response $response, $next) { 
        $key = $this->container->get("secretkey"); 
        $parsedBody = $request->getParsedBody(); 
        
        if (isset($parsedBody['user']) && isset($parsedBody['password'])) { 
            $objDateTime = new \DateTime('NOW'); 
            $objDateTime = $objDateTime->getTimestamp(); 
            $parsedBody['createdToken'] = $objDateTime; 
            $parsedBody['expireToken'] = $objDateTime + 3600; 
            // $parsedBody['permissions'] = array( 'read' => 'y', 'write' => 'n' ); 
            $jwt = JWT::encode($parsedBody, $key); 
            $response = $response->withJson(["token" => $jwt], 200)
                ->withHeader('Content-type', 'application/json'); 
                return $next($request, $response); 
            } else { 
                $response = $response->withJson(["token" => "Not found"], 400) 
                    ->withHeader('Content-type', 'application/json'); 
                return $response; 
            } 
        } 
                
    }