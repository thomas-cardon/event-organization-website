<?php

final class LandingPageController
{
    public function defautAction()
    {
        View::show('landing', array('body' => 'test'));
    }

    public function testformAction(Array $A_parametres = null, Array $A_postParams = null)
    {
        View::show('landing', array('formData' => $A_postParams));
    }

}

?>