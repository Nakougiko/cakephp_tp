<?php
namespace App\View\Helper;

use Cake\View\Helper;

class AuthenticationHelper extends Helper
{
    /**
     * Récupère l'identité de l'utilisateur connecté.
     *
     * @return \Authentication\IdentityInterface|null
     */
    public function getIdentity()
    {
        return $this->getView()->getRequest()->getAttribute('identity');
    }
}