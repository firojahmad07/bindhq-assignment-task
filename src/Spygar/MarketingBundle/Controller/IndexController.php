<?php

namespace Spygar\MarketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Spygar\MarketingBundle\Repository\CompanyRepository;
use Spygar\MarketingBundle\Repository\SalesRepository;

class IndexController extends AbstractController
{
    /** @var CompanyRepository */
    protected $companyRepository;

    /** @var SalesRepository */
    protected $salesRepository;

    /**
     * @param CompanyRepository  $companyRepository
     * @param SalesRepository  $salesRepository
     */
    public function __construct(
        CompanyRepository $companyRepository,
        SalesRepository $salesRepository
        ) 
    {
        $this->companyRepository = $companyRepository;
        $this->salesRepository = $salesRepository;
    }
    public function index(): Response
    {
        return $this->render('@SpygarMarketing/index.html.twig');
    }

    public function companies() 
    {
        return new JsonResponse($this->companyRepository->getCompanies());
    }

    public function companiesWithSales() 
    {
        return new JsonResponse($this->salesRepository->getCompaniesWithSales());
    }

    public function sales(Request $request)
    {
        $company = $this->companyRepository->findOneById($request->get('companyId'));
    
        if (empty($company)) {
            return new JsonResponse(['message' => 'invalid company id']);
        }

        return new JsonResponse($this->salesRepository->getCompanySales($company->getId()));

    }
}