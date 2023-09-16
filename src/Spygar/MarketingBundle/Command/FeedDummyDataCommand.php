<?php

namespace Spygar\MarketingBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Spygar\SpygarMarketing\Repository\CompanyRepository;
use Spygar\SpygarMarketing\Repository\SalesRepository;
use Spygar\SpygarMarketing\Entity\Company;
use Spygar\SpygarMarketing\Entity\Sales;


#[AsCommand(
    name: 'feed:dummy:data',
    description: 'feed dommy data of company and sales',
)]
class FeedDummyDataCommand extends Command
{
    /** @var CompanyRepository */
    private $companyRepository;

    /** @var SalesRepository */
    private $salesRepository;
    public function __construct(CompanyRepository $companyRepository, SalesRepository $salesRepository) 
    {
        $this->companyRepository = $companyRepository;
        $this->salesRepository = $salesRepository;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        foreach ($this->getCompanyData() as $companyData) {
            $companyInstance = $this->companyRepository->findOneByName($companyData['name']);
            $companyInstance = !empty($companyInstance) ? $companyInstance : new Company;
            $companyInstance->setName($companyData['name']);
            $this->companyRepository->save($companyInstance, true);
        }

        foreach ($this->getSalesData() as $salesData) {
            $companyInstance = $this->companyRepository->findOneByName($salesData['companyName']);
            if (empty($companyInstance)) {
                continue;
            }
            $salesInstance = $this->salesRepository->findOneBy(['company' => $companyInstance, 'amount' => $salesData['amount']]);
            $saleInstance  = $salesInstance ? $salesInstance : new Sales;
            $saleInstance->setCompany($companyInstance);
            $saleInstance->setAmount($salesData['amount']);
            $this->salesRepository->save($saleInstance, true);
        }

        $io->success('dummy data successfully persists');

        return Command::SUCCESS;
    }

    public function getCompanyData()
    {
        return [
            ['name' => 'Super Insurers'],
            ['name' => 'Quality Insurance Co'],
            ['name' => 'Insure-u-like'],
            ['name' => 'sales Insurers']
        ];
    }

    public function getSalesData()
    {
        return [
            ['companyName' => 'Super Insurers', 'amount' => '10'],
            ['companyName' => 'Super Insurers', 'amount' => '5'],
            ['companyName' => 'Quality Insurance Co', 'amount' => '10'],
            ['companyName' => 'Quality Insurance Co', 'amount' => '1'],
            ['companyName' => 'Quality Insurance Co', 'amount' => '15'],
            ['companyName' => 'Insure-u-like', 'amount' => '10'],
            ['companyName' => 'Insure-u-like', 'amount' => '10'],
            ['companyName' => 'sales Insurers', 'amount' => '12'],
            ['companyName' => 'sales Insurers', 'amount' => '11'],
            ['companyName' => 'sales Insurers', 'amount' => '8'],
        ];
    }
}
