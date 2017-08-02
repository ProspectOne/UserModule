<?php
namespace ProspectOne\UserModule\Interfaces;

/**
 * Interfaces UserInterface
 * @package ProspectOne\UserModule\Interfaces
 */
interface UserInterface
{
    public function getStatus();
    public function getPassword();
    public function getEmail();
    public function getFullName();
    public function getToken();
    public function setPassword($password);
    public function setPasswordResetToken($token);
    public function setPasswordResetTokenCreationDate($data);
}
