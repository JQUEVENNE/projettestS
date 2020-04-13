<?php


namespace App\tests;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerTest extends WebTestCase
{
    public function testCreateCustomer()
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('POST', '/add');

        $client->submitForm('New customer', [
            'customer[firstname]' => 'Test',
            'customer[lastname]' => 'Testing',
            'customer[email]' => 'testmail@gmail.com',
            'customer[phoneNumber]' => '0647505366',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Customer new');
    }
    public function testCustomerList()
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $crowler = $client->request('GET', '/customers');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Customers list');

    }


    public function testShowCustomer()
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/show/1');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Customer show');
    }

    public function testEditCustomer()
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('GET', '/update/1');

        $client->submitForm('New customer', [
            'customer[firstname]' => 'Test',
            'customer[lastname]' => 'Testing',
            'customer[email]' => 'testmail@gmail.com',
            'customer[phoneNumber]' => '0647505366',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Customers update');
    }

    public function testDeleteCustomer()
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $client->request('DELETE', '/delete/1');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Customers list');
    }


}