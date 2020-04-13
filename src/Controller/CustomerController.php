<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CustomerSiteController
 * @package App\Controller
 *
 * @Route(path="/customer")
 */
class CustomerController
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @Route("/add", name="add_customer", methods={"POST"})
     */
    public function addCustomer(Request $request): Response
    {
        $data = $request->getContent();

        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];
        $phoneNumber = $data['phoneNumber'];

        if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->customerRepository->saveCustomer($firstName, $lastName, $email, $phoneNumber);

        $this->render('customer/add.html.twig',[
            'customer' => $data,
            'status' => 'Customer added!']);
    }

    /**
     * @Route("/get/{id}", name="get_one_customer", methods={"GET"})
     */
    public function getOneCustomer($id): Response
    {
        $customer = $this->customerRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $customer->getId(),
            'firstName' => $customer->getFirstName(),
            'lastName' => $customer->getLastName(),
            'email' => $customer->getEmail(),
            'phoneNumber' => $customer->getPhoneNumber(),
        ];

        return $this->render('customer/show.html.twig',[
            'customer' => $data]);
    }

    /**
     * @Route("/get-all", name="get_all_customers", methods={"GET"})
     */
    public function getAllCustomers(): Response
    {
        $customers = $this->customerRepository->findAll();
        $data = [];

        foreach ($customers as $customer) {
            $data[] = [
                'id' => $customer->getId(),
                'firstName' => $customer->getFirstName(),
                'lastName' => $customer->getLastName(),
                'email' => $customer->getEmail(),
                'phoneNumber' => $customer->getPhoneNumber(),
            ];
        }

        return $this->render('customer/customers.html.twig',[
            'customers' => $data]);
    }

    /**
     * @Route("/update/{id}", name="update_customer", methods={"PUT"})
     */
    public function updateCustomer($id, Request $request): Response
    {
        $customer = $this->customerRepository->findOneBy(['id' => $id]);
        $data = $request->getContent();

        $this->customerRepository->updateCustomer($customer, $data);

        $this->render('customer/update.html.twig',[
            'status' => 'customer updated!']);
    }

    /**
     * @Route("/delete/{id}", name="delete_customer", methods={"DELETE"})
     */
    public function deleteCustomer($id): Response
    {
        $customer = $this->customerRepository->findOneBy(['id' => $id]);

        $this->customerRepository->removeCustomer($customer);

        return $this->redirectToRoute('customer/customers.html.twig',[
            'status' => 'customer deleted']);
    }
}
