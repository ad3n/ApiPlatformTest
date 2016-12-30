<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\ActionLogger\ActionLoggable;
use AppBundle\Customer\CustomerInterface;
use AppBundle\ShoppingCart\OwnerableInterface as ShoppingCartOwnerInterface;
use AppBundle\Transaction\OwnerableInterface as TransactionOwnerInterface;
use AppBundle\ShoppingCart\ShoppingCartInterface;
use AppBundle\Transaction\TransactionInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="customers")
 *
 * @ApiResource()
 *
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class Customer implements CustomerInterface, ShoppingCartOwnerInterface, TransactionOwnerInterface
{
    use Timestampable;
    use ActionLoggable;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $identityNumber;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $identityType;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $maritalStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $handPhoneNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $joinDate;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @var ShoppingCartInterface
     */
    private $shoppingCart;

    /**
     * @var TransactionInterface[]
     */
    private $transactions;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdentityNumber(): string
    {
        return $this->identityNumber;
    }

    /**
     * @param string $identityNumber
     */
    public function setIdentityNumber(string $identityNumber)
    {
        $this->identityNumber = $identityNumber;
    }

    /**
     * @return string
     */
    public function getIdentityType(): string
    {
        return $this->identityType;
    }

    /**
     * @param string $identityType
     */
    public function setIdentityType(string $identityType)
    {
        $this->identityType = $identityType;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getMaritalStatus(): string
    {
        return $this->maritalStatus;
    }

    /**
     * @param string $maritalStatus
     */
    public function setMaritalStatus(string $maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate(): \DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getHandPhoneNumber(): string
    {
        return $this->handPhoneNumber;
    }

    /**
     * @param string $handPhoneNumber
     */
    public function setHandPhoneNumber(string $handPhoneNumber)
    {
        $this->handPhoneNumber = $handPhoneNumber;
    }

    /**
     * @return \DateTime
     */
    public function getJoinDate(): \DateTime
    {
        return $this->joinDate;
    }

    /**
     * @param \DateTime $joinDate
     */
    public function setJoinDate(\DateTime $joinDate)
    {
        $this->joinDate = $joinDate;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setActive(bool $isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @param ShoppingCartInterface $shoppingCart
     */
    public function setShoppingCart(ShoppingCartInterface $shoppingCart)
    {
        $this->shoppingCart = $shoppingCart;
    }

    /**
     * @return ShoppingCartInterface
     */
    public function getShoppingCart(): ShoppingCartInterface
    {
        return $this->shoppingCart;
    }

    /**
     * @return TransactionInterface[]
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * @param TransactionInterface[] $transactions
     */
    public function setTransactions(array $transactions)
    {
        foreach ($transactions as $transaction) {
            $this->addTransaction($transaction);
        }
    }

    /**
     * @param TransactionInterface $transaction
     */
    public function addTransaction(TransactionInterface $transaction)
    {
        $this->transactions[] = $transaction;
    }

    /**
     * @param TransactionInterface $transaction
     *
     * @return TransactionInterface[]
     */
    public function removeTransaction(TransactionInterface $transaction): array
    {
        foreach ($this->transactions as $index => $origin) {
            if ($origin->getId() === $transaction->getId()) {
                unset($this->transactions[$index]);

                return $this->transactions;
            }
        }
    }
}
