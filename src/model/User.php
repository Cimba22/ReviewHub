<?php

//namespace model;

class User
{
    private $userID;
    private $login;
    private $email;
    private $password;
    private $roleID;
    private $firstName;
    private $lastName;
    private $registrationDate;
    private $avatar;

    public function __construct($userID, $login, $email, $password, $roleID, $firstName, $lastName, $registrationDate, $avatar)
    {
        $this->userID = $userID;
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->roleID = $roleID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->registrationDate = $registrationDate;
        $this->avatar = $avatar;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID): void
    {
        $this->userID = $userID;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login): void
    {
        $this->login = $login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getRoleID()
    {
        return $this->roleID;
    }

    public function setRoleID($roleID): void
    {
        $this->roleID = $roleID;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate): void
    {
        $this->registrationDate = $registrationDate;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }




}