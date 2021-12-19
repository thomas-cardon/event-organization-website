<?php

final class LandingPageController
{
    public function defaultAction()
    {
        User::ensureExists();
        
        View::show('landing', array(
            'authentified' => true
        ));
    }

    public function testformAction(Array $params = null, Array $post = null)
    {
        View::show('landing', array('formData' => $post));
    }

}

?>