<?php

namespace App\Model;

class WelcomeModel
{
    const SITE_INSTALLED_LABEL = 'Site installé';
    const SITE_INSTALLED_NAME = 'site_installed';
    

    private ?string $email;
    private ?string $password;

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null ?email
     */

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */

    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null ?password
     */

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

}