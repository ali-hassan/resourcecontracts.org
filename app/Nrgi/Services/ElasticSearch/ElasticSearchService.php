<?php namespace App\Nrgi\Services\ElasticSearch;

use App\Nrgi\Repositories\Contract\ContractRepository;
use Exception;
use Guzzle\Http\Client;
use Psr\Log\LoggerInterface;

/**
 * Class ElasticSearchService
 * @package App\Nrgi\Services\ElasticSearch
 */
class ElasticSearchService
{
    /**
     * @var Client
     */
    protected $http;
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var ContractRepository
     */
    private $contract;

    /**
     * @param Client             $http
     * @param ContractRepository $contract
     * @param LoggerInterface    $logger
     */
    public function __construct(Client $http, ContractRepository $contract, LoggerInterface $logger)
    {
        $this->http     = $http;
        $this->logger   = $logger;
        $this->contract = $contract;
    }

    /**
     * Get full qualified ES url
     *
     * @param $request
     * @return string
     */
    protected function apiURL($request)
    {
        return env('ELASTIC_SEARCH_URL') . $request;
    }


    /**
     * Post data to Elastic Search
     *
     * @param $id
     * @param $type
     * @return mixed
     */
    public function post($id, $type)
    {
        $method = sprintf('post%s', ucfirst($type));
        if (method_exists($this, $method)) {
            return $this->$method($id);
        }
    }

    /**
     * Post metadata to ElasticSearch
     *
     * @param $id
     */
    public function postMetadata($id)
    {
        $contract   = $this->contract->findContract($id);
        $updated_by = ['name' => '', 'email' => ''];

        if (!empty($contract->updated_user)) {
            $updated_by = ['name' => $contract->updated_user->name, 'email' => $contract->updated_user->email];
        }

        $contract->metadata->contract_id = $contract->id;
        $contract->metadata->page_number = $contract->pages()->count();

        $metadata = [
            'id'         => $contract->id,
            'metadata'   => collect($contract->metadata)->toJson(),
            'created_by' => json_encode(
                ['name' => $contract->created_user->name, 'email' => $contract->created_user->email]
            ),
            'updated_by' => json_encode($updated_by),
            'created_at' => $contract->created_datetime->format('Y-m-d H:i:s'),
            'updated_at' => $contract->last_updated_datetime->format('Y-m-d H:i:s')
        ];

        try {
            $request  = $this->http->post($this->apiURL('contract/metadata'), null, $metadata);
            $response = $request->send();
            $this->logger->info('Metadata successfully submitted to Elastic Search.', $response->json());
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     * Post pdf text
     *
     * @param $id
     */
    public function postText($id)
    {
        $contract = $this->contract->findContractWithPages($id);

        $pages = [
            'contract_id' => $contract->id,
            'pages'       => $contract->pages->toJson(),
        ];

        try {
            $request  = $this->http->post($this->apiURL('contract/pdf-text'), null, $pages);
            $response = $request->send();
            $this->logger->info('Pdf Text successfully submitted to Elastic Search.', $response->json());
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
