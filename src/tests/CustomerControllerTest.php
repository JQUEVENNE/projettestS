<?php


namespace App\tests;
use App\Entity\Customer;
use PHPUnit\Framework\TestCase;

class CustomerControllerTest
{
    private $customer;

    protected function setUp()
    {
        $this->customer = new Customer();
    }

    protected function tearDown()
    {
        $this->customer = NULL;
    }

    /* public function testCreateCustomer()
     {

     }*/

    public function testEqualsFirstname()
    {
        $firstname = $this->customer->setFirstname('test');
        $this->assertEquals('test', $this->customer->getFirstname());
    }

    public function testTypeFirstname(): void
    {
        $firstname = $this->customer->setFirstname('Archaon');
        $this->assertIsString($this->customer->getFirstname());
    }



    public function testEqualsLastname()
    {
        $lastname = $this->customer->setLastname('Testing');
        $this->assertEquals('Testing', $this->customer->getlastname());
    }

    public function testTypeLastname(): void
    {
        $lastname = $this->customer->setLastname('Vilitch');
        $this->assertIsString($this->customer->getLastname());
    }




    public function testEqualsEmail()
    {
        $email = $this->customer->setEmail('testemail@gmail.com');
        $this->assertEquals('testemail@gmail.com', $this->customer->getEmail());
    }

    public function testTypeEmail(): void
    {
        $email = $this->customer->setEmail('Sera@gmail.com');
        $this->assertIsString($this->customer->getEmail());
    }



    public function testEqualsPhoneNumber()
    {
        $phoneNumber = $this->customer->setPhoneNumber(0647505366);
        $this->assertEquals(0647505366, $this->customer->getPhoneNumber());
    }

    public function testTypePhoneNumber(): void
    {
        $phoneNumber = $this->customer->setPhoneNumber(0647505366);
        $this->assertIsInt($this->customer->getPhoneNumber());
    }
}