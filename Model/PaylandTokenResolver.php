<?php

namespace Hieu\Payland\Model;
use Hieu\Payland\Gateway\Config;
use Magento\Framework\Api\Search\SearchCriteriaInterfaceFactory;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Sales\Api\OrderRepositoryInterface;

class PaylandTokenResolver implements \Hieu\Payland\Api\PaylandTokenResolverInterface
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;
    /**
     * @var Config
     */
    private $config;
    /**
     * @var SearchCriteriaInterfaceFactory
     */
    private $searchCriteria;
    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * PaylandTokenResolver constructor.
     * @param OrderRepositoryInterface $orderRepository
     * @param SearchCriteriaInterfaceFactory $searchCriteria
     * @param SortOrderBuilder $sortOrderBuilder
     * @param Config $config
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaInterfaceFactory $searchCriteria,
        SortOrderBuilder $sortOrderBuilder,
        Config $config
    )
    {
        $this->orderRepository = $orderRepository;
        $this->config = $config;
        $this->searchCriteria = $searchCriteria;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * @param $orderId int
     * @return string
     */
    public function resolve()
    {
        $searchCriteria = $this->searchCriteria->create();

        /** @var SortOrder $sortOrder */
        $sortByEntity = $this->sortOrderBuilder->setField('entity_id')
            ->setDirection(SortOrder::SORT_DESC)
            ->create();

        $searchCriteria->setSortOrders([$sortByEntity])
            ->setPageSize(1)
            ->setCurrentPage(1);
        $orderList = $this->orderRepository->getList($searchCriteria);
        if ($orderList->getTotalCount()) {
            $orders = $orderList->getItems();
            $order = array_pop($orders);
            return $this->config->getRedirectApiEndpoint() . $order->getData('payland_token');
        }

        return '';
    }
}