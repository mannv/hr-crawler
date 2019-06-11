<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;

class IndexController extends Controller
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    private function crawlerCompanyList()
    {
        $html = file_get_html('https://itviec.com/jobs-company-index');
        $listCompany = $html->find('a.skill-tag__link');
        if (empty($listCompany)) {
            dd('data not found');
        }

        foreach ($listCompany as $item) {
            $this->companyRepository->createCompany([
                'source' => 'https://itviec.com',
                'name' => $item->innertext,
                'base_url' => $item->href
            ]);
        }
        dd('ok');
    }

    private function crawlerCompanyDetail($url)
    {
        $html = file_get_html($url);
        $attributes = [
            'member_scale' => '',
            'location' => '',
            'country' => json_encode([]),
            'address' => json_encode([]),
            'jobs' => []
        ];

        //location
        $result = $html->find('.name-and-info span', 0);
        if (!empty($result)) {
            $attributes['location'] = trim($result->plaintext);
        }
        //country
        $result = $html->find('.country .name');
        if (!empty($result)) {
            $list = [];
            foreach ($result as $item) {
                $list[] = trim($item->innertext);
            }
            $attributes['country'] = $list;
        }

        $memberScale = $html->find('.group-icon', 0);
        $attributes['member_scale'] = trim($memberScale->innertext);

        //address
        $result = $html->find('.full-address');
        if (!empty($result)) {
            $list = [];
            foreach ($result as $item) {
                $address = trim($item->plaintext);
                $address = str_replace("\r\n", ' ', $address);
                $list[] = $address;
            }
            $attributes['address'] = $list;
        }

        //jobs list
        $result = $html->find('.job');
        if (!empty($result)) {
            foreach ($result as $item) {
                $attributes['jobs'][] = [
                    'name' => trim($item->find('h4 a', 0)->innertext),
//                    'salary' => trim($item->find('.salary-text', 0)->innertext)
                ];
            }
        }

//        dd($attributes);
        echo '<pre>' . print_r($attributes, true) . '</pre>';
        die;
    }

    public function index()
    {
//        $result = $this->companyRepository->needCrawler();
//        dd($result);
        $this->crawlerCompanyDetail('https://itviec.com/companies/evolable-asia');
//        $this->crawlerCompanyDetail('https://itviec.com/companies/2359-media-viet-nam');
    }
}
