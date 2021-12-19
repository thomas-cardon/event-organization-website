<?php

final class SignupController
{
    use ControllerHelpers;

    public function defaultAction()
    {
        User::ensureExists();

        if ($this->isAuthentified())
            $this->redirect('/', array('alert' => 'Vous êtes déjà connecté', 'alertType' => 'danger'));
        
        View::show('signup', array(
            'authentified' => false
        ));
    }

    public function testformAction(Array $A_parametres = null, Array $A_postParams = null)
    {
        View::show('landing', array('formData' => $A_postParams));
    }

}

?>