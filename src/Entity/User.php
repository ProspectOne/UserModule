<?php
namespace ProspectOne\UserModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * Adds role system
 * @ORM\Entity()
 * @ORM\Table(name="user",uniqueConstraints={@ORM\UniqueConstraint(name="token_idx", columns={"token"}),@ORM\UniqueConstraint(name="email_idx", columns={"email"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 */
class User
{
    // User status constants.
    const STATUS_ACTIVE = 1; // Active user.
    const STATUS_RETIRED = 2; // Retired user.

    /**
     * @var Role
     * @ORM\ManyToOne(targetEntity="ProspectOne\UserModule\Entity\Role", fetch="EAGER")
     * @ORM\JoinColumn(name="r_user_role")
     */
    protected $role;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="email")
     */
    protected $email;

    /**
     * @ORM\Column(name="full_name")
     */
    protected $fullName;

    /**
     * @ORM\Column(name="password")
     */
    protected $password;

    /**
     * @ORM\Column(name="status")
     */
    protected $status;

    /**
     * @ORM\Column(name="date_created")
     */
    protected $dateCreated;

    /**
     * @ORM\Column(name="pwd_reset_token", nullable=true)
     */
    protected $passwordResetToken;

    /**
     * @ORM\Column(name="pwd_reset_token_creation_date", nullable=true)
     */
    protected $passwordResetTokenCreationDate;

    /**
     * @var string
     * @ORM\Column(name="token", nullable=true)
     */
    protected $token;

	/**
	 * @ORM\Column(name="type")
	 */
    protected $type;

    /**
     * Get role.
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get Role Name.
     * @return string
     */
    public function getRoleName()
    {
        if(!empty($this->role)) {
            return $this->role->getRoleName();
        } else {
            return 'N/A';
        }
    }
    /**
     * Add a role to the user.
     * @param Role $role
     * @return void
     */
    public function addRole($role)
    {
        $this->role = $role;
    }

    /**
     * Returns user ID.
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets user ID.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns email.
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets email.
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns full name.
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Sets full name.
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * Returns status.
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns possible statuses as array.
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_RETIRED => 'Retired'
        ];
    }

    /**
     * Returns user status as string.
     * @return string
     */
    public function getStatusAsString()
    {
        $list = self::getStatusList();
        if (isset($list[$this->status]))
            return $list[$this->status];

        return 'Unknown';
    }

    /**
     * Sets status.
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Returns password.
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets password.
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Returns the date of user creation.
     * @return string
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Sets the date when this user was created.
     * @param string $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * Returns password reset token.
     * @return string
     */
    public function getResetPasswordToken()
    {
        return $this->passwordResetToken;
    }

    /**
     * Sets password reset token.
     * @param string $token
     */
    public function setPasswordResetToken($token)
    {
        $this->passwordResetToken = $token;
    }

    /**
     * Returns password reset token's creation date.
     * @return string
     */
    public function getPasswordResetTokenCreationDate()
    {
        return $this->passwordResetTokenCreationDate;
    }

    /**
     * Sets password reset token's creation date.
     * @param string $date
     */
    public function setPasswordResetTokenCreationDate($date)
    {
        $this->passwordResetTokenCreationDate = $date;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return User
     */
    public function setToken(?string $token): User
    {
        $this->token = $token;
        return $this;
    }
}
