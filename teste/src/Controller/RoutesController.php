<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Routes Controller
 *
 * @property \App\Model\Table\RoutesTable $Routes
 *
 * @method \App\Model\Entity\Route[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoutesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 3, //limit to 3 registers
            'order' => [
                'Users.id' => 'desc',
            ]
        ];

        $routes = $this->paginate($this->Routes);

        $this->set(compact('routes'));
    }

    /**
     * View method
     *
     * @param string|null $id Route id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $route = $this->Routes->get($id, [
            'contain' => []
        ]);

        $this->set('route', $route);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $route = $this->Routes->newEntity();
        if ($this->request->is('post')) {
            $route = $this->Routes->patchEntity($route, $this->request->getData());
            if ($this->Routes->save($route)) {
                $this->Flash->success(__('The route has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The route could not be saved. Please, try again.'));
        }
        $this->set(compact('route'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Route id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $route = $this->Routes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $route = $this->Routes->patchEntity($route, $this->request->getData());
            if ($this->Routes->save($route)) {
                $this->Flash->success(__('The route has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The route could not be saved. Please, try again.'));
        }
        $this->set(compact('route'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Route id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $route = $this->Routes->get($id);
        if ($this->Routes->delete($route)) {
            $this->Flash->success(__('The route has been deleted.'));
        } else {
            $this->Flash->error(__('The route could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function check ( ) {
        $route = $this->Routes->newEntity();
        if ($this->request->is('post')) {
            //$route = $this->Routes->patchEntity($route, $this->request->getData());
            $routes = $this->Routes->find()->all();

            $this->Flash->success(__($this->ChooseRoute ( $_POST[ 'origin_route' ], $_POST['destiny_route'], $_POST['gasoline_price'], $routes )));

        }
        $this->set(compact('route'));
    }



    #region [ FunctionMain  ]
// -- Main function.
// -- Calculates which route is best according to the autonomy of each route and return a string 
// -- stating which route the user should take and how much will be spent.
// -- Receives 3 parameters, being the origin point, the destination point and the liter value of gasoline. 

    public function ChooseRoute ( $origin, $destiny, $gasolinePrice, $routes ) {

        $autonomyTotal  = array ( );
        $autonomySum    = array ( );
        $route          = array ( );
        $cont           = 0;
        $min            = 0;

        // Format strings
        $origin     = strtoupper ( $origin );
        $destiny    = strtoupper ( $destiny );

        $originTemp = $origin;

        foreach ( $routes as $key => $value) 
        {
            //var_dump($value);
            if ( $value [ 'origin_route' ] == $originTemp ) 
            {
                array_push ( $autonomySum, $value [ 'autonomy_route' ] );

                if ( $value [ 'destiny_route' ] == $destiny ) 
                {
                    $this->AddAutonomy ( array_sum ( $autonomySum ), $cont ); 
                }
                else 
                {
                    $originTemp = $value [ 'destiny_route' ];

                    $route [ $cont ] = '';

                    foreach ( $routes as $key => $value) 
                    {
                        if ( $value [ 'origin_route' ] == $originTemp ) 
                        {
                            array_push ( $autonomySum, $value [ 'autonomy_route' ] );
                            
                            $route [ $cont ] .= $originTemp;

                            if ( $value [ 'destiny_route' ] == $destiny ) 
                            {
                                $this->AddAutonomy ( array_sum ( $autonomySum ), $cont );  
                            }
                            else 
                            {
                                $originTemp = $value [ 'destiny_route' ];
                            }
                        }
                    }
                }

                $originTemp = $origin;

                $autonomySum = array ( );
            }

            $cont++;
        }

        return $this->FormatReturn ( $route, $gasolinePrice, $origin, $destiny );
    }

    #endregion [ FunctionMain  ]



    #region [ FormatReturn ]
    // -- Function to format the return string for the user.
    // -- Receives 4 parameters, which are the array of possible routes, the price of the liter of gas, the origin point and the destination point.

    function FormatReturn ( $route, $gasolinePrice, $origin, $destiny ) {

        // ------ [ Formatacao do retorno ] 

        $return = "The best route is $origin";
        $return = $this->FormatRoute ( $route,  $this->AutonomyMin ( ), $return );

        // ------ [ Formatacao do valor em R$ ]

        $value = ( $GLOBALS [ 'min' ] / 10 ) * $gasolinePrice;
        $value = number_format ( $value, 2, ',', '');

        // ------ [ End Formatacao do valor em R$ ]

        $return .= "$destiny costing  R$ " . $value . ".";

        // ------ [ End Formatacao do retorno ]

        return $return;
    }

    #endregion [ FormatReturn ]



    #region [ AutonomyMin ]
    // -- Function that returns the smallest value of an array, which is the autonomy cost of the best route to the destination.

    function AutonomyMin ( ) {
        $GLOBALS [ 'min' ] = min ( $GLOBALS [ 'autonomyTotal' ] );

        foreach ( $GLOBALS [ 'autonomyTotal' ] as $key => $value) {
            if ( $value == $GLOBALS [ 'min' ] ) {
                return $key;
            }
        }
    }

    #endregion [ AutonomyMin ]



    #region [ AddAutonomy ]
    // -- Function to save in an array the total value of the autonomy of a given route.
    // -- Receive 2 parameters, which is the sum of the total autonomy of a given route and the index that will be saved in the array of all autonomies.

    function AddAutonomy ( $sum, $count ) {

        if ( $sum != 0 ) 
        {
            $GLOBALS [ 'autonomyTotal' ] [ $count ] = $sum;
        } 
    }

    #endregion [ AddAutonomy ]



    #region [ FormatRoute ]
    // -- Function to check for repeated letters in the route array.
    // -- Receive 3 parameters, they are an array with the routes to the destination, the index of the best route in the array and the string that will be returned to the user.

    function FormatRoute ( $route, $index, $return ) {

        if ( count ( $route ) > 0 && array_key_exists ( $index, $route ) ) 
        {
            $temp = $route [ $index ];

            $temp = preg_replace ( '/(.)\1+/', '$1', $temp );

            $return .= $temp;
        }

        return $return;
    }

    #endregion [ FormatRoute ]



}
